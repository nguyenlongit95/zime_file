<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $table = "Files";

    protected $fillable = [
        "user_id",
        "name",
        "file_size",
    ];

    protected $primaryKey = "id";

    /**
     * Relationship with users table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
