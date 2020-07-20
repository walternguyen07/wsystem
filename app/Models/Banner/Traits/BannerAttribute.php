<?php

namespace App\Models\Banner\Traits;

/**
 * Class BannerAttribute.
 */
trait BannerAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> {$this->getEditButtonAttribute("edit-banner", "admin.banners.edit")}
                {$this->getDeleteButtonAttribute("delete-banner", "admin.banners.destroy")}
                </div>';
    }
}
