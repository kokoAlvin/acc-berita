<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Blog;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\User;
use App\Category;
use Illuminate\Support\Facades\Mail;
use App\Services\EmailService;
use App\Services\BlogService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class BlogController extends Controller
{
    //
    public function __construct()
    {
         $this->middleware('auth');
         $this->middleware('verified');
         $this->middleware('adminUser', ['only' => ['dashboard','reject','accept']]);
         $this->middleware('authorUser', ['only' => ['index','edit','create','update','store','delete']]);

    }
    public function index(Request $request){
        $Blog = Blog::with(['category']);
        $user_id = Auth::user()->id;
        $category = Category::all();
        $blogs = $Blog->where('user_id',$user_id)->paginate(10);

        return view('blog.index',compact('blogs'));
    }

    public function create(Request $request){
        $category = DB::table('category')->get();
        return view('blog.create',['category' => $category]);
    }

    public function store(BlogStoreRequest $request){
        $Blog = new Blog;
        $Blog->create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'user_id' => Auth::user()->id,
            'status' => 1,
            'flag_active' => 1
        ]);

        return redirect()->route('blog.index')->with(['success' => 'Berhasil Menambahkan blog']);
    }

    public function edit(Request $request, $id){
        $Blog = new Blog;
        $blog = $Blog->whereId($id)->first();
        $category = DB::table('category')->get();
        
        if($blog != null && $blog->user_id == Auth::user()->id){
            return view('blog.edit',compact('blog','category'));
        }else{
            return redirect()->route('blog.index');
        }
    }

    public function update(BlogStoreRequest $request){
        $Blog = new Blog;

        $blogWillBeUpdated = $Blog->find($request->id);

        if($blogWillBeUpdated != null && $blogWillBeUpdated->user_id ==  Auth::user()->id){
            $Blog->whereId($request->id)
                ->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'status' => 1,
                'flag_active' => $request->flag_active
                ]);
            
            return redirect()->route('blog.index')->with(['success' => 'Berhasil Mengupdate blog']);
        }else{
            return redirect()->route('blog.index')->with(['error' => 'Terjadi Keselahan Sistem']);
        }
    }

    public function delete(Request $request){
        $Blog = new Blog;
        
        $blogWillBeDelete = $Blog->find($request->id);

        if($blogWillBeDelete != null && $blogWillBeDelete->user_id ==  Auth::user()->id){
            $Blog->whereId($request->id)
                ->delete();
            
            return redirect()->route('blog.index')->with(['success' => 'Sukses Menghapus blog']);;
        }else{
            return redirect()->route('blog.index')->with(['error' => 'Terjadi Keselahan Sistem']);
        }
    }

    public function show(Request $request, $id){
        $Blog = new Blog;
        $blog = $Blog->whereId($id)->with('user')->first();

        Auth::check() ? $user_id = Auth::user()->id : $user_id = 0;

        return view('blog.show', compact('blog','user_id'));   
    }

    public function dashboard(Request $request){
        $Blog = new Blog;
        $blogs = $Blog->with('user')
            ->paginate(20);

        return view('blog.dashboard',compact('blogs'));
    }

    public function accept(Request $request, $id){
        $EmailService = new EmailService;
        $BlogService = new BlogService;

        if($BlogService->blogIsExsit($request->id)){

            $BlogService->updateBlogStatusToAccepted($request->id);
            $EmailService->sendEmailForAcceptedBlog($request->id);

            return redirect()->back()->with(['success' => 
            'Mengubah Status Blog dengan id '.$id.' menjadi accepted']);

        }else{
            return redirect()->back()->with(['error' =>'Terjadi Kesalah Sistem']);
        }


        // $Blog = new Blog;
        // $User = new User;
        
        // if($Blog->find($request->id)){
        //     $Blog->whereId($request->id)
        //         ->update([
        //             'status' => 3
        //         ]);
            
        //     $blog = $Blog->find($request->id);
        //     $author = $User->where('id',$blog->user_id)->first(); 

        //     $messageContent = "Kepada ".$author->name.
        //     "\n Kami telah menerima blog yang anda buat dengan judul "
        //     .$blog->title. ", Kami sampaikan bahwa blog anda sudah berstatus diterima, Blog anda dapat
        //     dilihat dengan mengakses link ".route('blog.show',['id' => $blog->id]);

        //     Mail::raw($messageContent,function($message) use ($author){
        //         $message->to($author->email)
        //             ->subject('Blog Accepted');
        //     });   

        //     return redirect()->back()->with(['success' =>
        //     'Mengubah Status Blog dengan id '.$id.' menjadi accepted']);
        // }else{
        //     return redirect()->back()->with(['error' =>'Terjadi Kesalah Sistem']);
        // }
    }

    public function reject(Request $request, $id){
        // $Blog = new Blog;
        // $User = new User;
        // if($Blog->find($request->id)){
        //     $Blog->whereId($request->id)
        //         ->update([
        //             'status' => 2
        //         ]);
            
        //     $blog = $Blog->find($request->id);
        //     $author = $User->where('id',$blog->user_id)->first(); 

        //     $messageContent = "Kepada ".$author->name.
        //     "\n Kami telah menerima blog yang anda buat dengan judul "
        //     .$blog->title. ", Kami sampaikan bahwa blog anda masih belum kami terima, silahkan perbaiki kembali.";

        //     Mail::raw($messageContent,function($message) use ($author){
        //         $message->to($author->email)
        //             ->subject('Blog Rejected');
        //     });

        $EmailService = new EmailService;
        $BlogService = new BlogService;

        if($BlogService->blogIsExsit($request->id)){

            $BlogService->updateBlogStatusToRejected($request->id);
            $EmailService->sendEmailForRejectedBlog($request->id);

            return redirect()->back()->with(['success' =>
            'Mengubah Status Blog dengan id '.$id.' menjadi reject']);
        }else{
            return redirect()->back()->with(['error' =>'Terjadi Kesalah Sistem']);
        }
    }

}
