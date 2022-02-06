<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee_salary extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
