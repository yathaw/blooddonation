<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['count', 'dod', 'status', 'donor_id', 'blood_id', 'user_id'];

    public function blood()
    {
        return $this->belongsTo('App\Models\Blood');
    }

    public function donor()
    {
        return $this->belongsTo('App\Models\Donor');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
