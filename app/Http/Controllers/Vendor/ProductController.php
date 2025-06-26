<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Traits\Media;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Admin;

class ProductController extends Controller
{
    

    use Media;
    protected $ASSET_PATH = 'products';
    protected $ROUTE_AND_VIEW = 'vendor.products.';

    public function index(Request $request){
        

        if ($request->key) {
            $productSql->where('name', 'like', '%' . $request->key . '%');
            $productSql->orWhere('code', 'like', '%' . $request->key . '%');
        }

        if ($request->category) {
            $productSql->where('category_id', $request->category);
        }

        if ($request->brand) {
            $productSql->where('brand_id', $request->brand);
        }

        if ($request->price_from < $request->price_to) {
            $productSql->whereBetween('price', [$request->price_from, $request->price_to]);
        }

        $products = $productSql->orderBy('sort', 'ASC')->paginate($request->item_number ?? 15);

        $date = [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ];
        return view($this->ROUTE_AND_VIEW . 'index', $date);


    }

}
