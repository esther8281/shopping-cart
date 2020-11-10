<?php

namespace App\Traits;

trait AvatarUrlTrait
{
   /**
     * Get the employee name.
     *
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        if (\Storage::disk('local')->exists($this->avatar)) {
            return url(\Storage::disk('local')->url($this->avatar));
        }
        
        return asset('images/no-image.png');
    }
}
