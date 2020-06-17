<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{

    /**
     * Get all repositories
     */
    public function all()
    {
        $categories = Category::all();

        return $categories;
    }

    /**
     * Get all repositories with there courses
     */
    public function allWithCourses()
    {
        $categories = Category::with('courses')
            ->all();

        return $categories;
    }

    /**
     * Get one category by given id
     */
    public function find($id)
    {
        $category = Category::find($id);

        if (is_null($category)) {
            return new Collection;
        } else {
            return $category;
        }
    }

    /**
     * Get one category with its courses by given id
     */
    public function findWithCourses($id)
    {
        $category = Category::with('courses')
            ->find($id);

        if (is_null($category)) {
            return new Collection;
        } else {
            return $category;
        }
    }
}
