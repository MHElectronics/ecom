<?php

namespace App\Http\Controllers\Vendor;


use App\Http\Controllers\Controller;
use App\Traits\Media;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Merchant;

 // Assuming you have a Merchant model

class ProductController extends Controller
{
    use Media;

    protected $ASSET_PATH = 'products';
    protected $ROUTE_AND_VIEW = 'vendor.products.';

    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

   

    /**
     * Show the form to create a product (with categories created by admin).
     */
    public function create()
    {
        $categories = Category::all();
        
        $brands = Brand::all();// Categories created by admin
        $merchants = Merchant::all();
        
        

        return view('website.vendor.products.create', compact('categories', 'brands', 'merchants'));

    }

    /**
     * Store a new product submitted by vendor
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:products,code',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $product = Product::create($request->all());

        if ($request->hasFile('image')) {
            $this->uploadMedia($request->file('image'), $product, $this->ASSET_PATH);
        }

        
    }
    
    public function index()
    {
        // Example: get all products of the vendor
        $products = Product::paginate(10); // or simplePaginate(10)
 // Adjust this logic if you filter by vendor
        return view('website.vendor.products.index', compact('products'));
    }
    /**
     * Show the form to edit a product.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $merchants = Merchant::all();

        return view('website.vendor.products.edit', compact('product', 'categories', 'brands', 'merchants'));
    }
    /**
     * Update a product submitted by vendor.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:products,code,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
        

        $product->update($request->all());
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/products', $filename);
        
            $product->image = $filename;
            $product->save();
        }
        

        // if ($request->hasFile('image')) {
        //     $this->uploadMedia($request->file('image'), $product, $this->ASSET_PATH);
            
        // }

        return redirect()->route('vendor.products.index')->with('success', 'Product updated successfully.');
    }
    /**
     * Delete a product.
     */
    public function destroy(Product $product)
    {
        // Delete the product
        $product->delete();

        // Optionally, delete the associated media if needed
        // $this->deleteMedia($product, $this->ASSET_PATH);

        return redirect()->route('vendor.products.index')->with('success', 'Product deleted successfully.');
    }
    

}
