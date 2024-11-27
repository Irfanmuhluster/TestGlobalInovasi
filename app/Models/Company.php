<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [
        "created_at",
        "updated_at",
    ];

    public function managers()
    {
        return $this->hasMany(User::class, 'company_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }    

}
