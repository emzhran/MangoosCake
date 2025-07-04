<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 

class LoginTest extends TestCase 
{
    use RefreshDatabase; 

    /**
     * Test: Pengguna (customer) bisa login dengan kredensial yang benar.
     * @return void
     */
    public function test_customer_can_login_with_correct_credentials()
    {
        $user = User::create([
            'name' => 'Customer Test',
            'email' => 'customer@example.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);

        $response = $this->post(route('login.submit'), [
            'email' => 'customer@example.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('customer.dashboard'));
    }

    /**
     * Test: Pengguna (customer) tidak bisa login dengan kredensial yang salah.
     * @return void
     */
    public function test_customer_cannot_login_with_invalid_credentials()
    {
        $response = $this->post(route('login.submit'), [
            'email' => 'nonexistent@example.com',
            'password' => 'wrongpassword',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
        $response->assertRedirect(route('login'));
    }

    /**
     * Test: Admin bisa login dengan kredensial yang benar.
     * @return void
     */
    public function test_admin_can_login_with_correct_credentials()
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@example.com',
            'password' => Hash::make('adminpassword'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $response = $this->post(route('login.submit'), [
            'email' => 'admin@example.com',
            'password' => 'adminpassword',
        ]);

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('admin.dashboard'));
    }

    /**
     * Test: Admin tidak bisa login dengan kredensial yang salah.
     * @return void
     */
    public function test_admin_cannot_login_with_invalid_credentials()
    {
        $response = $this->post(route('login.submit'), [
            'email' => 'admin@example.com',
            'password' => 'wrongpassword',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
        $response->assertRedirect(route('login'));
    }

    /**
     * Test: Pengguna dengan role 'customer' tidak bisa mengakses dashboard admin.
     * @return void
     */
    public function test_customer_cannot_access_admin_dashboard()
    {
        $customer = User::create([
            'name' => 'Customer Test',
            'email' => 'customer_for_admin_test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);

        $this->actingAs($customer);

        $response = $this->get(route('admin.dashboard'));

        $response->assertStatus(403);
    }
}