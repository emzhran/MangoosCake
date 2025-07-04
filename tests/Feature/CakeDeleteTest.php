<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User; 
use App\Models\Cake; 
use Illuminate\Http\UploadedFile; 
use Illuminate\Support\Facades\Storage; 

class CakeDeleteTest extends TestCase 
{
    use RefreshDatabase; 
    use WithFaker;     // Menggunakan Faker untuk data dummy

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
     * Test: Admin bisa menghapus kue.
     * @return void
     */
    public function test_admin_can_delete_a_cake()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        // Buat kue beserta gambar dummy untuk dihapus
        $image = UploadedFile::fake()->image('cake_to_delete.jpg', 600, 400)->size(500);
        $imagePath = $image->store('kue', 'public'); 
        $cake = Cake::create([
            'nama_kue' => 'Kue Untuk Dihapus',
            'harga_kue' => 50000,
            'gambar_kue' => $imagePath,
        ]);

        // Pastikan kue dan gambarnya ada sebelum dihapus
        $this->assertDatabaseHas('cakes', ['id' => $cake->id]);
        Storage::disk('public')->assertExists($imagePath);

        // Kirim request DELETE ke route destroy
        $response = $this->delete(route('admin.datakue.destroy', $cake->id));

        // Memastikan kue tidak ada lagi di database
        $this->assertDatabaseMissing('cakes', ['id' => $cake->id]);

        // Memastikan file gambar juga terhapus dari storage (mocked)
        Storage::disk('public')->assertMissing($imagePath);

        // Memastikan redirect ke halaman index data kue setelah berhasil
        $response->assertRedirect(route('admin.datakue.index'));
        // Memastikan ada pesan sukses di sesi
        $response->assertSessionHas('success', 'Kue berhasil dihapus.'); 
    }

    /**
     * Test: Pengguna non-admin tidak bisa menghapus kue.
     * @return void
     */
    public function test_non_admin_cannot_delete_a_cake()
    {
        // Buat kue untuk dihapus
        $image = UploadedFile::fake()->image('cake_safe.jpg', 600, 400)->size(500);
        $imagePath = $image->store('kue', 'public');
        $cake = Cake::create([
            'nama_kue' => 'Kue Aman',
            'harga_kue' => 75000,
            'gambar_kue' => $imagePath,
        ]);

        // Pastikan kue dan gambarnya ada sebelum dihapus
        $this->assertDatabaseHas('cakes', ['id' => $cake->id]);
        Storage::disk('public')->assertExists($imagePath);

        // Coba sebagai guest (belum login)
        $response = $this->delete(route('admin.datakue.destroy', $cake->id));
        $response->assertRedirect(route('login')); // Harusnya redirect ke halaman login
        $this->assertDatabaseHas('cakes', ['id' => $cake->id]); // Pastikan kue tidak terhapus
        Storage::disk('public')->assertExists($imagePath); // Pastikan gambar tidak terhapus

        // Coba sebagai customer
        $customer = User::factory()->create(['role' => 'customer']);
        $this->actingAs($customer);
        $response = $this->delete(route('admin.datakue.destroy', $cake->id));
        $response->assertStatus(403); // Middleware role mengembalikan 403 Forbidden
        $this->assertDatabaseHas('cakes', ['id' => $cake->id]); // Pastikan kue tidak terhapus
        Storage::disk('public')->assertExists($imagePath); // Pastikan gambar tidak terhapus
    }
}