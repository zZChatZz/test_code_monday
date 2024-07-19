<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = "category_id";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_name',
        'category_id',
        'parent_id',
    ];


    public function subCategories() {
        return $this->hasMany(Category::class, 'parent_id')->with('subCategories')->select('category_id', 'category_name', 'parent_id');
    }

}
