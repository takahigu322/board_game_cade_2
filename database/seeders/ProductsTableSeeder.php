<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=0; $i<16; $i++){
            $product_names = [];
            $product_names_ = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789"), 0, 16);
            array_push($product_names,$product_names_);
            $i++;
        }
        $product_descriptions = [substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789"), 0, 16)];
        $product_prices = [rand(1,30000)];
        $book_categories = [rand(1,15)];

        foreach ($product_names as $product_name) {
            foreach($product_descriptions as $product_description){
                foreach($product_prices as $product_price){
                    foreach($book_categories as $book_categorie){
                        Product::create([
                            'name' => $product_name,
                            'description' => $product_description,
                            'price' => $product_price,
                            'category_id' => $book_categorie
                        ]);
                    }
                }
            }
        }
    }
}
