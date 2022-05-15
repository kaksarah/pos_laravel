<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class UsersAktivity extends Model
{
    use LogsActivity;

    protected $table = 'activity_log';
    
    public function user()
    {
        return $this->belongsTo(User::class, 'causer_id');
    }
}
