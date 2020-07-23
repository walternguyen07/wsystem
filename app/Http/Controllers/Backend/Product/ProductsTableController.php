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

namespace App\Http\Controllers\Backend\Product;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Product\ProductRepository;
use App\Http\Requests\Backend\Product\ManageProductRequest;

/**
 * Class ProductsTableController.
 */
class ProductsTableController extends Controller
{
    /**
     * variable to store the repository object
     * @var ProductRepository
     */
    protected $product;

    /**
     * contructor to initialize repository object
     * @param ProductRepository $product ;
     */
    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    /**
     * This method return the data of the model
     * @param ManageProductRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageProductRequest $request)
    {
        return Datatables::of($this->product->getForDataTable())
            ->escapeColumns(['id'])
            ->escapeColumns(['name'])
            ->addColumn(
                'publish_datetime',
                function ($product) {
                    return Carbon::parse($product->publish_datetime)->toDateString(
                    ); //$product->publish_datetime;//->format('d/m/Y h:i A');
                }
            )
            ->addColumn(
                'status',
                function ($product) {
                    return $product->status;
                }
            )
            ->addColumn(
                'created_at',
                function ($product) {
                    return Carbon::parse($product->created_at)->toDateString();
                }
            )
            ->addColumn(
                'actions',
                function ($product) {
                    return $product->action_buttons;
                }
            )
            ->make(true);
    }
}
