<?php

namespace App\Http\Responses\Backend\Banner;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var App\Models\Banner\Banner
     */
    protected $banners;

    /**
     * @param App\Models\Banner\Banner $banners
     */
    public function __construct($banners)
    {
        $this->banners = $banners;
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
        return view('backend.banners.edit')->with([
            'banners' => $this->banners
        ]);
    }
}