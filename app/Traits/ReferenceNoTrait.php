<?php

namespace App\Traits;

trait ReferenceNoTrait
{
    /**
     * Bootstrap trait.
     *
     * @return void
     */
    public static function bootReferenceNoTrait()
    {
        static::creating(function ($model) {
            $last_record = $model->orderBy('id', 'DESC')->first();

            if(!$last_record) $ref_no = str_pad(1, 4, 0, STR_PAD_LEFT);
            else $ref_no = \str_pad($last_record->id + 1, 4, 0, STR_PAD_LEFT);

            $model->reference_no = $ref_no;
        });
    }
}
