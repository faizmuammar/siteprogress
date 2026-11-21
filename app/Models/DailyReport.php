<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'pic_user_id',
        'report_date',
        'notes',
        'geotagged_photo_path',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function pic()
    {
        return $this->belongsTo(User::class, 'pic_user_id');
    }
}