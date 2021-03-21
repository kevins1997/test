<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    public function timeSheet()
    {
        return $this->hasMany(TimeSheet::class);
    }

    public function activityTypes()
    {
        return $this->belongsToMany(ActivityType::class, 'activity-type_project');
    }
}
