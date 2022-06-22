<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false; //set time false
    protected $fillable = ['post_title', 'post_slug', 'post_sum', 'post_content', 'post_meta_des', 'post_mete_keywords', 'post_status', 'post_image', 'cate_post_id'];
    protected $primaryKey = 'post_id';
    protected $table = 'tbl_posts';
}
