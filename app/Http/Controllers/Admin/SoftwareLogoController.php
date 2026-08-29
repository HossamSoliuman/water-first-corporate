<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\SoftwareLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SoftwareLogoController extends Controller
{
    public function index()
    {
        $logos = SoftwareLogo::ordered()->get();
        $section = SoftwareLogo::sectionSettings();

        return view('admin.software-logos.index', compact('logos', 'section'));
    }

    public function updateSection(Request $request)
    {
        $validated = $request->validate([
            'eyebrow' => 'nullable|string|max:60',
            'heading' => 'required|string|max:100',
            'heading_accent' => 'nullable|string|max:100',
            'subtitle' => 'nullable|string|max:255',
        ]);

        $values = [
            'software_section_enabled' => [$request->boolean('enabled') ? '1' : '0', 'boolean'],
            'software_section_eyebrow' => [$validated['eyebrow'] ?? '', 'text'],
            'software_section_heading' => [$validated['heading'], 'text'],
            'software_section_heading_accent' => [$validated['heading_accent'] ?? '', 'text'],
            'software_section_subtitle' => [$validated['subtitle'] ?? '', 'textarea'],
        ];

        foreach ($values as $key => [$value, $type]) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value, 'group' => 'software', 'type' => $type]);
            Cache::forget("setting_{$key}");
        }

        Cache::forget('layout_settings');

        return back()->with('success', 'Section content updated.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'logos' => 'required|array|min:1',
            'logos.*' => 'required|image|max:4096',
        ]);

        $order = SoftwareLogo::max('order') ?? 0;
        $dir = public_path('software-logos');

        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        foreach ($request->file('logos') as $file) {
            $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
            $file->move($dir, $filename);
            SoftwareLogo::create(['path' => 'software-logos/'.$filename, 'order' => ++$order]);
        }

        return back()->with('success', count($request->file('logos')).' logo(s) uploaded.');
    }

    public function update(Request $request, SoftwareLogo $softwareLogo)
    {
        $request->validate([
            'order' => 'required|integer|min:0',
            'name' => 'nullable|string|max:100',
        ]);

        $softwareLogo->update($request->only('order', 'name'));

        return back()->with('success', 'Logo updated.');
    }

    public function destroy(SoftwareLogo $softwareLogo)
    {
        $full = public_path($softwareLogo->path);
        if (file_exists($full)) {
            @unlink($full);
        }
        $softwareLogo->delete();

        return back()->with('success', 'Logo deleted.');
    }
}
