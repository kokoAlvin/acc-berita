<?php

namespace App\Services;

use App\Blog;

class BlogService
{
    public function updateBlogStatusToAccepted($id)
    {
        $Blog = new Blog;

        $Blog->whereId($id)
            ->update([
                'status' => 3
            ]);
    }

    public function updateBlogStatusToRejected($id)
    {
        $Blog = new Blog;

        $Blog->whereId($id)
            ->update([
                'status' => 2
            ]);
    }

    public function blogIsExsit($id)
    {
        $Blog = new Blog;

        if($Blog->find($id))
            return true;
        else
            return false;
    }
}