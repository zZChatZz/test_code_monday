<?php
namespace App\Helpers;

use App\Models\Category;
use Illuminate\Support\Str;

class Helper
{
    /**
     * generate primary key for table Category
     * @return string
     */
    public static function autoIncrementCategory()
    {
        do {
            $category_id = Str::random(5);
            $is_dup = Category::where('category_id', $category_id)->exists();
        } while ($is_dup);
        return $category_id;
    }

}
