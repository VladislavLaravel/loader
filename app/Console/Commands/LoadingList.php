<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Product;

class LoadingList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'list:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Loading list cron';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if(file_exists(public_path('products/prods.json'))) {
            $file     = file_get_contents(public_path('products/prods.json'));
            $products = json_decode($file,TRUE);


            foreach ($products as $product) {
                if(Product::where('file_id', $product['id'])->exists()){
                    $old_product = Product::where('file_id', $product['id'])->first();

                    $old_product->file_id = $product['id'];
                    $old_product->price   = $product['price'];
                    $old_product->name    = $product['name'];
                    $old_product->size    = isset($product['characteristics']['size']) ? $product['characteristics']['size'] : null;
                    $old_product->color   = isset($product['characteristics']['color']) ? $product['characteristics']['color'] : null;
                    $old_product->taste   = isset($product['characteristics']['taste']) ? $product['characteristics']['taste'] : null;

                    $old_product->save();
                }else{
                    Product::create(array(
                        'file_id'  => $product['id'],
                        'price'    => $product['price'],
                        'name'     => $product['name'],
                        'size'     => isset($product['characteristics']['size']) ? $product['characteristics']['size'] : null,
                        'color'    => isset($product['characteristics']['color']) ? $product['characteristics']['color'] : null,
                        'taste'    => isset($product['characteristics']['taste']) ? $product['characteristics']['taste'] : null,
                    ));
                }
                
            }
        }
            
    }
}
