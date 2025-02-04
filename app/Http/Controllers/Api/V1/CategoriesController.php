<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\ReplaceCategoryRequest;
use App\Http\Requests\Api\V1\StoreCategoryRequest;
use App\Http\Requests\Api\V1\UpdateCategoryRequest;
use App\Http\Resources\V1\CategoriesResource;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class CategoriesController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoriesResource::collection(Category::paginate());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request, User $user)
    {
        if (!Gate::allows('create-category', $user)) {
            return $this->notAuthorized('You are not allowed to create categories.');
        }
        $category = Category::create($request->mappedAttributes());
        return new CategoriesResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
       return new CategoriesResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if (!Gate::allows('update-category', $category)) {
            return $this->notAuthorized('You are not allowed to update categories.');
        }
        $category->update($request->mappedAttributes());
        return new CategoriesResource($category);
    }

    public function replace(ReplaceCategoryRequest $request, Category $category)
    {
        if (!Gate::allows('replace-category', $category)) {
            return $this->notAuthorized('You are not allowed to replace categories.');
        }
        $category->update($request->mappedAttributes());
        return new CategoriesResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (!Gate::allows('delete-category', $category)) {
            return $this->notAuthorized('You are not allowed to delete categories.');
        }
        $category->delete();
        return $this->ok('Category deleted');
    }
}
