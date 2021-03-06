<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $table = 'threads';

    protected $fillable = [
        'name', 'user_id', 'id_user_checked', 'latest_comment_time'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }
}
