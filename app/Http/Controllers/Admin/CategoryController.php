<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepository;
    
    /**
     * CategoryController constructor.
     * 
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->paginate();
        
        return view('admin.categories.index', compact('categories'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = $this->categoryRepository->all();
        
        return view('admin.categories.create', compact('parentCategories'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryRepository->create($request->validated());
        
        return redirect()->route('admin.categories.index')
                        ->with('success', __('Category created successfully'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);
        
        return view('admin.categories.show', compact('category'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        $parentCategories = $this->categoryRepository->all()->except($id);
        
        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->categoryRepository->update($request->validated(), $id);
        
        return redirect()->route('admin.categories.index')
        ->with('success', __('Category updated successfully'));

    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        
        return redirect()->route('admin.categories.index')
                        ->with('success', __('Category deleted successfully.'));
    }
    
    /**
     * Get categories in tree structure.
     *
     * @return \Illuminate\Http\Response
     */
    public function tree()
    {
        $categories = $this->categoryRepository->getTree();
        
        return view('admin.categories.tree', compact('categories'));
    }
}
