<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use Illuminate\Support\Facades\Cache;
use App\Traits\ClearFrontendCacheTrait;

class ProductController extends Controller
{
    use ClearFrontendCacheTrait;
    
    public function index()
    {
        $products = Product::with(['category', 'tags'])->get();
        $categories = Category::orderBy('id')->get();
        $tags = Tag::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('products.create', compact('categories', 'tags'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $imagePath = $request->file('image')->store('products', 'public');

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'is_available' => $request->boolean('is_available'),
        ]);

        $this->clearFrontendCache('products');

        if($request->has('tags'))
        {
            $product->tags()->sync($request->tags);
        }

        return redirect()->route('products.index');

    }

    public function show(Product $product)
    {
        $products = Product::with(['category', 'tags']);
        $category = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('products.show', compact('product', 'category', 'tags'));
    }

    public function edit(Product $product)
    {
        
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('products.edit', compact('product', 'categories', 'tags'));

    }

    
    public function update(UpdateRequest $request, Product $product)
    {

        $data = $request->only(['name', 'description', 'price', 'category_id', 'is_available']);

        if($request->hasFile('image'))
        {
            Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['slug'] = Str::slug($request->name);
        $data['is_available'] = $request->input('is_available', 0);

        $product->update($data);

        $tags = $request->tags ?? [];
        $tags = array_filter($tags);
        $product->tags()->sync($tags);

        $this->clearFrontendCache('products');
        $this->clearFrontendCache("product_{$product->getOriginal('slug')}");
        $this->clearFrontendCache("product_{$product->slug}");
        
        return redirect()->route('products.index');
    }

    
    public function destroy(Product $product)
    {
        $slug = $product->slug;

        $product->tags()->detach();
        Storage::disk('public')->delete($product->image);
        $product->delete();

        $this->clearFrontendCache('products');
        $this->clearFrontendCache("product_{$slug}");

        return redirect()->route('products.index');
    }


}