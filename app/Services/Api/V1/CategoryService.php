<?php

namespace App\Services\Api\V1;

use App\Models\Category;
use App\Filters\Api\V1\CategoryFilter;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryService
{
    public function __construct(
        protected CategoryFilter $filter
    ) {}

    public function getFiltered(Request $request): LengthAwarePaginator
    {
        $conditions = $this->filter->transform($request);

        $query = Category::query();


        foreach($conditions as $condition)
        {
            [$type, $target, $operator, $value] = $condition;

            match($type)
            {
                'where' => $query->where($target, $operator, $value),
                'whereIn' => $query->whereIn($target, $value),
                'whereHas' => $query->whereHas($target, fn($q) => $q->whereIn('id', $value)),
            };

        }

        return $query->with(['products'])->paginate(50)->appends($request->query());
    }


    public function getById(int $id): Category
    {
        return Category::with(['products'])->findOrFail($id);
    }
}