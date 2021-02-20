<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::when($request->search, function ($query) use ($request) {

            return $query->whereTranslationLike('name', $request->search);
        })->when($request->category_id, function ($query) use ($request) {

            return $query->where('category_id', $request->category_id);
        })->latest()->paginate(5);

        return view('products.index', compact('categories', 'products'));
    }

    public function create()
    {

        $categories = Category::all();


        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $rules = [

            'category_id' => 'required'
        ];

        foreach (\config('translatable.locales') as $local) {

            $rules += [$local . '.name' => 'required'];
            $rules += [$local . '.description' => 'required'];
        }
        $rules += [

            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required'
        ];
        $request->validate($rules);
        $request_data = $request->all();

        if ($request->image) {

            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('productImage/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

        Product::create($request_data);

        session()->flash('Add');

        return \redirect()->route('products.index');
    }

    public function edit(Product $product)
    {

        $categories = Category::all();


        return view('products.edit', compact('categories', 'product'));
    }

    public function update(Request $request, Product $product)
    {
        $rules = [

            'category_id' => 'required'
        ];

        foreach (\config('translatable.locales') as $local) {

            $rules += [$local . '.name' => 'required'];
            $rules += [$local . '.description' => 'required'];
        }
        $rules += [

            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required'
        ];
        $request->validate($rules);
        $request_data = $request->all();

        if ($request->image) {

            if ($product->image != 'default.png') {
                unlink(public_path() .  '/productImage/' . $product->image);
            }
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('productImage/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

        $product->update($request_data);

        session()->flash('Edit');

        return \redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {

        // delete images from server
        if ($product->image != 'default.png') {
            unlink(public_path() .  '/productImage/' . $product->image);
        }
        // delete users
        $product->delete();
        session()->flash('Delete');
        return \redirect()->route('products.index');
    }
}
