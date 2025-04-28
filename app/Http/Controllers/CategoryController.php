<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
       $category = Category::paginate(9);
       return view('dashboard.category.category', ['category'=>$category] );
    }

    public function add()
    {
        return view('dashboard.category.categoryadd');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:categories,name'],
        ]);

        Category::create($data);

        return redirect()->route('category.index');
    }

    public function show(Category $category)
    {

         return view('dashboard.category.categoryedit', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required'],
        ]);

        $category->update($data);

        return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {

        $category->delete();

        return back();
    }
}
