<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogcategoryDataTable;
use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Blogcategories;
use App\Models\Blogcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(BlogcategoryDataTable $categoryDataTable)
    
    {
        if(request()->ajax()) {
            return datatables()->of(Blogcategory::select('*'))
            ->addColumn('action', function ($data){
                $result = "";
                $result .= '<button class="btn btn-success admin_category_edit"  data-id="' . $data->id . '"><i class="fas fa-edit"></i></button>               
                <button class="btn btn-danger delete_category"  data-id="' . $data->id . '"><i class="fa fa-trash" aria-hidden="true"></i></button>';                
                return $result;        
        })
      
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
    }
        return view('admin.blog.categoreis_view');
    }
    public function storeCategory(Request $request)
    {
        
        $category = Blogcategory::create([
            'categories_name'=>$request->category,
       
 
        ]);
        $categoryInsert=__('messages.insert Successfully');
        return response()->json(['status' => true, 'data' => $category, 'message' => "$categoryInsert"]);
    }
    public function destroyCategory(Request $request)
    {
       Blogcategory::where('id', $request->id)->delete();
       $categoryDelete=__('messages.Delete Successfully');
       return response()->json(['status' => true, 'message' => "$categoryDelete"]);
    }
    public function editCategory(Request $request)
    {

        $data = Blogcategory::find($request->id);
        return response()->json(['status' => true, 'blogcategory' => $data]);
    }
    public function updateCategory(Request $request)
    {

        $category = Blogcategory::where('id', $request->id)->update([
            'categories_name' => $request->category,
        ]);
        $categoryUpdate=__('messages.Update Successfully');

        return response()->json(['status' => true, 'data' => $category, 'message' => " $categoryUpdate"]);
    }
}
