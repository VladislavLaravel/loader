<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\CompanyScope;

class Product extends Model
{
    protected $fillable = [
        'file_id', 'price', 'name', 'size', 'color', 'taste'
    ];

}