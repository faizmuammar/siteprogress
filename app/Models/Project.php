<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'title',
        'client_name',
        'location',
        'progress_percentage',
        'status',
        'start_date',
        'target_completion_date',
        'owner_user_id',
        'pic_user_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

    public function pic()
    {
        return $this->belongsTo(User::class, 'pic_user_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function dailyReports()
    {
        return $this->hasMany(DailyReport::class);
    }

    public function todoItems()
    {
        return $this->hasMany(TodoItem::class);
    }
}