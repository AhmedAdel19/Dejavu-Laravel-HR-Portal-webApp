<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee_balance extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
