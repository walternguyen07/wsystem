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
namespace App\Http\Responses\Backend\Product;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    protected $status;


    protected $productCategories;


    /**
     * @var App\Models\Product\Product
     */
    protected $products;

    /**
     * @param App\Models\Product\Product $products
     */
    public function __construct($products,$status, $productCategories)
    {
        $this->products = $products;
        $this->status = $status;
        $this->productCategories = $productCategories;
    }

    /**
     * To Response
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.products.edit')->with([
            'products' => $this->products,
            'productCategories' => $this->productCategories,
            'status'         => $this->status,
        ]);
    }
}