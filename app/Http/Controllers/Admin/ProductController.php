<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\BrandRepository;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    private $productRepository;
    private $categoryRepository;
    private $brandRepository;
    private $title;
    public function __construct(ProductRepository $productRepository,CategoryRepository $categoryRepository, BrandRepository $brandRepository)
    {
        $this->productRepository    = $productRepository;
        $this->categoryRepository   = $categoryRepository;
        $this->brandRepository   = $brandRepository;
        $this->title    = 'Product';
    }
    public function index()
    {
        return view('admin.products.index',[
            'title' => $this->title,
            'products'  => $this->productRepository->getProduct()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create',[
            'title'         => 'Create ' . $this->title,
            'categories'    => $this->categoryRepository->getCategory(),
            'brands'        => $this->brandRepository->getBrand()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|max:100|min:4|unique:products,name' ,
            'slug'  => 'nullable|min:4|max:100|unique:products,slug',
            'description'   => 'required|min:4',
            'content'   => 'required|min:4',
            'status'   => 'required',
            'price'   => 'required|integer',
            'qty'   => 'required|integer',
            'brand'   => 'required|integer',
            'category'   => 'required',
        ]);

        try {
            $this->productRepository->storeProduct($request->all());
            Alert::success('Success', 'You have successfully created Product.');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            Alert::error('Error', 'You have unsuccessfully created Product. Because '.$th);
            return redirect()->route('product.create')->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.products.edit',[
            'title'         =>  'Edit ' . $this->title,
            'product'       =>  $this->productRepository->getProductById($id),
            'categories'    =>  $this->categoryRepository->getCategory(),
            'brands'        =>  $this->brandRepository->getBrand()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|max:100|min:4|unique:products,name,'.$id.',id' ,
            'slug'  => 'nullable|min:4|max:100|unique:products,slug,'.$id.',id',
            'description'   => 'required|min:4',
            'content'   => 'required|min:4',
            'status'   => 'required',
            'price'   => 'required|integer',
            'qty'   => 'required|integer',
            'brand'   => 'required|integer',
            'category'   => 'required',
        ]);
        try {
            $this->productRepository->updateProduct($id,$request->all());
            Alert::success('Success', 'You have successfully updated Product.');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            Alert::error('Error', 'You have unsuccessfully updated Product. Because '.$th);
            return redirect()->route('product.edit',$id)->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->productRepository->softDeleteProduct($id);
            Alert::success('Success', 'You have successfully deleted Product.');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            Alert::error('Error', 'You have unsuccessfully deleted Product. Because '.$th);
            return redirect()->route('product.index');
        }
    }

    public function trash()
    {
        return view('admin.products.trash',
        [
            'title' => 'Deleted ' . $this->title,
            'products'   => $this->productRepository->trashProduct()
        ]);
    }

    public function restore($id){
        try {
            $this->productRepository->restoreProduct($id);
            Alert::success('Success', 'You have successfully restore Product.');
            return redirect()->route('product.trash');
        } catch (\Throwable $th) {
            Alert::error('Error', 'You have unsuccessfully restore Product. Because '.$th);
            return redirect()->route('product.trash');
        }
    }

    public function forceDelete($id)
    {
        try {
            $this->productRepository->forceDeleteProduct($id);
            Alert::success('Success', 'You have successfully deleted permanently Product.');
            return redirect()->route('product.trash');
        } catch (\Throwable $th) {
            Alert::error('Error', 'You have unsuccessfully deleted permanently Product. Because '.$th);
            return redirect()->route('product.trash');
        }
    }
}
