<!DOCTYPE html>
<html lang="en">
<head>
    {{-- (Sama seperti head di dashboard customer, bisa Anda copy-paste) --}}
    <title>Order {{ $cake->nama_kue }}</title>
    <style>
        /* Anda bisa copy-paste CSS dari dashboard customer atau buat yang baru */
        .order-container { display: flex; gap: 40px; margin-top: 40px; background: white; padding: 40px; border-radius: 12px; }
        .order-image { flex: 1; }
        .order-details { flex: 2; }
        .quantity-selector { display: flex; align-items: center; gap: 10px; margin: 20px 0; }
        .quantity-btn { width: 40px; height: 40px; border: 1px solid #ddd; background: #f7f7f7; cursor: pointer; font-size: 20px; }
        #quantity { width: 60px; text-align: center; font-size: 18px; border: 1px solid #ddd; padding: 8px; }
    </style>
</head>
<body>
    {{-- Header bisa Anda @include jika sudah dibuat partial --}}
    <header>
        <div class="logo">Mangoos.</div>
        {{-- ... Navigasi ... --}}
    </header>

    <section>
        <h2 class="section-title">Detail Pesanan Anda</h2>

        <form method="POST" action="{{ route('customer.order.store') }}">
            @csrf
            {{-- Simpan ID kue dan harga asli di input tersembunyi --}}
            <input type="hidden" name="cake_id" value="{{ $cake->id }}">
            <input type="hidden" id="base-price" value="{{ $cake->harga_kue }}">

            <div class="order-container">
                <div class="order-image">
                    <img src="{{ asset('storage/' . $cake->gambar_kue) }}" alt="{{ $cake->nama_kue }}" style="width:100%; border-radius: 12px;">
                </div>

                <div class="order-details">
                    <h1 style="font-size: 32px; font-weight: bold;">{{ $cake->nama_kue }}</h1>
                    <p style="font-size: 24px; color: var(--merah-tua); margin: 10px 0;">Rp {{ number_format($cake->harga_kue, 0, ',', '.') }}</p>

                    <div class="quantity-selector">
                        <button type="button" id="btn-minus" class="quantity-btn">-</button>
                        <input type="text" id="quantity" name="quantity" value="1" readonly>
                        <button type="button" id="btn-plus" class="quantity-btn">+</button>
                    </div>

                    <hr style="margin: 20px 0;">

                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 20px; font-weight: bold;">Total Harga:</span>
                        <span id="total-price" style="font-size: 28px; font-weight: bold; color: var(--merah-tua);">
                            Rp {{ number_format($cake->harga_kue, 0, ',', '.') }}
                        </span>
                    </div>

                    <button type="submit" class="btn-order" style="width: 100%; margin-top: 30px;">
                        Pesan Sekarang
                    </button>
                </div>
            </div>
        </form>
    </section>

    {{-- Footer bisa Anda @include jika sudah dibuat partial --}}
    <footer>
        {{-- ... Footer ... --}}
    </footer>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnMinus = document.getElementById('btn-minus');
        const btnPlus = document.getElementById('btn-plus');
        const quantityInput = document.getElementById('quantity');
        const totalPriceDisplay = document.getElementById('total-price');
        const basePrice = parseFloat(document.getElementById('base-price').value);

        function updateTotalPrice() {
            let quantity = parseInt(quantityInput.value);
            if (quantity < 1) {
                quantity = 1;
                quantityInput.value = 1;
            }
            const total = basePrice * quantity;
            // Format angka ke format Rupiah
            totalPriceDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        btnMinus.addEventListener('click', function() {
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantityInput.value = quantity - 1;
                updateTotalPrice();
            }
        });

        btnPlus.addEventListener('click', function() {
            let quantity = parseInt(quantityInput.value);
            quantityInput.value = quantity + 1;
            updateTotalPrice();
        });
    });
</script>
</body>
</html>