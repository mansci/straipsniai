<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategory;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.index', ['categories' => Category::all()]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCategory  $requestE
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $category = Category::create($request->validated());
        return redirect()->route('categories.index')->with('success', 'categories.create');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'categories.destroy');
        } catch (QueryException $e) {
            return redirect()->route('categories.index')->with('alert', 'categories.destroy');
        }
    }
}
