<?php

namespace App\Traits;

trait ResponseMacroUserDestroyTrait
{
    /**
     * Bootstrap trait.
     *
     * @return void
     */
    public static function bootResponseMacroUserDestroyTrait()
    {
        static::deleting(function ($model) {
            $model->loginLogs()->delete();
        });
    }
}
