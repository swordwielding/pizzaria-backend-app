<?php

namespace App\Services\Api\V1;

use App\Models\Tag;
use App\Filters\Api\V1\TagFilter;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TagService
{
    public function __construct(
        protected TagFilter $filter
    ) {}

    public function getFiltered(Request $request): LengthAwarePaginator
    {
        $conditions = $this->filter->transform($request);

        $query = Tag::query();


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


    public function getById(int $id): Tag
    {
        return Tag::with(['products'])->findOrFail($id);
    }
}