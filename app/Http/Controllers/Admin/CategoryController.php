<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{

    private $categoryRepository;
    private $titleCategory;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->titleCategory = 'Category';
    }

    public function index()
    {
        return view('admin.categories.index',
        [
            'title'     => $this->titleCategory,
            'categories'  => $this->categoryRepository->getOrderBy()
        ]);
    }

    public function create()
    {
        return view('admin.categories.create',[
            'title' => 'Create ' . $this->titleCategory
        ]);
    }

    public function store(CategoryStoreRequest $request)
    {
        try {
            $this->categoryRepository->store($request->all());
            Alert::success('Success','Data category successfully added');
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            Alert::error('Erorr','Data category unsuccessfully added. Because '. $th);
            return redirect()->route('category.create')->withInput($request->all());
        }

    }

    public function edit($id)
    {
        return view('admin.categories.edit',[
            'title' => "Update " . $this->titleCategory,
            'category' => $this->categoryRepository->getById($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|max:100|min:4|unique:categories,name,'. $id.',id' ,
            'slug'  => 'nullable|min:4|max:100|unique:categories,slug,'. $id.',id'
        ]);
        try {
            $this->categoryRepository->update($id, $request->all());
            Alert::success('Success','Data category successfully updated');
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            Alert::error('Erorr','Data category unsuccessfully updated. Because '. $th);
            return redirect()->route('category.edit');
        }
    }

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
