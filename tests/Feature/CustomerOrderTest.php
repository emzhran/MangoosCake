<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cake;
use App\Models\Order;
use Illuminate\Support\Facades\Hash; 

class CustomerOrderTest extends TestCase
{
    use RefreshDatabase; 

    /**
     * Test: Pelanggan bisa memesan kue dan melihat konfirmasi pesanan (TANPA FACTORY).
     *
     * @return void
     */
    public function test_customer_can_place_and_confirm_order_without_factory()
    {
        // 1. Persiapan Data (Setup) - Manual Creation
        // Membuat data User 
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password'), 
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);

        // Membuat data Cake 
        $cake = Cake::create([
            'nama_kue' => 'Roti Buaya Test',
            'harga_kue' => 150000,
            'deskripsi' => 'Roti buaya lezat untuk test.',
            'gambar_kue' => 'cakes/roti_buaya_test.png',
            'stok' => 50,
        ]);

        // Login sebagai user 
        $this->actingAs($user);

        // 2. Akses Halaman Buat Pesanan (GET /customer/order/create/{cake})
        $responseCreatePage = $this->get(route('customer.order.create', $cake->id));
        $responseCreatePage->assertStatus(200);
        $responseCreatePage->assertSee('Pesan Sekarang'); 

        // 3. Kirimkan Data Pesanan (POST /customer/order)
        $quantity = 2;
        $expectedTotalPrice = $cake->harga_kue * $quantity;

        $responseStoreOrder = $this->post(route('customer.order.store'), [
            'cake_id' => $cake->id,
            'quantity' => $quantity,
        ]);

        // Verifikasi Pesanan Tersimpan di Database
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'cake_id' => $cake->id,
            'jumlah_pemesanan' => $quantity,
            'total_price' => $expectedTotalPrice,
            'status' => 'pending',
        ]);

        $createdOrder = Order::where('user_id', $user->id)
                             ->where('cake_id', $cake->id)
                             ->first();

        $responseStoreOrder->assertRedirect(route('customer.order.confirmation', $createdOrder->id));
        $responseStoreOrder->assertSessionHas('success', 'Pesanan Anda berhasil dibuat!');

        // 4. Akses Halaman Konfirmasi Pesanan (GET /customer/order/confirmation/{orderId})
        $responseConfirmationPage = $this->get(route('customer.order.confirmation', $createdOrder->id));
        $responseConfirmationPage->assertStatus(200);
        $responseConfirmationPage->assertSee('Pesanan Anda Berhasil!');
        $responseConfirmationPage->assertSee($cake->nama_kue);
        $responseConfirmationPage->assertSee('Kuantitas:');
        $responseConfirmationPage->assertSee((string)$quantity);
        $responseConfirmationPage->assertSee('Total Pembayaran:');
        $responseConfirmationPage->assertSee(number_format($expectedTotalPrice, 0, ',', '.'));
    }
}