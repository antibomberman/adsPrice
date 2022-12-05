<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','image','text','user_id'];


    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset(Storage::disk('public')->url($value)) : 'https://www.onelove.org/wp-content/uploads/2015/10/missingheadshot.jpg',
            set: fn ($value) => Storage::disk('public')->putFile('images/'.Carbon::now()->format('Y/m'), $value),
        );
    }
}
