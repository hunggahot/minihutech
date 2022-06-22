<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProductModels extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'meta_keywords', 'category_name', 'category_slug','category_des','category_status', 'category_parent'
    ];
    protected $primaryKey = 'category_id';
 	protected $table = 'tbl_category_product';
}
