{{-- admin/email-settings/_recipients.blade.php --}}
@php
    $lists = [
        'recipients' => ['To', 'Every address receives each new enquiry.', old('recipients', $recipients['to'])],
        'cc' => ['CC (optional)', 'Copied openly on each notification.', old('cc', $recipients['cc'])],
        'bcc' => ['BCC (optional)', 'Copied without other recipients seeing it.', old('bcc', $recipients['bcc'])],
    ];
@endphp
<form method="POST" action="{{ route('admin.email-settings.recipients.update') }}" class="bg-white rounded-xl border border-gray-200 p-6 space-y-6 max-w-3xl"
      x-data="{ enabled: @js((bool) old('admin_enabled', $adminEnabled)), wasEnabled: @js($adminEnabled) }"
      @submit="if (wasEnabled && !enabled && !confirm('Turn off admin notification emails? New enquiries will still be saved in Leads, but nobody will be emailed about them.')) $event.preventDefault()">
    @csrf @method('PUT')
    <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Contact Form Notification Settings</h3>

    <div>
        <label class="flex items-center gap-3 cursor-pointer">
            <input type="hidden" name="admin_enabled" value="0">
            <input type="checkbox" name="admin_enabled" value="1" x-model="enabled" class="w-4 h-4 rounded border-gray-300 text-teal-600 focus:ring-teal-500">
            <span class="text-sm font-medium text-gray-800">Email new enquiries to the addresses below</span>
        </label>
        <p class="{{ $hint }}">Independent of the visitor auto-reply, which is controlled on its own tab.</p>
    </div>

    @foreach($lists as $field => [$title, $help, $values])
    <div x-data="{ items: @js(array_values((array) $values) ?: ($field === 'recipients' ? [''] : [])) }">
        <p class="{{ $label }}">{{ $title }}</p>
        <p class="{{ $hint }} -mt-1 mb-2">{{ $help }}</p>
        <div class="space-y-2">
            <template x-for="(item, index) in items" :key="index">
                <div class="flex gap-2">
                    <input type="email" name="{{ $field }}[]" x-model="items[index]" placeholder="name@company.com" class="{{ $input }}">
                    <button type="button" @click="items.splice(index, 1)" class="px-3 text-sm text-red-500 hover:text-red-700" aria-label="Remove address">Remove</button>
                </div>
            </template>
        </div>
        <button type="button" @click="items.push('')" class="mt-2 text-sm text-teal-600 hover:underline font-medium">+ Add address</button>
    </div>
    @endforeach

    <div class="pt-2">
        <button type="submit" class="bg-teal-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-teal-700 transition-colors">Save Settings</button>
    </div>
</form>
