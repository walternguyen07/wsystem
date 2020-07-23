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
namespace App\Repositories\Backend\Product;

use DB;
use Carbon\Carbon;
use App\Models\Category\Category;
use App\Models\ProductMapCategories\ProductMapCategory;
use App\Models\Product\Product;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
/**
 * Class ProductRepository.
 */
class ProductRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Product::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('module.products.table').'.id',
                config('module.products.table').'.name',
                config('module.products.table').'.publish_datetime',
                config('module.products.table').'.status',
                config('module.products.table').'.created_at',
                config('module.products.table').'.updated_at',
            ]);
    }

    /**
     * For Creating the respective model in storage
     *
     * @param array $input
     * @throws GeneralException
     * @return bool
     */
    public function create(array $input)
    {

        $categoriesArray = $this->createCategories($input['categories']);
        unset($input['categories']);

        DB::transaction(
            function () use ($input,  $categoriesArray) {
                $input['slug'] = Str::slug($input['name']);
                $input['publish_datetime'] = Carbon::parse($input['publish_datetime']);

                if ($product = Product::create($input)) {
                    // Inserting associated category's id in mapper table
                    if (count($categoriesArray)) {
                        $product->categories()->sync($categoriesArray);
                    }

                    return true;
                }

                throw new GeneralException(trans('exceptions.backend.products.create_error'));
            }
        );
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Product $product
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Product $product, array $input)
    {
        $categoriesArray = $this->createCategories($input['categories']);
        unset( $input['categories']);

        $input['slug'] = Str::slug($input['name']);
        $input['publish_datetime'] = Carbon::parse($input['publish_datetime']);
        DB::transaction(
            function () use ($product, $input, $categoriesArray) {
                if ($product->update($input)) {
                    // Updateing associated category's id in mapper table
                    if (count($categoriesArray)) {
                        $product->categories()->sync($categoriesArray);
                    }
                    return true;
                }

                throw new GeneralException(trans('exceptions.backend.products.update_error'));

            }
        );



    }

    /**
     * For deleting the respective model from storage
     *
     * @param Product $product
     * @throws GeneralException
     * @return bool
     */
    public function delete(Product $product)
    {

        DB::transaction(
            function () use ($product) {
                if ($product->delete()) {
                    ProductMapCategory::where('product_id', $product->id)->delete();
                    return true;
                }
                throw new GeneralException(trans('exceptions.backend.products.delete_error'));
            }
        );
    }

     /**
     * Creating Categories.
     *
     * @param Array($categories)
     *
     * @return array
     */
    public function createCategories($categories)
    {
        //Creating a new array for categories (newly created)
        $categories_array = [];

        foreach ($categories as $category) {
            if (is_numeric($category)) {
                $categories_array[] = $category;
            } else {
                $newCategory = Category::create(['name' => $category, 'status' => 1, 'created_by' => 1]);

                $categories_array[] = $newCategory->id;
            }
        }

        return $categories_array;
    }
}
