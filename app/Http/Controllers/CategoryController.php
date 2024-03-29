<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    private $category;
    private $categories;

    public function index()
    {
        return view('admin.category.add');
    }

    public function create(Request $request)
    {
        Category::newCategory($request);
        return redirect()->back()->with('message', 'Category Created successfully!');
    }

    public function manage()
    {
        $this->categories = Category::orderBy('id', 'desc')->get();
        return view('admin.category.manage', [
            'categories' => $this->categories
        ]);
    }

    public function edit($id)
    {
        $this->category = Category::find($id);
        return view('admin.category.edit', ['category' => $this->category]);
    }

    public function update(Request $request, $id)
    {
        Category::updateCategory($request, $id);
        return redirect('/manage-category')->with('message', 'Category info update successfully.');
    }

    public function delete($id)
    {
        $this->category = Category::find($id);
        $this->category->delete();
        return redirect('/manage-category')->with('message', 'Category info delete successfully.');
    }
}


