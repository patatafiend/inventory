<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        $units = Unit::all();
        return view('categories.index', compact('categories', 'units'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        if($validator -> fails()){
            $errors[] = 'invalid input';
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $category =  Category::create($request->all());

        $level = 0;
        if ($category->parent_id) {
            $parentCategory = Category::find($category->parent_id);
            $level = $parentCategory->level + 1;
        }
        
        $html = view('categories.category-list-item', ['category' => $category, 'level' => $level])->render();

        return response()->json([
            'success' => 'added',
            'message' => 'Category added successfully!',
            'html' => $html
        ]);
    }


    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return response()->json([
            'success' => 'updated',
            'message' => 'Category Updated'
        ]);
    }

    public function destroy(Category $category)
    {
        if ($category->children()->count() > 0 || $category->products()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Cannot delete a category that has subcategories or products!');
        }
    
        $category->delete();
        
        return response()->json([
            'success' =>  'deleted',
            'message' => 'Category deleted successfully'
        ]);
    }
    
}
