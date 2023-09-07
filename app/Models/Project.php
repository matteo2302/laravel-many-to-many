<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title', 'date', 'last_update', 'description', 'image'];
    // public function image(): Attribute
    // {
    //     return Attribute::make(set: fn ($value) => asset('storage/' . $value));
    // }
    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
    public function type()
    {
        return $this->belongsto(Type::class);
    }
};
