<?php

namespace App\Repositories\Backend\Banner;

use DB;
use Carbon\Carbon;
use App\Models\Banner\Banner;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BannerRepository.
 */
class BannerRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Banner::class;

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
                config('module.banners.table').'.id',
                config('module.banners.table').'.created_at',
                config('module.banners.table').'.updated_at',
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
        if (Banner::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.banners.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Banner $banner
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Banner $banner, array $input)
    {
    	if ($banner->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.banners.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Banner $banner
     * @throws GeneralException
     * @return bool
     */
    public function delete(Banner $banner)
    {
        if ($banner->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.banners.delete_error'));
    }
}
