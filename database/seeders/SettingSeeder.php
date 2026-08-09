<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'WaterFirst', 'group' => 'general', 'type' => 'text'],
            ['key' => 'site_tagline', 'value' => 'Engineering Water, Sustainably', 'group' => 'general', 'type' => 'text'],
            ['key' => 'logo_url', 'value' => 'images/waterfirst-logo.svg', 'group' => 'general', 'type' => 'image'],
            ['key' => 'favicon_url', 'value' => '', 'group' => 'general', 'type' => 'image'],
            ['key' => 'footer_text', 'value' => '© '.date('Y').' WaterFirst Engineering Consultancy Private Limited. All rights reserved.', 'group' => 'general', 'type' => 'textarea'],
            ['key' => 'default_og_image', 'value' => '', 'group' => 'general', 'type' => 'image'],
            ['key' => 'meta_description', 'value' => 'WaterFirst is a Bangalore-based water and wastewater engineering consultancy delivering sustainable municipal and industrial environmental solutions across India.', 'group' => 'general', 'type' => 'textarea'],
            ['key' => 'contact_email', 'value' => 'contact@waterfirst.example', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'phone', 'value' => '', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'whatsapp_number', 'value' => '', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'address', 'value' => '', 'group' => 'contact', 'type' => 'textarea'],
            ['key' => 'address_india', 'value' => 'Bangalore, Karnataka, India', 'group' => 'contact', 'type' => 'textarea'],
            ['key' => 'social_facebook', 'value' => '', 'group' => 'social', 'type' => 'text'],
            ['key' => 'social_twitter', 'value' => '', 'group' => 'social', 'type' => 'text'],
            ['key' => 'social_linkedin', 'value' => '', 'group' => 'social', 'type' => 'text'],
            ['key' => 'social_instagram', 'value' => '', 'group' => 'social', 'type' => 'text'],
            ['key' => 'ga4_id', 'value' => '', 'group' => 'analytics', 'type' => 'text'],
            ['key' => 'gtm_id', 'value' => '', 'group' => 'analytics', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
            Cache::forget('setting_'.$setting['key']);
        }

        Cache::forget('layout_settings');
    }
}
