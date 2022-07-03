<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "type"
    ];
    protected $updated_at = false;
    protected $created_at = false;

}
