<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CommentDataTable;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(CommentDataTable $commentdatatable)

    { 
        if(request()->ajax()) {
            return datatables()->of(Comment::select('*'))
        ->addColumn('action', function ($data){
            $result = "";
            $result .='<button class="btn btn-danger delete_comment"  data-id="' . $data->id . '"><i class="fa fa-trash" aria-hidden="true"></i></button>';                
            return $result;
        
       
    })
    ->editColumn('blog_id', function ($data) {
        return $data->getBlogname ? $data->getBlogname->name :'';
    })
    ->editColumn('created_at', function ($request) {
        return $request->created_at->diffForHumans(); // human readable format
      })
 
    ->editColumn('user_id', function ($data) {
        return $data->getuser ? $data->getuser->name :'';
    })
    ->rawColumns(['action'])
    ->addIndexColumn()
    ->make(true);

}
        return view('admin.blog.comment_view');
    }
    public function destroyComment(Request $request)
    {
       Comment::where('id', $request->id)->delete();
       $commentDelete=__('messages.Delete Successfully');
       return response()->json(['status' => true, 'message' => "$commentDelete"]);
    }
}
