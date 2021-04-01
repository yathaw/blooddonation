<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['dob', 'phone', 'address', 'blood_id', 'user_id', 'created_id'];

    public function blood()
    {
        return $this->belongsTo('App\Models\Blood');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function createduser()
    {
        return $this->belongsTo('App\Models\User', 'created_id');
    }

    public function inventories()
    {
        return $this->hasMany('App\Models\Inventory');
    }
}
