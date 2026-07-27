<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'user_fk_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
