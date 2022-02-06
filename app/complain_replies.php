<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class complain_replies extends Model
{
    public function complain()
    {
        $this->belongsTo(complain::class);
    }
}
