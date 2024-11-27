<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [
        "created_at",
        "updated_at",
    ];

    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function scopeSearch($query)
    {
        $filter = request()->query();

        return $query
            ->when(@$filter['search'], function ($query, $keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query
                        ->where('fullname', 'like', "%{$keyword}%");
                });
            });
    }
}
