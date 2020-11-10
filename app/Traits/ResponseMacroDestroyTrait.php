<?php

namespace App\Traits;

trait ResponseMacroDestroyTrait
{
    /**
     * Bootstrap trait.
     *
     * @return void
     */
    public static function bootResponseMacroDestroyTrait()
    {
        static::deleting(function ($model) {
            foreach ($model->getRelations() as $key => $relation) {
                if($relation && $relation->count()) {
                    createFlashMessage('error', 'Failed! Already in use');
                    return false;
                }
            }
        });
    }
}
