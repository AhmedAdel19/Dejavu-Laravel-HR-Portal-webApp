<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee_note extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
