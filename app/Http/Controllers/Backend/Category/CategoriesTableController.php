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

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Category\CategoryRepository;
use App\Http\Requests\Backend\Category\ManageCategoryRequest;

/**
 * Class CategoriesTableController.
 */
class CategoriesTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var CategoryRepository
     */
    protected $category;

    /**
     * contructor to initialize repository object
     * @param CategoryRepository $category;
     */
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    /**
     * This method return the data of the model
     * @param ManageCategoryRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageCategoryRequest $request)
    {
        return Datatables::of($this->category->getForDataTable())
            ->escapeColumns(['id'])
            ->escapeColumns(['name'])
            ->addColumn('status', function ($category) {
                return $category->status == 1 ? "Hoạt động" : "Không hoạt động";
            })
            ->addColumn('created_at', function ($category) {
                return Carbon::parse($category->created_at)->toDateString();
            })
            ->addColumn('actions', function ($category) {
                return $category->action_buttons;
            })
            ->make(true);
    }
}
