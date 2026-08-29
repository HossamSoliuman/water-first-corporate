<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoftwareLogo extends Model
{
    protected $fillable = ['name', 'path', 'order'];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }

    /**
     * Editable copy and visibility for the "Software We Use" home-page section.
     *
     * @return array{enabled: bool, eyebrow: string, heading: string, heading_accent: string, subtitle: string}
     */
    public static function sectionSettings(): array
    {
        return [
            'enabled' => (bool) Setting::get('software_section_enabled', true),
            'eyebrow' => (string) Setting::get('software_section_eyebrow', ''),
            'heading' => (string) Setting::get('software_section_heading', 'Software'),
            'heading_accent' => (string) Setting::get('software_section_heading_accent', 'We Use'),
            'subtitle' => (string) Setting::get('software_section_subtitle', ''),
        ];
    }
}
