{{-- admin/email-settings/_smtp.blade.php --}}
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <form method="POST" action="{{ route('admin.email-settings.smtp.update') }}" class="xl:col-span-2 bg-white rounded-xl border border-gray-200 p-6 space-y-5"
          x-data="{ enabled: @js((bool) old('smtp_enabled', $smtp['enabled'])), wasEnabled: @js($smtp['enabled']) }"
          @submit="if (wasEnabled && !enabled && !confirm('Turn off SMTP? Emails will fall back to the server default mailer ({{ $fallbackMailer }}), which may not deliver them.')) $event.preventDefault()">
        @csrf @method('PUT')
        <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">SMTP Server</h3>

        <label class="flex items-center gap-3 cursor-pointer">
            <input type="hidden" name="smtp_enabled" value="0">
            <input type="checkbox" name="smtp_enabled" value="1" x-model="enabled" class="w-4 h-4 rounded border-gray-300 text-teal-600 focus:ring-teal-500">
            <span class="text-sm font-medium text-gray-800">Send email through this SMTP server</span>
        </label>
        <p class="{{ $hint }} -mt-3">When off, the site uses the server’s default mailer (<code>{{ $fallbackMailer }}</code>) from the environment configuration.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2">
                <label for="smtp_host" class="{{ $label }}">SMTP host</label>
                <input type="text" id="smtp_host" name="host" value="{{ old('host', $smtp['host']) }}" placeholder="smtp.example.com" autocomplete="off" class="{{ $input }}">
            </div>
            <div>
                <label for="smtp_port" class="{{ $label }}">Port</label>
                <select id="smtp_port" name="port" class="{{ $input }}">
                    <option value="">—</option>
                    @foreach($allowedPorts as $port)
                    <option value="{{ $port }}" @selected((int) old('port', $smtp['port']) === $port)>{{ $port }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="smtp_encryption" class="{{ $label }}">Encryption</label>
                <select id="smtp_encryption" name="encryption" class="{{ $input }}">
                    @foreach(['tls' => 'TLS (STARTTLS, usually port 587)', 'ssl' => 'SSL (implicit TLS, usually port 465)', 'none' => 'None (not recommended)'] as $value => $name)
                    <option value="{{ $value }}" @selected(old('encryption', $smtp['encryption']) === $value)>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="smtp_timeout" class="{{ $label }}">Connection timeout (seconds)</label>
                <input type="number" id="smtp_timeout" name="timeout" min="5" max="120" value="{{ old('timeout', $smtp['timeout'] ?: 30) }}" class="{{ $input }}">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="smtp_username" class="{{ $label }}">Username</label>
                <input type="text" id="smtp_username" name="username" value="{{ old('username', $smtp['username']) }}" autocomplete="off" class="{{ $input }}">
                <p class="{{ $hint }}">Leave empty if the server needs no authentication.</p>
            </div>
            <div>
                <label for="smtp_password" class="{{ $label }}">Password</label>
                <input type="password" id="smtp_password" name="password" value="" autocomplete="new-password"
                       placeholder="{{ $hasPassword ? '•••••••• (saved — leave blank to keep)' : 'Not set' }}" class="{{ $input }}">
                @if($hasPassword)
                <label class="flex items-center gap-2 mt-2 text-xs text-gray-600">
                    <input type="checkbox" name="remove_password" value="1" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                    Remove the saved password
                </label>
                @endif
                <p class="{{ $hint }}">Stored encrypted. It is never shown again.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="from_address" class="{{ $label }}">Sender email address</label>
                <input type="email" id="from_address" name="from_address" value="{{ old('from_address', $smtp['from_address']) }}" placeholder="no-reply@yourdomain.com" class="{{ $input }}">
                <p class="{{ $hint }}">Must be an address the SMTP account is allowed to send as.</p>
            </div>
            <div>
                <label for="from_name" class="{{ $label }}">Sender display name</label>
                <input type="text" id="from_name" name="from_name" value="{{ old('from_name', $smtp['from_name']) }}" placeholder="WaterFirst" class="{{ $input }}">
            </div>
        </div>

        <div class="pt-2">
            <button type="submit" class="bg-teal-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-teal-700 transition-colors">Save Settings</button>
        </div>
    </form>

    <div class="space-y-6">
        <div class="bg-white rounded-xl border border-gray-200 p-6 text-sm space-y-2">
            <h3 class="font-semibold text-gray-800 pb-3 mb-1 border-b border-gray-100">Status</h3>
            <p><span class="font-medium text-gray-800">SMTP:</span> {{ $usesSmtp ? 'Enabled' : 'Disabled' }}</p>
            <p><span class="font-medium text-gray-800">Mailer in use:</span> {{ $usesSmtp ? 'SMTP ('.$smtp['host'].':'.$smtp['port'].')' : $fallbackMailer.' (environment default)' }}</p>
            <p><span class="font-medium text-gray-800">Last successful test:</span>
                {{ $lastTestedAt ? \Illuminate\Support\Carbon::parse($lastTestedAt)->inDisplayTimezone()->format('M d, Y H:i T') : 'Never' }}</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
            <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Test</h3>
            <p class="text-xs text-gray-500">Tests use the <strong>saved</strong> settings. Save first if you changed anything.</p>
            <form method="POST" action="{{ route('admin.email-settings.smtp.test-connection') }}">
                @csrf
                <button type="submit" class="w-full border border-teal-600 text-teal-700 py-2.5 rounded-lg text-sm font-semibold hover:bg-teal-50 transition-colors" @disabled(! $usesSmtp)>Test SMTP connection</button>
                <p class="{{ $hint }}">Connects and logs in without sending anything.</p>
            </form>
            <form method="POST" action="{{ route('admin.email-settings.smtp.test-email') }}" class="space-y-2 pt-2 border-t border-gray-100">
                @csrf
                <label for="smtp_test_recipient" class="{{ $label }}">Send a test email to</label>
                <input type="email" id="smtp_test_recipient" name="test_recipient" required value="{{ old('test_recipient', auth()->user()->email) }}" class="{{ $input }}">
                <button type="submit" class="w-full bg-teal-600 text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-teal-700 transition-colors">Send Test Email</button>
            </form>
        </div>
    </div>
</div>
