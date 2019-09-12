<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategory;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create', [
            'categories' => Category::pluck('id', 'name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategory  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategory $request): RedirectResponse
    {
        $category = new Category([
            'name' => $request->input('name'),
        ]);

        $parentId = $request->input('parent_id');
        if (!empty($parentId)) {
            $parentCategory = Category::findOrFail($parentId);

            $category->parent()->associate($parentCategory);
        }

        $category->save();

        return redirect()->back()->with([
            'success' => 'Successfully created.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', [
            'category'   => $category,
            'categories' => Category::pluck('id', 'name'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategory  $request
     * @param  Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreCategory $request, Category $category): RedirectResponse
    {
        $category->update([
            'name' => $request->input('name'),
        ]);

        $parentId = $request->input('parent_id');
        if (!empty($parentId)) {
            $parentCategory = Category::find($parentId);

            $category->parent()->associate($parentCategory);
        } else {
            $category->parent()->dissociate();
        }

        $category->save();

        return redirect()->back()->with([
            'success' => 'Successfully updated.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->back()->with([
            'success' => 'Successfully deleted.',
        ]);
    }
}
