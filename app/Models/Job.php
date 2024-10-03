<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'location', 'job_type', 'employer_id'];

    // Job belongs to an Employer
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}
