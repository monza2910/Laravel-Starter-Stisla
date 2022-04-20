<?php
namespace App\Repositories;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandRepository
{
    public function getBrand()
    {
        $brands   = Brand::orderBy('id','desc')->get();
        return $brands;
    }

    public function getById($id)
    {
        $brand  = Brand::findOrFail($id);
        return $brand;
    }

    public function store(array $data)
    {
        if (!empty($data['slug'])) {
            $slug   = Str::slug($data['slug']);
        } else {
            $slug   = Str::slug($data['name']);
        }

        Brand::create([
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

        Brand::find($id)->update([
            'name'  => $data['name'],
            'slug'  => $slug
        ]);
    }

    public function destroy($id)
    {
        $brand   = Brand::find($id);
        $brand->delete();
    }

}
