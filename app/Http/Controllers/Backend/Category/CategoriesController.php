<?php
/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade laravel walter package to newer
 * versions in the future.
 *
 * @category    Walter
 * @package     Laravel
 * @author      Walter Nguyen
 * @copyright   Copyright (c) Walter Nguyen
 */
namespace App\Http\Controllers\Backend\Category;

use App\Models\Category\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Backend\Category\CreateResponse;
use App\Http\Responses\Backend\Category\EditResponse;
use App\Repositories\Backend\Category\CategoryRepository;
use App\Http\Requests\Backend\Category\ManageCategoryRequest;
use App\Http\Requests\Backend\Category\CreateCategoryRequest;
use App\Http\Requests\Backend\Category\StoreCategoryRequest;
use App\Http\Requests\Backend\Category\EditCategoryRequest;
use App\Http\Requests\Backend\Category\UpdateCategoryRequest;
use App\Http\Requests\Backend\Category\DeleteCategoryRequest;

/**
 * CategoriesController
 */
class CategoriesController extends Controller
{
    /**
     * variable to store the repository object
     * @var CategoryRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param CategoryRepository $repository;
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Category\ManageCategoryRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageCategoryRequest $request)
    {
        return new ViewResponse('backend.categories.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateCategoryRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Category\CreateResponse
     */
    public function create(CreateCategoryRequest $request)
    {
        return new CreateResponse('backend.categories.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCategoryRequestNamespace  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Create the model using repository create method
        $this->repository->create($input);
        //return with successfull message
        return new RedirectResponse(route('admin.categories.index'), ['flash_success' => trans('alerts.backend.categories.created')]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Category\Category  $category
     * @param  EditCategoryRequestNamespace  $request
     * @return \App\Http\Responses\Backend\Category\EditResponse
     */
    public function edit(Category $category, EditCategoryRequest $request)
    {
        return new EditResponse($category);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCategoryRequestNamespace  $request
     * @param  App\Models\Category\Category  $category
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //Input received from the request
        $input = $request->except(['_token']);
        //Update the model using repository update method
        $this->repository->update( $category, $input );
        //return with successfull message
        return new RedirectResponse(route('admin.categories.index'), ['flash_success' => trans('alerts.backend.categories.updated')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteCategoryRequestNamespace  $request
     * @param  App\Models\Category\Category  $category
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Category $category, DeleteCategoryRequest $request)
    {
        //Calling the delete method on repository
        $this->repository->delete($category);
        //returning with successfull message
        return new RedirectResponse(route('admin.categories.index'), ['flash_success' => trans('alerts.backend.categories.deleted')]);
    }
    
}
