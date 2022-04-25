<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\BrandRepository;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private $mediaCollection = 'photo';
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
            'products'  => $this->productRepository->getProduct(),
            'mediaCollection' => $this->mediaCollection
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

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

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
            'photo'     => 'required|max:2048'
        ]);


        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['photo'] = $request->photo;
            $this->productRepository->storeProduct($data);
            Alert::success('Success', 'You have successfully created Product.');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error', 'You have unsuccessfully created Product. Because '.$th);
            return redirect()->route('product.create')->withInput($request->all());
        }finally{
            DB::commit();
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
            'brands'        =>  $this->brandRepository->getBrand(),
            'photos'        =>  $this->productRepository->getProductById($id)->getMedia($this->mediaCollection)
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
            'photo'     => 'required|max:2048'
        ]);
        try {
            $data = $request->all();
            $data['photo'] = $request->photo;
            $this->productRepository->updateProduct($id,$data);
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
