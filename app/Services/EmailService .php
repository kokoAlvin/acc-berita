<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Blog;
use App\User;

class EmailService
{
    public function sendEmailForRejectedBlog($id)
    {
        $Blog = new Blog;
        $User = new User;

        $blog = $Blog->find($request->id);
        $author = $User->where('id',$blog->user_id)->first(); 

        $messageContent = "Kepada ".$author->name.
        "\n Kami telah menerima blog yang anda buat dengan judul "
        .$blog->title. ", Kami sampaikan bahwa blog anda masih belum kami terima, silahkan perbaiki kembali.";

        Mail::raw($messageContent,function($message) use ($author){
            $message->to($author->email)
                ->subject('Blog Rejected');
        });

    }

    public function sendEmailForAcceptedBlog($id)
    {
        $Blog = new Blog;
        $User = new User;

        $blog = $Blog->find($request->id);
        $author = $User->where('id',$blog->user_id)->first(); 

        $messageContent = "Kepada ".$author->name.
        "\n Kami telah menerima blog yang anda buat dengan judul "
        .$blog->title. ", Kami sampaikan bahwa blog anda sudah berstatus diterima, Blog anda dapat
        dilihat dengan mengakses link ".route('blog.show',['id' => $blog->id]);

        Mail::raw($messageContent,function($message) use ($author){
            $message->to($author->email)
                ->subject('Blog Accepted');
        });   

    }
}