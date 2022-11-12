<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'cate_post_name', 'cate_post_des', 'cate_post_status', 'cate_post_slug'
    ];
    protected $primaryKey = 'cate_post_id';
 	protected $table = 'tbl_category_post';
}
