<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Friend
 * @package App
 */
class Friend extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $dates = ['confirmed_at'];
}
