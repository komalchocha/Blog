<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(UserDataTable $userdatatable)
    {
        if(request()->ajax()) {
            return datatables()->of(User::select('*'))
            ->addColumn('action', function ($data){
                $result = "";
                $result .= '<button class="btn btn-success user_edit_modal"  data-id="' . $data->id . '"><i class="fas fa-edit"></i></button>               
                <button class="btn btn-danger delete_user"  data-id="' . $data->id . '"><i class="fa fa-trash" aria-hidden="true"></i></button>';                
                return $result;
            
           
        })
        ->editColumn('image', function ($data) {
            if ($data->image) {
                return '<img src="' . $data->image . '" class="rounded" style="width:60px; height:60px; object-fit: cover; border-radius:0px;"/>';
            }
        })
        ->rawColumns(['action','image'])
        ->addIndexColumn()
        ->make(true);
        }
        $user=User::all();
        return view('admin.user.user_view',compact('user'));
 
    }
    public function destroyuser(Request $request)
    {
       User::where('id', $request->id)->delete();
       $userDelete=__('messages.Delete Successfully'); 
       return response()->json(['status' => true, 'message' => "$userDelete"]);
    }
    public function edit(Request $request)
    {

        $data = User::find($request->id);

       
        return response()->json(['status' => true, 'user' => $data]);
    }
    public function updateUser(UserRequest $request)
    {
        if (isset($request->image)) {     
        $file = $request->image;
        $extension =$file->getclientoriginalextension();
        $filename = rand().'_post.'.$extension;
        $file->move('storage/image',$filename);
            $user = User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'gender' => $request->gender,                
                'image' =>$filename,
            ]);

        } else {
            $user = User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'gender' => $request->gender,
               
            ]);
        }

        $userUpdate=__('messages.Update Successfully');

        return response()->json(['status' => true, 'data' => $user, 'message' => "$userUpdate"]);
    }
}
