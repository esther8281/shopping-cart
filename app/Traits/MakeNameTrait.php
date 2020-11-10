<?php

namespace App\Traits;

trait MakeNameTrait
{
   /**
     * Get the employee name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . ($this->middle_name ? $this->middle_name . ' ' : '') . $this->last_name;
    }
}
