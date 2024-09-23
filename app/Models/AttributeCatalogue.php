<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeCatalogue extends Model
{
    use HasFactory;
    protected $fillable = [
    'name',
    'image'
        ];

    public function attributes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Attribute::class, 'attribute_catalogue_id','id');
    }
}
