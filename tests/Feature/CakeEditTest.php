<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cake;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash; 

class CakeEditTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker; 

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    private function createUser($role = 'customer')
    {
        return User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password123'),
            'role' => $role,
            'email_verified_at' => now(),
        ]);
    }

    private function createCake($attributes = [])
    {
        return Cake::create(array_merge([
            'nama_kue' => $this->faker->words(3, true) . ' Cake',
            'harga_kue' => $this->faker->numberBetween(50000, 500000),
            'deskripsi' => $this->faker->paragraph,
            'gambar_kue' => 'kue/default_cake_' . time() . '.png', // Sesuaikan dengan folder 'kue/' di controller
            'stok' => $this->faker->numberBetween(10, 100),
        ], $attributes));
    }


    /**
     * Test: Pengguna non-admin tidak bisa mengakses halaman edit kue.
     * @return void
     */
    public function test_non_admin_cannot_access_edit_cake_page()
    {
        $cake = $this->createCake();

        // Coba sebagai guest (belum login)
        $response = $this->get(route('admin.datakue.edit', $cake->id));
        $response->assertRedirect(route('login')); // Untuk guest

        // Coba sebagai customer
        $customer = $this->createUser('customer');
        $this->actingAs($customer);
        $response = $this->get(route('admin.datakue.edit', $cake->id));
        $response->assertStatus(403); 
    }

    /**
     * Test: Admin bisa melihat halaman edit kue dan data terisi.
     * @return void
     */
    public function test_admin_can_view_edit_cake_page()
    {
        $admin = $this->createUser('admin');
        $this->actingAs($admin);

        $cake = $this->createCake([
            'nama_kue' => 'Kue Lama',
            'harga_kue' => 100000,
            'gambar_kue' => 'kue/gambar_lama.jpg', 
        ]);

        $response = $this->get(route('admin.datakue.edit', $cake->id));
        $response->assertStatus(200);
        $response->assertSee('Edit Data Kue');
        $response->assertSee('Kue Lama'); 
        $response->assertSee('100000');
        $response->assertSee(Storage::url($cake->gambar_kue));
    }

    /**
     * Test: Admin bisa memperbarui data kue dengan data valid (tanpa mengubah gambar).
     * @return void
     */
    public function test_admin_can_update_cake_without_changing_image()
    {
        $admin = $this->createUser('admin');
        $this->actingAs($admin);

        $oldImage = UploadedFile::fake()->image('old_cake.jpg', 600, 400)->size(500);
        $oldImagePath = $oldImage->store('kue', 'public'); 
        $cake = $this->createCake([
            'nama_kue' => 'Kue Awal',
            'harga_kue' => 50000,
            'gambar_kue' => $oldImagePath,
        ]);

        Storage::disk('public')->assertExists($oldImagePath);

        $response = $this->put(route('admin.datakue.update', $cake->id), [
            'nama_kue' => 'Kue Diperbarui',
            'harga_kue' => 75000,
        ]);

        $this->assertDatabaseHas('cakes', [
            'id' => $cake->id,
            'nama_kue' => 'Kue Diperbarui',
            'harga_kue' => 75000,
            'gambar_kue' => $oldImagePath,
        ]);

        Storage::disk('public')->assertExists($oldImagePath);

        $response->assertRedirect(route('admin.datakue.index'));
        $response->assertSessionHas('success', 'Data kue berhasil diperbarui.');
    }

    /**
     * Test: Admin bisa memperbarui data kue dengan mengubah gambar.
     * @return void
     */
    public function test_admin_can_update_cake_and_change_image()
    {
        $admin = $this->createUser('admin');
        $this->actingAs($admin);

        $oldImage = UploadedFile::fake()->image('old_cake_image.jpg', 600, 400)->size(500);
        $oldImagePath = $oldImage->store('kue', 'public'); 
        $cake = $this->createCake([
            'nama_kue' => 'Kue Dengan Gambar Lama',
            'harga_kue' => 120000,
            'gambar_kue' => $oldImagePath,
        ]);

        $newImage = UploadedFile::fake()->image('new_cake_image.png', 800, 600)->size(700);
        
        Storage::disk('public')->assertExists($oldImagePath);

        $response = $this->put(route('admin.datakue.update', $cake->id), [
            'nama_kue' => 'Kue Dengan Gambar Baru',
            'harga_kue' => 150000,
            'gambar_kue' => $newImage,
        ]);

        $updatedCake = Cake::find($cake->id);

        $this->assertDatabaseHas('cakes', [
            'id' => $cake->id,
            'nama_kue' => 'Kue Dengan Gambar Baru',
            'harga_kue' => 150000,
            'gambar_kue' => 'kue/' . $newImage->hashName(), 
        ]);

        Storage::disk('public')->assertExists('kue/' . $newImage->hashName());
        Storage::disk('public')->assertMissing($oldImagePath);

        $response->assertRedirect(route('admin.datakue.index'));
        $response->assertSessionHas('success', 'Data kue berhasil diperbarui.');
    }

    /**
     * Test: Admin tidak bisa memperbarui data kue dengan data tidak valid.
     * @return void
     */
    public function test_admin_cannot_update_cake_with_invalid_data()
    {
        $admin = $this->createUser('admin');
        $this->actingAs($admin);

        $cake = $this->createCake();

        // Kasus 1: Nama kue kosong
        $response = $this->put(route('admin.datakue.update', $cake->id), [
            'nama_kue' => '',
            'harga_kue' => 100000,
        ]);
        $response->assertSessionHasErrors('nama_kue');
        $response->assertStatus(302);
        $this->assertDatabaseHas('cakes', ['id' => $cake->id, 'nama_kue' => $cake->nama_kue]);

        // Kasus 2: Gambar baru tidak valid
        $response = $this->put(route('admin.datakue.update', $cake->id), [
            'nama_kue' => 'Valid Name',
            'harga_kue' => 100000,
            'gambar_kue' => UploadedFile::fake()->create('document.pdf', 100, 'application/pdf'),
        ]);
        $response->assertSessionHasErrors('gambar_kue');
        $response->assertStatus(302);
    }
}
