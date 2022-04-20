<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    private $categoryRepository;
    private $titleCategory;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->titleCategory = 'Category';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index',
        [
            'title'     => $this->titleCategory,
            'categories'  => $this->categoryRepository->getOrderBy()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create',[
            'title' => 'Create ' . $this->titleCategory
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
            'name'  => 'required|max:100|unique:categories,name|min:4',
            'slug'  => 'nullable|unique:categories,slug'
        ]);

        $data = $request->all();

        try {
            $this->categoryRepository->store($data);
            Alert::success('Success','Data category successfully added');
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            Alert::error('Erorr','Data category unsuccessfully added. Because '. $th);
            return redirect()->route('category.create')->withInput($request->all());
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
        return view('admin.categories.edit',[
            'title' => "Update " . $this->titleCategory,
            'category' => $this->categoryRepository->getById($id)
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
            'name'  => 'required|max:100|min:4|unique:categories,name,'. $id.',id' ,
            'slug'  => 'nullable|min:4|max:100|unique:categories,slug,'. $id.',id'
        ]);
        $data       = $request->all();
        try {
            $this->categoryRepository->update($id, $data);
            Alert::success('Success','Data category successfully updated');
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            Alert::error('Erorr','Data category unsuccessfully updated. Because '. $th);
            return redirect()->route('category.edit');
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
            $this->categoryRepository->destroy($id);
            Alert::success('Success','Data category successfully deleted');
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            Alert::error('Erorr','Data category unsuccessfully deleted. Because '. $th);
            return redirect()->route('category.index');
        }
    }
}
