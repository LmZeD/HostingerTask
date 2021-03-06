<?php

namespace App\Repositories;

use App\Category;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryInterface
{
    private $categoryModel;

    public function __construct(Category $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    /**
     * Gets all elements from database in recursive manner.
     *
     * @return mixed
     */
    public function getChildrenRecursive()
    {
        return $this->categoryModel->where('parent_id', null)->with('getChildrenRecursive')->get();
    }

    /**
     * Gets top level parents from database
     *
     * @return mixed
     */
    public function getTopLevelParents()
    {
        return $this->categoryModel->where('parent_id', null)->get();
    }

    /**
     * Stores new category to database
     *
     * @param array $args
     *
     * @return bool
     */
    public function store(array $args): bool
    {
        try {
            $this->categoryModel->create($args);
        } catch (\Exception $ex) {
            return false;
        }
        return true;
    }

    /**
     * Gets all repositories
     *
     * @return mixed
     */
    public function all()
    {
        return $this->categoryModel->all();
    }
}