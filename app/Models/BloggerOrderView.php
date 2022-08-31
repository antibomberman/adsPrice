<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloggerOrderView extends Model
{
    use HasFactory;
    protected $fillable = ['blogger_order_id','ip','agent'];

}
