<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'size_number', 'size_status'
    ];
    protected $primaryKey = 'size_id';
 	protected $table = 'tbl_size';
}

