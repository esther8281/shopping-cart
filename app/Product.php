<?php

namespace App;

use App\Traits\CreaterTrait;
use App\Traits\AvatarUrlTrait;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use CreaterTrait,
        AvatarUrlTrait;
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'avatar',
        'status',
        
    ];

    /**
     * The attributes that appends.
     *
     * @var array
     */
    protected $appends = [
        'avatar_url',
    ];

    


}
