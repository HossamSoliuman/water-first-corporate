{{-- admin/partials/icon-datalist.blade.php --}}
{{--
    Suggestions for every icon input in the admin. The vocabulary mirrors the
    heroicon keys in resources/views/components/icon.blade.php — keep the two in
    step when an icon is added there. Any Font Awesome name (fa-water, fa-gears)
    also works: the icon component renders those straight through.
--}}
<datalist id="wf-icons">
    @foreach ([
        'academic-cap', 'adjustments-horizontal', 'arrow-long-right', 'arrow-path', 'arrow-right',
        'arrow-trending-up', 'beaker', 'bolt', 'building-library', 'building-office', 'building-office-2',
        'chart-bar', 'check-circle', 'clipboard-document-list', 'clock', 'cog-6-tooth', 'cpu-chip',
        'cube-transparent', 'document-arrow-down', 'document-text', 'droplet', 'envelope', 'fire',
        'folder', 'funnel', 'globe-alt', 'hand-thumb-up', 'inbox', 'light-bulb', 'lock-closed', 'map',
        'map-pin', 'pencil-square', 'phone', 'presentation-chart-line', 'scale', 'shield-check', 'signal',
        'sparkles', 'squares-2x2', 'tag', 'truck', 'user-circle', 'users', 'waves', 'wrench-screwdriver',
    ] as $iconName)
        <option value="{{ $iconName }}"></option>
    @endforeach
</datalist>
