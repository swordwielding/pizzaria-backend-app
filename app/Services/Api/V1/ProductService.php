<?php

namespace App\Services\Api\V1;

use App\Models\Product;
use App\Filters\Api\V1\ProductFilter;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService
{
    public function __construct(
        protected ProductFilter $filter
    ) {}

    public function getFiltered(Request $request): LengthAwarePaginator
    {
        $conditions = $this->filter->transform($request);

        $query = Product::query();


        foreach($conditions as $condition)
        {
            [$type, $target, $operator, $value] = $condition;

            match($type)
            {
                'where' => $query->where($target, $operator, $value),
                'whereIn' => $query->whereIn($target, $value),
                'whereHas' => $query->whereHas($target, fn($q) => $q->whereIn('tags.id', $value)),
            };

        }

        return $query->with(['category', 'tags'])->paginate(50)->appends($request->query());
    }

    public function getBySlug(string $slug): Product
    {
        return Product::where('slug', $slug)->with(['category', 'tags'])->firstOrFail();
    }

    public function getById(int $id): Product
    {
        return Product::with(['category', 'tags'])->findOrFail($id);
    }
}