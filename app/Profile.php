<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function profileImage()
    {
        return ($this->image) ? '/storage/' . $this->image
            : '/storage/uploads/TMyzA2yCwPIjCDTPx4km3OlyM2ev0lV5iFbPyygG.png';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
