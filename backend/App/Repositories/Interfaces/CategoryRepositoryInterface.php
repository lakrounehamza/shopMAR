<?php

namespace App\Repositories\Interfaces;
use App\Http\Requests\CreateCategory;
use App\Http\Requests\UpdateCategory;
interface CategoryRepositoryInterface
{
    public function getAllCategories();
    public function getCategoryById($id);
    public function createCategory(CreateCategory $data);
    public function updateCategory($id, UpdateCategory $data);
    public function deleteCategory($id);
    public function getCategoryByName($name);
    public function getCategoriesWithProducts(); 
}
