<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cake;
use Illuminate\Http\UploadedFile; 
use Illuminate\Support\Facades\Storage; 

class CakeAddTest extends TestCase 
{
    use RefreshDatabase; 
    use WithFaker;     

    /**
     * Setup method to run before each test.
     * Mengatur mock Storage agar tidak benar-benar menyimpan file gambar.
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public'); 
    }

    /**
     * Test: Pengguna non-admin tidak bisa mengakses halaman tambah kue.
     * @return void
     */
    public function test_non_admin_cannot_access_create_cake_page()
    {
        // Coba sebagai guest (belum login)
        $response = $this->get(route('admin.datakue.create'));
        $response->assertRedirect(route('login')); // Harusnya redirect ke halaman login

        // Coba sebagai customer
        $customer = User::factory()->create(['role' => 'customer']);
        $this->actingAs($customer);
        $response = $this->get(route('admin.datakue.create'));
        // Middleware role Anda mengembalikan 403 Forbidden untuk akses tidak sah
        $response->assertStatus(403); 
    }

    /**
     * Test: Admin bisa melihat halaman tambah kue.
     * @return void
     */
    public function test_admin_can_view_create_cake_page()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->get(route('admin.datakue.create'));
        $response->assertStatus(200); // Memastikan halaman bisa diakses (OK)
        $response->assertSee('Tambah Kue Baru'); // Memastikan judul halaman terlihat
        $response->assertSee('Nama Kue'); // Memastikan form field terlihat
        $response->assertSee('Harga');
        $response->assertSee('Gambar Kue');
    }

    /**
     * Test: Admin bisa menambahkan kue baru dengan data valid.
     * @return void
     */
    public function test_admin_can_store_a_new_cake_with_valid_data()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        // Buat file dummy untuk upload gambar
        $image = UploadedFile::fake()->image('cake_image.jpg', 600, 400)->size(500); 

        $response = $this->post(route('admin.datakue.store'), [
            'nama_kue' => 'Kue Coklat Baru',
            'harga_kue' => 125000,
            'gambar_kue' => $image, 
        ]);

        // Memastikan data kue tersimpan di database
        $this->assertDatabaseHas('cakes', [
            'nama_kue' => 'Kue Coklat Baru',
            'harga_kue' => 125000,
        ]);

        Storage::disk('public')->assertExists('kue/' . $image->hashName()); 

        // Memastikan redirect ke halaman index data kue setelah berhasil
        $response->assertRedirect(route('admin.datakue.index'));
        // Memastikan ada pesan sukses di sesi (jika controller Anda menambahkannya)
        $response->assertSessionHas('success', 'Kue baru berhasil ditambahkan.'); 
    }

    /**
     * Test: Admin tidak bisa menambahkan kue baru dengan data tidak valid.
     * @return void
     */
    public function test_admin_cannot_store_a_new_cake_with_invalid_data()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        // Kasus 1: Nama kue kosong
        $response = $this->post(route('admin.datakue.store'), [
            'nama_kue' => '', // Kosong
            'harga_kue' => 100000,
            'gambar_kue' => UploadedFile::fake()->image('valid.jpg'),
        ]);
        $response->assertSessionHasErrors('nama_kue');
        $response->assertStatus(302); // Redirect kembali ke form karena validasi gagal
        $this->assertDatabaseMissing('cakes', ['nama_kue' => '']); // Memastikan tidak tersimpan

        // Kasus 2: Harga kue negatif atau nol
        $response = $this->post(route('admin.datakue.store'), [
            'nama_kue' => 'Kue Invalid',
            'harga_kue' => -50000, // Invalid
            'gambar_kue' => UploadedFile::fake()->image('valid.jpg'),
        ]);
        $response->assertSessionHasErrors('harga_kue');
        $response->assertStatus(302);

        // Kasus 3: Gambar bukan tipe yang diizinkan atau terlalu besar
        $response = $this->post(route('admin.datakue.store'), [
            'nama_kue' => 'Kue Gambar Invalid',
            'harga_kue' => 100000,
            'gambar_kue' => UploadedFile::fake()->create('document.pdf', 100, 'application/pdf'), // Bukan gambar
        ]);
        $response->assertSessionHasErrors('gambar_kue');
        $response->assertStatus(302);

        $response = $this->post(route('admin.datakue.store'), [
            'nama_kue' => 'Kue Gambar Besar',
            'harga_kue' => 100000,
            'gambar_kue' => UploadedFile::fake()->image('large.jpg')->size(3000), // 3MB, lebih dari 2MB
        ]);
        $response->assertSessionHasErrors('gambar_kue');
        $response->assertStatus(302);
    }
}