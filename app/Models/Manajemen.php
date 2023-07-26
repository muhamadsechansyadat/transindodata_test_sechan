<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Manajemen extends Model
{
    use HasFactory;
    protected $table = 'manajemen';
    protected $guarded = [];

    public function users(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
