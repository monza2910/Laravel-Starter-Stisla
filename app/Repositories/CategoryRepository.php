<?php

namespace App\Repositories;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryRepository
{

    public function getOrderBy()
    {
        $categories   = Category::orderBy('id','desc')->get();
        return $categories;
    }

    public function getById($id)
    {
        $category  = Category::findOrFail($id);
        return $category;
    }

    public function store(array $data)
    {
        if (!empty($data['slug'])) {
            $slug   = Str::slug($data['slug']);
        } else {
            $slug   = Str::slug($data['name']);
        }

        Category::create([
            'name'  => $data['name'],
            'slug'  => $slug
        ]);
    }

    public function update($id, array $data)
    {
        if (!empty($data['slug'])) {
            $slug   = Str::slug($data['slug']);
        } else {
            $slug   = Str::slug($data['name']);
        }

        Category::find($id)->update([
            'name'  => $data['name'],
            'slug'  => $slug
        ]);
    }

    public function destroy($id)
    {
        $category   = Category::find($id);
        $category->delete();
    }
}

