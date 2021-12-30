<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\Exports\ExportProduct;
use App\Http\Controllers\Controller;
use App\Imports\ImportProduct;
use Illuminate\Http\Request;
use App\Models\Productcategory;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Html\Editor\Fields\Select;

class ProductController extends Controller
{
 
    public function index(ProductDataTable $productdatatable)
    {
        $productcategories = Productcategory::all();
        return $productdatatable->render('admin.product.product_view', compact('productcategories'));
    }
    public function ProductStore(Request $request)
    {
        $file = $request->image;
        $extension = $file->getclientoriginalextension();
        $filename = rand() . '_post.' . $extension;
        $file->move('storage/image', $filename);
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'categories_name' => $request->categorie_name,
            'category_id' => $request->categorie_name,
            'image' => $filename,
            'price' => $request->price,
        ]);
        $product = __('messages.Insert Successfully');
        return response()->json(['status' => true, 'data' => $product, 'message' => "$product"]);
    }
    public function destroyProduct(Request $request)
    {
        Product::where('id', $request->id)->delete();
        $productDelete = __('messages.Delete Successfully');
        return response()->json(['status' => true, 'message' => "$productDelete"]);
    }
   
    public function Products(Request $request)
    {
    
       
        $products = Product::all();
        $productcategory = Productcategory::all();
    
        return view('admin.product.display_product', compact('products', 'productcategory'));
        
    }
    public function importView()
    {
        return view('admin.product.product_view');
    }

    public function import(Request $request)
    {
        Excel::import(new ImportProduct, $request->file('file'));
        return redirect()->back();
    }

    public function exportProduct()
    {
        return Excel::download(new ExportProduct, 'products.xlsx');
    }
   
    public function getCategory(Request $request)
    {
        $data = Product::where('category_id', $request->id)->select('image','category_id')->get();
        return response()->json(['status' => true, 'data' => $data]);
    }
  
    public function price(Request $request)
{
    $data = Product::where('price', [$request->input('min'), $request->input('max')])->select('image')->get();
    
    return response()->json(['status' => true, 'data' => $data]);
}  
  
}
