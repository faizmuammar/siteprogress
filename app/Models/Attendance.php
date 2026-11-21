<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'attendance_date',
        'carpenter_mason_count',
        'welder_ironworker_count',
        'heavy_equipment_operator_count',
        'total_workers_present',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}