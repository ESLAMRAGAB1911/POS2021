<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\validation\Rule;

class CategoryController extends Controller
{

    public function __construct()
    {   
        $this->middleware(['permission:categories-create'])->only('create');
        $this->middleware(['permission:categories-update'])->only('edit');
        $this->middleware(['permission:categories-read'])->only('index');
        $this->middleware(['permission:categories-delete'])->only('delete');
    }
    public function index(Request $request)
    {

        $categories = Category::when($request->search, function ($query) use ($request) {

            return $query->whereTranslationLike('name', $request->search);
        })->latest()->paginate(5);


        return view('categories.index', compact('categories'));
    }

    public function create()
    {

        return \view('categories.create');
    }

    public function store(Request $request)
    {

        $rules = [];

        foreach (\config('translatable.locales') as $local) {

            $rules += [$local . '.name' => ['required', Rule::unique('category_translations', 'name')]];
        }

        $request->validate($rules);

        $categories = Category::create($request->all());

        session()->flash('Add');

        return \redirect()->route('categories.index');
    }

    public function edit($id)
    {

        $categories = Category::findOrFail($id);

        return view('categories.edit', compact('categories'));
    }

    public function update(Request $request, Category $category)
    {
        $rules = [];

        foreach (config('translatable.locales') as $local) {

            $rules += [$local . '.name' => ['required', Rule::unique('category_translations', 'name')]];
        }

        $request->validate($rules);

        $category->update($request->all());

        session()->flash('Edit');

        return \redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {


        // delete categories
        $category->delete();
        session()->flash('Delete');
        return \redirect()->route('categories.index');
    }
}
