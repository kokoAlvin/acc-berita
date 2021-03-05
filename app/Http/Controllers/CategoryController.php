<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Blog;
use App\Category;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Services\EmailService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\BlogService;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
         $this->middleware('auth');

    }

    public function index(Request $request){
        $category = DB::table('category')->get();

        return view('category.index',['category' => $category]);
    }

    public function create(Request $request){
        return view('category.create');
    }

    public function store(Request $request){
        $Category = new Category;
        $Category->create([
            'category_name' => $request->category_name
        ]);

        return redirect()->route('category.index')->with(['success' => 'Berhasil Menambahkan category']);
    }

    public function edit(Request $request, $id){
        $Category = new Category;
        $category = $Category->whereId($id)->first();
        
        if($category != null){
            return view('category.edit',compact('category'));
        }else{
            return redirect()->route('category.index');
        }
    }

    public function update(Request $request){
        $Category = new Category;

        $categoryWillBeUpdated = $Category->find($request->id);

        if($categoryWillBeUpdated != null){
            $Category->whereId($request->id)
                ->update([
                'category_name' => $request->category_name,
                ]);
            
            return redirect()->route('category.index')->with(['success' => 'Berhasil Mengupdate category']);
        }else{
            return redirect()->route('category.index')->with(['error' => 'Terjadi Keselahan Sistem']);
        }
    }
}
