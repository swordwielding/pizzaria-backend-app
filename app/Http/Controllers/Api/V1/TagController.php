<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Http\Resources\Api\V1\TagResource;
use App\Filters\Api\V1\TagFilter;
use App\Http\Resources\Api\V1\TagCollection;
use Illuminate\Http\Request;
use App\Services\Api\V1\TagService;

class TagController extends Controller
{
    public function __construct(protected TagService $service) {}

    public function index(Request $request)
    {
        $tags = $this->service->getFiltered($request);
        return new TagCollection($tags);
    }
    
    public function show(int $id)
    {
        $tag = $this->service->getById($id);
        return TagResource::make($tag);
    }
}