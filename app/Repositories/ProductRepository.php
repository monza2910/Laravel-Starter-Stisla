<?php

namespace App\Repositories;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductRepository
{
    public function getProduct()
    {
        $products   = Product::with(['categories','brands'])->orderBy('id','desc')->get();
        return $products;
    }

    public function storeProduct($data){
        if (!empty($data['slug'])) {
            $slug   = Str::slug($data['slug']);
        } else {
            $slug   = Str::slug($data['name']);
        }

        $product = Product::create([
            'name'          => $data['name'],
            'slug'          => $slug,
            'description'   => $data['description'],
            'content'       => $data['content'],
            'status'        => $data['status'],
            'price'         => $data['price'],
            'qty'           => $data['qty'],
            'brand_id'      => $data['brand']
        ]);

        $product->categories()->attach($data['category']);
    }

    public function getProductById($id)
    {
        $product    = Product::findOrFail($id);
        return $product;
    }

    public function updateProduct($id,$data)
    {
        if (!empty($data['slug'])) {
            $slug   = Str::slug($data['slug']);
        } else {
            $slug   = Str::slug($data['name']);
        }

        $product = Product::find($id);
        $product->update([
            'name'          => $data['name'],
            'slug'          => $slug,
            'description'   => $data['description'],
            'content'       => $data['content'],
            'status'        => $data['status'],
            'price'         => $data['price'],
            'qty'           => $data['qty'],
            'brand_id'      => $data['brand']
        ]);

        $product->categories()->sync($data['category']);
    }

    public function softDeleteProduct($id)
    {
        $product    = Product::find($id);
        $product->delete();
    }

    public function trashProduct()
    {
        $products   = Product::onlyTrashed()->with(['categories','brands'])->orderBy('id','desc')->get();
        return $products;
    }

    public function restoreProduct($id)
    {
        $product    = Product::withTrashed()->find($id);
        $product->restore();
    }

    public function forceDeleteProduct($id)
    {
        $product   = Product::withTrashed()->find($id);
        $product->forceDelete();
    }
}
