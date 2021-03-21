<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function timeSheet()
    {
        return $this->hasMany(TimeSheet::class);
    }

    public function project()
    {
        return $this->belongsToMany(Project::class, 'activity-type_project');
    }
}
