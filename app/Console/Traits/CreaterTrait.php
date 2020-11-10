<?php

namespace App\Traits;

trait CreaterTrait
{
    /**
     * Bootstrap trait.
     *
     * @return void
     */
    public static function bootCreaterTrait()
    {
        if(auth()->user()) {            
            static::creating(function ($model) {
                $model->creator_id = auth()->user()->id;
            });

            static::saving(function ($model) {
                if ($model->updated_at) {
                    $model->updater_id = auth()->user()->id;
                }
            });
        }
    }

    /**
     * Get the creator.
     */
    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }
}
