<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCatalogue extends Model
{
    use HasFactory;
    protected $fillable = [
    'parent_id',
    'left','right',
    'level',
    'image',
    'publish',
    'album','order'
];
}
