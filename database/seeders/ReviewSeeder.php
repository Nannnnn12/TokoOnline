<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing users, products, and transactions
        $users = User::all();
        $products = Product::all();
        $transactions = Transaction::where('status', 'delivered')->get();

        if ($users->isEmpty() || $products->isEmpty() || $transactions->isEmpty()) {
            $this->command->info('No users, products, or delivered transactions found. Skipping review seeding.');
            return;
        }

        $reviewComments = [
            'Produk sangat bagus, sesuai dengan deskripsi. Pengiriman juga cepat.',
            'Kualitas produk excellent, akan belanja lagi di sini.',
            'Barang sesuai ekspektasi, packing rapi dan aman.',
            'Pelayanan customer service sangat baik dan responsif.',
            'Produk original, tidak ada cacat. Recommended seller!',
            'Harga terjangkau untuk kualitas seperti ini.',
            'Pengiriman super cepat, packing aman.',
            'Produk sesuai gambar, kualitas bagus.',
            'Seller ramah dan komunikatif.',
            'Barang datang dalam kondisi baik, terima kasih.',
            'Produk berkualitas tinggi, worth it!',
            'Pengalaman belanja yang menyenangkan.',
            'Barang sesuai deskripsi, tidak mengecewakan.',
            'Service excellent, recommended!',
            'Produk bagus, pengiriman cepat.',
        ];

        // Create reviews for some products
        foreach ($products->take(5) as $product) {
            $numReviews = rand(2, 8); // 2-8 reviews per product

            for ($i = 0; $i < $numReviews; $i++) {
                $user = $users->random();
                $transaction = $transactions->random();

                // Check if user already reviewed this product
                $existingReview = Review::where('user_id', $user->id)
                    ->where('product_id', $product->id)
                    ->first();

                if (!$existingReview) {
                    Review::create([
                        'user_id' => $user->id,
                        'product_id' => $product->id,
                        'transaction_id' => $transaction->id,
                        'rating' => rand(3, 5), // Mostly positive reviews
                        'comment' => $reviewComments[array_rand($reviewComments)],
                        'image' => null, // No images for seeded data
                    ]);
                }
            }
        }

        $this->command->info('Review seeding completed successfully!');
    }
}
