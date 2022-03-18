<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = "Package";

    protected $fillable = [
        "name",
        "max_file_upload",
        "max_file_size",
    ];

    protected $primaryKey = "id";
}
