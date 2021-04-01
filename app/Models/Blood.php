<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blood extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['type', 'status'];

    public function donors()
    {
        return $this->hasMany('App\Models\Donor');
    }

    public function inventories()
    {
        return $this->hasMany('App\Models\Inventory');
    }
}
