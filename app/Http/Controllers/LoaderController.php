<?php

namespace App\Http\Controllers;

use Request;
use App\Product;
use Illuminate\Support\Facades\Storage;

class LoaderController extends Controller
{
    public function index()
    {
    	$filter = array(
            'sort-type'         => Request::input ('sort-type'),
            'direction'         => Request::input ('direction'),
            'name'              => Request::input ('name'),
        );




    	$products           = Product::where('name', 'like', "%". $filter['name'] ."%")
                            ->get()->sortByDesc('id');

        if (!empty($filter['sort-type'])) {
            if ($filter['direction'] == 'asc')
                $products = $products->sortBy($filter['sort-type'], SORT_NATURAL|SORT_FLAG_CASE);
            else
                $products = $products->sortByDesc($filter['sort-type']);

        }

    	return view('index', compact('products', 'filter'));

  //   	$file = file_get_contents('prods.json');  // Открыть файл data.json
          
		// $taskList = json_decode($file,TRUE);

		// usort($taskList, function ($a, $b) {
		//     return $a['name'] <=> $b['name'];
		// });

  //   	dd($taskList);
    }

    public function load()
    {
 
    	Product::query()->delete();

    	if(Request::file('list')){
    		$file = Request::file('list');
    		$name = 'prods.json';

    		$file->move('products', $name);

    		$file = file_get_contents('products/prods.json');

    		$products = json_decode($file,TRUE);

    		foreach ($products as $product) {
    			
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

    	

		return redirect()->route('index');
    	
    }
}
