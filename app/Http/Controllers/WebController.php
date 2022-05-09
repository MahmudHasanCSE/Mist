<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Session;

use Illuminate\Http\Request;

class WebController extends Controller
{
    //

    private $recentBlogs;
    private $blog;
    private $blogs;
    private $categories;
    private $comment;

    public function index()
    {
        $this->recentBlogs = Blog::where('status', 1)->orderBy('id', 'desc')->take('3')->get();
        return view('website.home.home', [
            'recent_blogs' => $this->recentBlogs,
        ]);
    }

    public function post($id)
    {
        $this->blog = Blog::find($id);
        $this->blogs = Blog::where('status', 1)->orderBy('id', 'desc')->take('3')->get();
        return view('website.post.post', [
            'blog'  => $this->blog,
            'blogs' => $this->blogs,
        ]);
    }

    public function author()
    {
        return view('website.author.author');
    }
}
