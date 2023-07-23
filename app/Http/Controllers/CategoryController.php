<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per_page parameter must be an integer between 1 and 100.');
        }

        $categories = Category::filter(request(['search']))
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view ('admin.category.index', [
            'categories' => $categories,
            'page_title' => 'Categories List'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.category.create', [
            'page_title' => 'Create Category'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  'name' => 'required|unique:categories, name' =>>>>> This rule checks the uniqueness of the 'name' field value within the 'categories' table. It ensures that no other records in the 'categories' table have the same value for the 'name' field. If a duplicate value is found, the validation will fail.

        // 'slug' => 'required|unique:categories,slug|alpha_dash' This rule specifies that the 'slug' field must only contain alphanumeric characters, dashes, and underscores. If the 'slug' field contains any other characters, the validation will fail.

        $this->validate($request, [
            'name'    => 'required|unique:categories,name',
            'slug'    => 'required|unique:categories,slug|alpha_dash'
        ]);

        $category = new Category();

        $category->name = $request->name ?? "";
        $category->slug = $request->slug ?? '';

        try {
            $category->save();
            return redirect()->route('admin.category.index')->with('success', 'Category created successfully!');

        } catch (\Exception) {
            return redirect()->back()->with('error', 'Failed to create category. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, $id)
    {
        $category = Category::find($id);

        $page_title = "Edit Category";

        return view('admin.category.update', compact('category', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        //'name' => 'required|unique:categories,name,'.$category->id, $category->id: ====>> It specifies that the current record with the ID $category->id should be excluded from the uniqueness check. In other words, it allows the current record to have the same name as it had before without causing a validation error. This is useful when updating an existing record and you want to allow the record to keep its original name.

        $this->validate($request, [
            'name' => 'required|unique:categories,name,'.$category->id,
            'slug' => 'required|alpha_dash|unique:categories,slug,'.$category->id,
        ]);

        try {

            $category = Category::find($request->id);

            // Update the properties of the $category object
            $category->name = $request->name;
            $category->slug = $request->slug;
    
            // Save the changes to the database
            $category->save();
    
            return redirect()->route('admin.category.index')->with('success', 'Category updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update the category. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, $id)
    {
        $category = Category::find($id);

        try {
            $category->delete();
            return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully!');

            
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Failed to delete the category. Please try again.');
        }
    }
}
