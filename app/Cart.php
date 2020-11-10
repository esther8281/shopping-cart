<?php

namespace App;

use App\Traits\CreaterTrait;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use CreaterTrait;

   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'user_id',
        'product_id',
        'guest_session_id',
        'quantity',
        'price',
    ];

    /**
     * Get the product.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    
}
