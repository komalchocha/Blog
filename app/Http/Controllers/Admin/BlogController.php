<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Blogcategories;
use App\Models\Blogcategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(BlogDataTable $blogdatatable)
    {
        if(request()->ajax()) {
            return datatables()->of(Blog::select('*'))
            ->addColumn('action', function ($data){
                $result = "";
                $result .= '<button class="btn btn-success admin_blog_edit"   data-id="' . $data->id . '"><i class="fas fa-edit"></i></button>             
                <button class="btn btn-danger delete_user"  data-id="' . $data->id . '"><i class="fa fa-trash" aria-hidden="true"></i></button>';                
                return $result;
           
        })
        ->editColumn('image', function ($data) {
            if ($data->image) {
                return '<img src="' . $data->image . '" class="rounded" style="width:60px; height:60px; object-fit: cover; border-radius:0px;"/>';
            }
        })
        ->editColumn('categorie_id', function ($data) {
            return $data->getcategory ? $data->getcategory->categories_name :'';
        })
        ->editColumn('user_id', function ($data) {
            return $data->getuser ? $data->getuser->name :'';
        })
        ->editColumn('like', function ($data) {
            return $data->getlike() ? $data->getlike() :'';
        })
        ->editColumn('comment', function ($data) {
            return $data->getcomment() ? $data->getcomment() :'';
        })
        ->rawColumns(['action','image'])
        ->addIndexColumn()
        ->make(true);
        }
        $blogcategories=Blogcategory::all();
        $blogs=Blog::all();
        return view('admin.blog.blog_view',compact('blogcategories','blogs'));
    }
    public function destroyBlog(Request $request)
    {
       Blog::where('id', $request->id)->delete();
       $blogDelete=__('messages.Delete Successfully');

       return response()->json(['status' => true, 'message' => "$blogDelete"]);
    }
    public function editBlog(Request $request)
    {

        $data = Blog::find($request->id);
        return response()->json(['status' => true, 'blog' => $data]);
    }
    public function updateBlog(Request $request)
    {
        $update = Blog::where('id', $request->id)->get();
        foreach ($update as $u) {
            $u->categorie_id = $request->input('categorie_name');
            $u->name = $request->input('name');
            $u->description = $request->input('description');
            if (isset($request->image)) {
                $image = $request->image;
                $destinationPath = public_path('storage\image');
                $imageName = date('YmdHis') . "." . $image->extension();
                $image->move($destinationPath, $imageName);
                $u->image = $imageName;
            }
            $u->update();
        }
        $blogUpdate=__('messages.Update Successfully');
        return response()->json(['status' => true, 'data' => $update, 'message' => "$blogUpdate"]);
    }

}
