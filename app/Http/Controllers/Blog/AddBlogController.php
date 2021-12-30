<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Blog;
use App\Models\Blogcategory;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddBlogController extends Controller
{
    public function index()
    {
        $blogcategories = Blogcategory::all();
        $blogs = Blog::all();
        $likes = Like::all();
        return view('welcome', compact('blogcategories', 'blogs', 'likes'));
    }
    public function blog($id)
    {
        $viewblog = Blog::find($id);
        $comments = Comment::where('blog_id', $id)->get();
        return view('blog.blog_display', compact('viewblog', 'comments'));
    }

    public function store(Request $request)
    {
        $file = $request->image;
        $extension = $file->getclientoriginalextension();
        $filename = rand() . '_post.' . $extension;
        $file->move('storage/image', $filename);
        $user = Blog::create([
            'name' => $request->name,
            'description' => $request->description,
            'categories_name' => $request->categorie_name,
            'categorie_id' => $request->categorie_name,
            'user_id' => $request->user_id,
            'image' => $filename,
        ]);
        $userInsert=__('messages.Insert Successfully');
        return response()->json(['status' => true, 'data' => $user, 'message' => "$userInsert"]);
    }
    public function like(Request $request)
    {
        $like = Like::where('blog_id', $request->id)->where('user_id', Auth::user()->id)->first();

        if (empty($like)) {
            $like = Like::create(['blog_id' => $request->id, 'user_id' => Auth::user()->id]);

            return response()->json(['status' => true, 'data' => $like]);
        } else {
            $like->delete();

            return response()->json(['status' => false, 'data' => '']);
        }
    }
    public function comment(Request $request)
    {

        Comment::create(['blog_id' => $request->blog_id, 'user_id' => Auth::user()->id, 'comment' => $request->comment]);
        return back();
    }
    public function replyStore(CommentRequest $request)
    {
        Comment::create(['blog_id' => $request->blog_id, 'user_id' => Auth::user()->id, 'comment' => $request->comment, 'parent_id' => $request->comment_id]);
        return back();
    }
    public function fetchComment(Request $request)
    {

        $comments = Comment::where('blog_id', $request->blog_id)->where('parent_id', 0)->get();

        $output = '';
        for ($i = 0; $i < count($comments); $i++) {

            if (Auth::check()) {
                $reply=__('messages.reply');
                $output .= '<div class="sidebar-item comments">
                                <div class="sidebar-heading">
                                </div>
                            <div class="content">
                            <ul>';
                $output .= '<li>
                                <div class="right-content">
                                   <h5> <b>@</b>' . $comments[$i]->user->name . '  ' . $comments[$i]->created_at->diffForHumans() . '</h5>
                                   <p>' . $comments[$i]->comment . '</p>
                                    <button type="button" class="btn btn-danger delete mt-2 mr-2" data-id="' . $comments[$i]->id . '"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    <button type="button" class="btn btn-default reply mt-2" id="reply_' . $i . '" data-id="' . $comments[$i]->id . '">'.$reply.'</button>';
                $output .= $this->get_reply_comment($request->blog_id, $comments[$i]->id);
                '</div>
                            </li>';
                $output .= '</ul>
                        </div>
                    </div>';
            } else {
                $output .= '<div class="sidebar-item comments">
                <div class="sidebar-heading">
                </div>
            <div class="content">
            <ul>';
                $output .= '<li>
                <div class="right-content">
                   <h5> <b>@</b>' . $comments[$i]->user->name . '  ' . $comments[$i]->created_at->diffForHumans() . '</h5>
                   <p>' . $comments[$i]->comment . '</p>';
                    
                $output .= $this->get_reply_comment($request->blog_id, $comments[$i]->id);
                '</div>
            </li>';
                $output .= '</ul>
        </div>
    </div>';
            }
        }
        return response()->json(['status' => true, 'data' => $output]);
    }
    public function get_reply_comment($blog_id, $comment_id)
    {
        
        $comments = Comment::where('blog_id', $blog_id)->where('parent_id', $comment_id)->get();
        $output = '';
        for ($i = 0; $i < count($comments); $i++) {
            if (Auth::check()) {
                $reply=__('messages.reply');

            $output .= '<div class="replied-box">
                <h5> <b>@</b>' .  $comments[$i]->user->name . '  ' . $comments[$i]->created_at->diffForHumans() . '</h5>
                <p>' .  $comments[$i]->comment . '</p>
               
                <button type="button" class="btn btn-danger delete"  data-id="' .  $comments[$i]->id . '" mt-2 mr-2"><i class="fa fa-trash" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-default reply mt-2" id="reply' . $i . '" data-id="' .  $comments[$i]->id . '">'.$reply.'</button>';

            $output .= $this->get_reply_comment($blog_id, $comments[$i]->id);
            '</div>';
            if ($comments[$i]->parent_id == $comment_id) {
                $output .= '</div>';
            }
         } else {
            $output .= '<div class="replied-box">
            <h5> <b>@</b>' .  $comments[$i]->user->name . '  ' . $comments[$i]->created_at->diffForHumans() . 
            '</h5>
            <p>' .  $comments[$i]->comment . '</p>';
        
        $output .= $this->get_reply_comment($blog_id, $comments[$i]->id);
        '</div>';
        if ($comments[$i]->parent_id == $comment_id) {
            $output .= '</div>';
        }
         }
        }
        return $output;
    }

    public function destroy(Request $request)
    {
        $delete = Comment::where('id', $request->id)->delete();
        $userDelete=__('messages.Delete Successfully');
        return response()->json(['status' => true, 'data' => $delete, 'message' => " $userDelete"]);
    }
    public function update(Request $request)
    {
        if (isset($request->image)) {
            $file = $request->image;
            $extension = $file->getclientoriginalextension();
            $filename = rand() . '_post.' . $extension;
            $file->move('storage/image', $filename);
            $user = User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'gender' => $request->gender,
                'image' => $filename,
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
    public function blogEdit($id)
    {
        $blogcategories = Blogcategory::get(['categories_name', 'id']);
        $blogs = Blog::where('user_id', $id)->get();
        $likes = Like::all();

        return view('blog.blog_edit', compact('blogcategories', 'blogs', 'likes'));
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
    public function destroyblog(Request $request)
    {
        $deleteBlog = Blog::where('id', $request->id)->delete();
        $blogDelete=__('messages.Delete Successfully'); 
        return response()->json(['status' => true, 'data' => $deleteBlog, 'message' => "$blogDelete"]);
    }
}
