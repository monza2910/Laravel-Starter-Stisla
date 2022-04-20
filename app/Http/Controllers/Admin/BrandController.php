<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\BrandRepository;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\brandStoreRequest;

class BrandController extends Controller
{
    private $brandRepository;
    private $title;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
        $this->title    = 'Brand';
    }

    public function index()
    {
        return view('admin.brands.index',[
            'title'     => $this->title,
            'brands'    => $this->brandRepository->getBrand(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create',[
            'title' => 'Create ' . $this->title
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
            'name'  => 'required|max:100|unique:brands,name|min:4',
            'slug'  => 'nullable|unique:brands,slug'
        ]);
        try {
            $this->brandRepository->store($request->all());
            Alert::success('Success','Data brand successfully added');
            return redirect()->route('brand.index');
        } catch (\Throwable $th) {
            Alert::error('Erorr','Data brand unsuccessfully added. Because '. $th);
            return redirect()->route('brand.create')->withInput($request->all());
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
        return view('admin.brands.edit',[
            'title' => "Update " . $this->title,
            'brand' => $this->brandRepository->getById($id)
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
            'name'  => 'required|max:100|min:4|unique:brands,name,'. $id.',id' ,
            'slug'  => 'nullable|min:4|max:100|unique:brands,slug,'. $id.',id'
        ]);
        try {
            $this->brandRepository->update($id, $request->all());
            Alert::success('Success','Data brand successfully updated');
            return redirect()->route('brand.index');
        } catch (\Throwable $th) {
            Alert::error('Erorr','Data brand unsuccessfully updated. Because '. $th);
            return redirect()->route('brand.edit');
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
            $this->brandRepository->destroy($id);
            Alert::success('Success','Data brand successfully deleted');
            return redirect()->route('brand.index');
        } catch (\Throwable $th) {
            Alert::error('error','Data brand unsuccessfully updated. Because '.$th);
            return redirect()->route('brand.index');
        }

    }
}
