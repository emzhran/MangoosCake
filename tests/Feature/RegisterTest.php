<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 

class RegisterTest extends TestCase
{
    use RefreshDatabase; 

    /**
     * Test: Pengguna bisa melihat form registrasi.
     * @return void
     */
    public function test_user_can_view_registration_form()
    {
        $response = $this->get(route('register')); // Mengakses rute 'register'
        $response->assertStatus(200); // Memastikan halaman bisa diakses (status OK)
        $response->assertSee('Register'); // Memastikan ada teks "Register" di halaman (sesuaikan jika teks di view Anda berbeda)
    }

    /**
     * Test: Pelanggan bisa mendaftar dengan kredensial yang valid.
     * @return void
     */
    public function test_customer_can_register_successfully()
    {
        $response = $this->post(route('register.submit'), [
            'name' => 'New Customer',
            'email' => 'newcustomer@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Memastikan user baru dibuat di database
        $this->assertDatabaseHas('users', [
            'email' => 'newcustomer@example.com',
            'name' => 'New Customer',
            'role' => 'customer',
        ]);

        // Karena controller tidak melakukan login otomatis
        $this->assertGuest(); // Memastikan user TIDAK login secara otomatis

        // Memastikan user dialihkan ke halaman login setelah registrasi berhasil
        $response->assertRedirect(route('login'));
        // Memastikan ada pesan sukses yang sesuai
        $response->assertSessionHas('success', 'Registrasi berhasil. Silakan login.');
    }

    /**
     * Test: Pengguna tidak bisa mendaftar dengan data yang tidak valid.
     * @return void
     */
    public function test_user_cannot_register_with_invalid_data()
    {
        // Kasus 1: Email tidak valid
        $response = $this->post(route('register.submit'), [
            'name' => 'Invalid User',
            'email' => 'invalid-email', // Email tidak valid
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $this->assertGuest();
        $response->assertSessionHasErrors('email'); // Memastikan ada error validasi untuk email
        $response->assertRedirect(route('login')); // Diarahkan kembali ke halaman login

        // Kasus 2: Password tidak cocok dengan konfirmasi
        $response = $this->post(route('register.submit'), [
            'name' => 'Mismatch Pass',
            'email' => 'mismatch@example.com',
            'password' => 'password123',
            'password_confirmation' => 'wrongpassword', // Konfirmasi salah
        ]);
        $this->assertGuest();
        $response->assertSessionHasErrors('password'); // Error untuk password
        $response->assertRedirect(route('login'));

        // Kasus 3: Password kurang dari 6 karakter (sesuai aturan 'min:6' di controller Anda)
        $response = $this->post(route('register.submit'), [
            'name' => 'Short Pass',
            'email' => 'shortpass@example.com',
            'password' => '123', // Kurang dari 6 karakter
            'password_confirmation' => '123',
        ]);
        $this->assertGuest();
        $response->assertSessionHasErrors('password');
        $response->assertRedirect(route('login'));

        // Kasus 4: Email sudah terdaftar
        User::create([
            'name' => 'Existing User',
            'email' => 'existing@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer', // Buat dengan role default
            'email_verified_at' => now(),
        ]);
        $response = $this->post(route('register.submit'), [
            'name' => 'Another User',
            'email' => 'existing@example.com', // Email sudah ada
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]);
        $this->assertGuest();
        $response->assertSessionHasErrors('email'); // Error karena email sudah ada
        $response->assertRedirect(route('login'));
    }
}