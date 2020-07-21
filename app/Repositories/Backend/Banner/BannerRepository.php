<?php

namespace App\Repositories\Backend\Banner;
use App\Events\Backend\Banner\BannerCreated;
use App\Events\Backend\Banner\BannerDeleted;
use App\Events\Backend\Banner\BannerUpdated;
use DB;
use Carbon\Carbon;
use App\Models\Banner\Banner;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
/**
 * Class BannerRepository.
 */
class BannerRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Banner::class;
    protected $upload_path;
    protected $storage;

    public function __construct()
    {
        $this->upload_path = 'img' . DIRECTORY_SEPARATOR . 'banner' . DIRECTORY_SEPARATOR;
        $this->storage = Storage::disk('public');
    }
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
                config('module.banners.table').'.name',
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



        DB::transaction(
            function () use ($input) {
              //  dd($input['image_url']);
                $input = $this->uploadImage($input);
                if ($banners = Banner::create($input)) {
                    event(new BannerCreated($banners));
                    return true;
                }

                throw new GeneralException(trans('exceptions.backend.banners.create_error'));
            }
        );


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
        // Uploading Image
        if (array_key_exists('image_url', $input)) {
            $this->deleteOldFile($banner);
            $input = $this->uploadImage($input);
        }

        DB::transaction(
            function () use ($banner, $input) {
                if ($banner->update($input)) {
                    event(new BannerUpdated($banner));
                    return true;
                }
                throw new GeneralException(trans('exceptions.backend.banners.update_error'));
            }
        );
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
        DB::transaction(
            function () use ($banner) {
                if ($banner->delete()) {
                    event(new BannerDeleted($banner));
                    return true;
                }

                throw new GeneralException(trans('exceptions.backend.banners.delete_error'));
            }
        );



    }
    /**
     * Upload Image.
     *
     * @param array $input
     *
     * @return array $input
     */
    public function uploadImage($input)
    {
        $avatar = $input['image_url'];

        if (isset($input['image_url']) && !empty($input['image_url'])) {
            $fileName = time() . $avatar->getClientOriginalName();

            $this->storage->put($this->upload_path . $fileName, file_get_contents($avatar->getRealPath()));

            $input = array_merge($input, ['image_url' => $fileName]);

            return $input;
        }
    }

    /**
     * Destroy Old Image.
     *
     * @param int $id
     */
    public function deleteOldFile($model)
    {
        $fileName = $model->image_url;

        return $this->storage->delete($this->upload_path . $fileName);
    }
}
