<?php // Berkas PHP yang mendefinisikan service gateway pembayaran Midtrans.

namespace App\Services; // Namespace untuk mengelompokkan kelas-kelas layer service.

use App\Models\Transaction; // Model Transaction menyediakan data transaksi.
use App\Models\TransactionItem; // Model TransactionItem merepresentasikan item transaksi.
use Illuminate\Support\Arr; // Helper Arr memudahkan akses array yang aman.
use Midtrans\Config; // Config dari SDK Midtrans menyimpan konfigurasi.
use Midtrans\Snap; // Klien API Midtrans Snap.

class MidtransServices // Kelas service yang membungkus interaksi dengan Midtrans Snap.
{
    public function __construct() // Konstruktor menginisialisasi nilai konfigurasi Midtrans.
    {
        Config::$isProduction = (bool) config('services.midtrans.is_production', false); // Mengatur mode sandbox/production sesuai konfigurasi.
        Config::$serverKey = config('services.midtrans.server_key'); // Mengisi server key dari konfigurasi.
        Config::$clientKey = config('services.midtrans.client_key'); // Mengisi client key yang dipakai frontend.
        Config::$isSanitized = true; // Memaksa sanitasi payload demi keamanan.
        Config::$curlOptions = config('services.midtrans.options', []); // Memuat opsi cURL tambahan jika ada.
        if (!isset(Config::$curlOptions[CURLOPT_HTTPHEADER])) { // Memastikan array header HTTP tersedia.
            Config::$curlOptions[CURLOPT_HTTPHEADER] = []; // Menginisialisasi wadah header jika belum ada.
        }
    }

    /**
     * Membuat transaksi Snap dan mengembalikan payload.
     */
    public function createTransaction(Transaction $transaction, array $customer): array // Menyusun payload transaksi untuk Midtrans Snap.
    {
        // Build transaction details
        $transactionDetails = [
            'order_id' => $transaction->order_code,
            'gross_amount' => $transaction->total,
        ];

        // Build item details
        $itemDetails = [];
        foreach ($transaction->items as $item) {
            $itemDetails[] = [
                'id' => $item->product_id,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'name' => $item->product->product_name,
            ];
        }

        // Build customer details
        $customerDetails = [
            'first_name' => Arr::get($customer, 'first_name', ''),
            'last_name' => Arr::get($customer, 'last_name', ''),
            'email' => Arr::get($customer, 'email', ''),
            'phone' => Arr::get($customer, 'phone', ''),
        ];

        // Build the full payload
        $payload = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        // Create transaction via Midtrans Snap
        $snapResponse = Snap::createTransaction($payload);

        return (array) $snapResponse;
    }
} // Akhir dari kelas service MidtransGateway.
