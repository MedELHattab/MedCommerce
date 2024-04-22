<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CategoryService; 
use Illuminate\Http\Request;
use App\Models\Category; // Added model import
use Illuminate\Support\Facades\Gate;


class CategoryController extends Controller
{
    public function __construct(
      protected CategoryService $categoryService 
    ) {
        $this->middleware(function ($request, $next) {
            if (Gate::denies('isAdmin')) {
                abort(403, 'Unauthorized action.');
            }

            return $next($request);
        });
    }

    public function index()
    {
        $categories = $this->categoryService->all(); 
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Added image validation
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/categories/';
            $file->move($path, $fileName);
            $data['image'] = $fileName; 
        }

        $category = $this->categoryService->create($data); 

        return redirect()->route('categories')->with("success","category created with success");
    }

    public function show($id)
    {
        $category = $this->categoryService->find($id); 
        return view('categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = $this->categoryService->find($id); 
        return view('categories.edit', compact('category')); 
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Added image validation
        ]);
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/categories/';
            $file->move($path, $fileName);
            $data['image'] = $fileName; 
        }
    
        $category = $this->categoryService->update($data, $category->id); // Fixed update call
    
        return redirect()->route('categories')->with("success","category updated with success");
    }

    public function destroy($id)
    {
        $this->categoryService->delete($id); 

        return redirect()->route('categories')->with("success","category deleted with success");
    }
}
