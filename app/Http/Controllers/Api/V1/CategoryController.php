<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\Api\V1\CategoryResource;
use App\Filters\Api\V1\CategoryFilter;
use App\Http\Resources\Api\V1\CategoryCollection;
use Illuminate\Http\Request;
use App\Services\Api\V1\CategoryService;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $service) {}
    
    public function index(Request $request)
    {
        $categories = $this->service->getFiltered($request);
        return new CategoryCollection($categories);
    }

    public function show(int $id)
    {
        $category = $this->service->getById($id);
        return CategoryResource::make($category);
    }
}