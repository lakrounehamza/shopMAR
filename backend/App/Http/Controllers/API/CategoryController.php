<?php

namespace App\Http\Controllers\API;

use App\Repositories\CategoryRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategory;
use App\Http\Requests\UpdateCategory; 

class CategoryController extends Controller
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
 
    public function index()
    {
        return $this->categoryRepository->getAllCategories();
    }
 
    public function show($id)
    {
        return $this->categoryRepository->getCategoryById($id);
    }
 
    public function store(CreateCategory $request)
    {
        return $this->categoryRepository->createCategory($request);
    }
 
    public function update(UpdateCategory $request, $id)
    {
        return $this->categoryRepository->updateCategory($id, $request);
    }
 
    public function destroy($id)
    {
        return $this->categoryRepository->deleteCategory($id);
    }
 
    public function findByName($name)
    {
        return $this->categoryRepository->getCategoryByName($name);
    }
 
    public function categoriesWithProducts()
    {
        return $this->categoryRepository->getCategoriesWithProducts();
    }
}