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
namespace App\Repositories\Backend\Category;

use DB;
use Carbon\Carbon;
use App\Models\Category\Category;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Category::class;

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
                config('module.categories.table').'.id',
                config('module.categories.table').'.name',
                config('module.categories.table').'.status',
                config('module.categories.table').'.created_at',
                config('module.categories.table').'.updated_at',
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
        if ($this->query()->where('name', $input['name'])->first()) {
            throw new GeneralException(trans('exceptions.backend.categories.already_exists'));
        }
        DB::transaction(
            function () use ($input) {
                $input['status'] = isset($input['status']) ? 1 : 0;
                if (Category::create($input)) {
                    return true;
                }
                throw new GeneralException(trans('exceptions.backend.categories.create_error'));
            }
        );

    }

    /**
     * For updating the respective Model in storage
     *
     * @param Category $category
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Category $category, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $category->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.blogcategories.already_exists'));
        }
        DB::transaction(
            function () use ($category, $input) {
                $input['status'] = isset($input['status']) ? 1 : 0;
                if ($category->update($input))
                return true;

            throw new GeneralException(trans('exceptions.backend.categories.update_error'));
            }
        );

    }

    /**
     * For deleting the respective model from storage
     *
     * @param Category $category
     * @throws GeneralException
     * @return bool
     */
    public function delete(Category $category)
    {
        DB::transaction(
            function () use ($category) {
                if ($category->delete()) {
                    return true;
                }

                throw new GeneralException(trans('exceptions.backend.categories.delete_error'));
            }
        );
    }
}
