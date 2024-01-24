<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Role;
use App\Models\Wallet;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            "name" => "bank"
        ]);
        Role::create([
            "name" => "kantin"
        ]);
        Role::create([
            "name" => "siswa"
        ]);

        User::create([
            'name' => 'Bank Sekolah',
            'username' => 'bank',
            'password' => Hash::make('bank'), 
            'role_id' => 1
        ]);
        User::create([
            'name' => 'Kantin Sekolah',
            'username' => 'kantin',
            'password' => Hash::make('kantin'),
            'role_id' => 2
        ]);
        User::create([
            'name' => 'Ramdhani',
            'username' => 'dhani',
            'password' => Hash::make('dhani'),
            'role_id' => 3
        ]);

        Category::create([
            'name' => 'Makanan'
        ]);
        Category::create([
            'name' => 'Minuman'
        ]);
        Category::create([
            'name' => 'Snack'
        ]);

        Product::create([
            'name' => 'Nasi Goreng',
            'price' => 8000,
            'stock' => 50,
            'photo' => NULL,
            'description' => 'Nasi Goreng Special',
            'stand' => 1,
            'category_id' => 1,
        ]);
        Product::create([
            'name' => 'Es Teh Manis',
            'price' => 10000,
            'stock' => 50,
            'photo' => NULL,
            'description' => 'Es Teh Alami',
            'stand' => 2,
            'category_id' => 2,
        ]);
        Product::create([
            'name' => 'Gorengan',
            'price' => 3000,
            'stock' => 50,
            'photo' => NULL,
            'description' => 'Gorengan Garing Kriuk',
            'stand' => 1,
            'category_id' => 1,
        ]);

        Wallet::create([
            'user_id' => 3,
            'credit' => 100000,
            'debit' => null,
            'description' => 'pembukaan tabungan'
        ]);
        Wallet::create([
            'user_id' => 3,
            'credit' => null,
            'debit' => 15000,
            'description' => 'pembelian produk'
        ]);
        Wallet::create([
            'user_id' => 3,
            'credit' => null,
            'debit' => 15000,
            'description' => 'pembelian produk'
        ]);

        Transaction::create([
            'user_id' => 3,
            'product_id' => 1,
            'status' => 'dikeranjang',
            'order_code' => 'INV_12345',
            'price' => 5000,
            'quantity' => 1
        ]);
        Transaction::create([
            'user_id' => 3,
            'product_id' => 2,
            'status' => 'dikeranjang',
            'order_code' => 'INV_12345',
            'price' => 5000,
            'quantity' => 1
        ]);
        Transaction::create([
            'user_id' => 3,
            'product_id' => 3,
            'status' => 'dikeranjang',
            'order_code' => 'INV_12345',
            'price' => 5000,
            'quantity' => 1
        ]);

        $total_debit = 0;
        
        $transactions = Transaction::where('order_code'=='INV_12345');
        foreach($transactions as $transaction)
        {
            $total_price = $transaction->price * $transaction->quantity;

            $total_debit += $total_price;
        }
        Wallet::create([
            'user_id' => 3,
            'debit' => $total_debit,
            'description' => 'pembelian produk'
        ]);
        foreach($transactions as $transaction)
        {
            Transaction::find($transaction->id)->update([
                'status' => 'dibayar'
            ]);
        }
        foreach($transactions as $transaction)
        {
            Transaction::find($transaction->id)->update([
                'status' => 'diambil'
            ]);
        }
    }
}
