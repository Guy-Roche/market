<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //category management
    public function categories()
    {
        $compteur = 1;
        $categories = Category::get();
        return view('admin.categories.categories', compact('categories', 'compteur'));
    }

    public function add()
    {
        return view('admin.categories.add');
    }

    public function save(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name',
        ],
        [
            'category_name.required' => 'Please enter a category name.',
            'category_name.unique' => 'This category name already exists.',
        ]);
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        $notification = array(
            'message' => 'Category added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('categories')->with($notification);
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name,' . $id,
        ],
        [
            'category_name.required' => 'Please enter a category name.',
            'category_name.unique' => 'This category name already exists.',
        ]);

        $category = Category::findOrFail($id);
        $category->category_name = $request->category_name;
        $category->update();
        $notification = array(
            'message' => 'Category updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('categories')->with($notification);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        $notification = array(
            'message' => 'Category deleted successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('categories')->with($notification);
    }
}
