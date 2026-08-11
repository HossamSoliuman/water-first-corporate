<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $fillable = ['position_name', 'location', 'employment_type', 'order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    /**
     * Display label for the stored enum value, e.g. "full-time" => "Full-time".
     */
    public function getEmploymentTypeLabelAttribute(): string
    {
        return $this->employment_type === 'part-time' ? 'Part-time' : 'Full-time';
    }
}
