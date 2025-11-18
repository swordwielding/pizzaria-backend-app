<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ProductCollection;
use App\Http\Resources\Api\V1\ProductResource;
use App\Services\Api\V1\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $service) {}

    public function index(Request $request)
    {
        $products = $this->service->getFiltered($request);
        return new ProductCollection($products);
    }

    public function show(string $slug)
    {
        $product = $this->service->getBySlug($slug);
        return ProductResource::make($product);
    }

    public function showById(int $id)
    {
        $product = $this->service->getById($id);
        return ProductResource::make($product);
    }
}