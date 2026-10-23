{{-- admin/email-settings/_template.blade.php — expects $type (EmailType), $template (array) and $available (placeholders) --}}
@php
    $isAck = $type === \App\Enums\EmailType::CustomerAcknowledgement;
    $mine = old('template_form') === $type->value;
    $value = fn (string $field) => $mine ? old($field, $template[$field] ?? '') : ($template[$field] ?? '');
    $id = fn (string $field) => $type->value.'_'.$field;
    $token = fn (string $key) => '{'.'{'.$key.'}'.'}';
@endphp
<form method="POST" action="{{ route('admin.email-settings.templates.update', $type) }}"
      class="grid grid-cols-1 xl:grid-cols-3 gap-6"
      x-data="{
          enabled: @js((bool) ($mine ? old('enabled', $ackEnabled) : $ackEnabled)),
          wasEnabled: @js($ackEnabled),
          field: 'body',
          insert(token) {
              const el = this.$refs[this.field];
              if (! el) return;
              el.setRangeText(token, el.selectionStart, el.selectionEnd, 'end');
              el.dispatchEvent(new Event('input'));
              el.focus();
          },
          confirmSave(event) {
              if (@js($isAck) && event.submitter?.value === 'PUT' && this.wasEnabled && ! this.enabled
                  && ! confirm('Turn off the automatic reply? Visitors will no longer receive a confirmation email.')) {
                  event.preventDefault();
              }
          }
      }"
      @submit="confirmSave($event)">
    @csrf
    <input type="hidden" name="template_form" value="{{ $type->value }}">

    <div class="xl:col-span-2 bg-white rounded-xl border border-gray-200 p-6 space-y-5">
        <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">
            {{ $isAck ? 'Auto-Reply / Thank You Email Template' : 'Administrator Notification Email Template' }}
        </h3>

        @if($isAck)
        <div>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="hidden" name="enabled" value="0">
                <input type="checkbox" name="enabled" value="1" x-model="enabled" class="w-4 h-4 rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                <span class="text-sm font-medium text-gray-800">Send this reply automatically to every visitor who submits the form</span>
            </label>
            <p class="{{ $hint }}">Sent to the email address the visitor entered. Independent of admin notifications.</p>
        </div>
        @else
        <p class="text-sm px-4 py-3 rounded-lg {{ $adminEnabled ? 'bg-green-50 text-green-800' : 'bg-gray-100 text-gray-700' }}">
            Admin notifications are <strong>{{ $adminEnabled ? 'on' : 'off' }}</strong>.
            Turn them on or off and choose who receives them on the
            <button type="button" @click="go('recipients')" class="underline font-medium">Notification Recipients</button> tab.
        </p>
        @endif

        <div>
            <label for="{{ $id('subject') }}" class="{{ $label }}">Email subject</label>
            <input type="text" id="{{ $id('subject') }}" name="subject" x-ref="subject" @focus="field='subject'" value="{{ $value('subject') }}" required maxlength="200" class="{{ $input }}">
        </div>

        @if($isAck)
        <div>
            <label for="{{ $id('from_name') }}" class="{{ $label }}">Sender display name <span class="text-gray-400 font-normal">(optional)</span></label>
            <input type="text" id="{{ $id('from_name') }}" name="from_name" value="{{ $value('from_name') }}" maxlength="120" placeholder="{{ $smtp['from_name'] ?: 'Uses the SMTP sender name' }}" class="{{ $input }}">
            <p class="{{ $hint }}">Only the display name changes — the email is always sent from the configured sender address{{ $smtp['from_address'] ? ' ('.$smtp['from_address'].')' : '' }}.</p>
        </div>
        @endif

        <div>
            <label for="{{ $id('heading') }}" class="{{ $label }}">Heading</label>
            <input type="text" id="{{ $id('heading') }}" name="heading" x-ref="heading" @focus="field='heading'" value="{{ $value('heading') }}" maxlength="200" class="{{ $input }}">
        </div>

        <div>
            <label for="{{ $id('body') }}" class="{{ $label }}">Email body</label>
            <textarea id="{{ $id('body') }}" name="body" x-ref="body" @focus="field='body'" rows="14" required class="{{ $input }} font-mono text-xs leading-relaxed">{{ $value('body') }}</textarea>
            <p class="{{ $hint }}">Plain text or simple HTML. Allowed tags: p, br, strong, em, u, a, ul/ol/li, h2–h4, blockquote, hr. Anything else (scripts, images, styles) is removed when saved. In plain text, a blank line starts a new paragraph.</p>
        </div>

        <div>
            <label for="{{ $id('footer') }}" class="{{ $label }}">Footer text <span class="text-gray-400 font-normal">(optional)</span></label>
            <textarea id="{{ $id('footer') }}" name="footer" x-ref="footer" @focus="field='footer'" rows="2" class="{{ $input }} resize-none">{{ $value('footer') }}</textarea>
        </div>

        @if($isAck)
        <div>
            <label for="{{ $id('company_details') }}" class="{{ $label }}">Company name and contact details <span class="text-gray-400 font-normal">(optional)</span></label>
            <textarea id="{{ $id('company_details') }}" name="company_details" x-ref="company_details" @focus="field='company_details'" rows="3" class="{{ $input }} resize-none">{{ $value('company_details') }}</textarea>
            <p class="{{ $hint }}">Shown above the footer. Use the company placeholders to follow Site Settings automatically.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="{{ $id('button_text') }}" class="{{ $label }}">Button text <span class="text-gray-400 font-normal">(optional)</span></label>
                <input type="text" id="{{ $id('button_text') }}" name="button_text" value="{{ $value('button_text') }}" maxlength="80" placeholder="Explore our expertise" class="{{ $input }}">
            </div>
            <div>
                <label for="{{ $id('button_url') }}" class="{{ $label }}">Button URL</label>
                <input type="url" id="{{ $id('button_url') }}" name="button_url" value="{{ $value('button_url') }}" maxlength="500" placeholder="{{ url('/expertise') }}" class="{{ $input }}">
            </div>
        </div>
        @else
        <div>
            <label for="{{ $id('button_text') }}" class="{{ $label }}">Button text</label>
            <input type="text" id="{{ $id('button_text') }}" name="button_text" value="{{ $value('button_text') }}" maxlength="80" class="{{ $input }}">
            <p class="{{ $hint }}">The button always links to the enquiry in the admin panel. Leave empty to hide it.</p>
        </div>
        @endif

        <div class="flex flex-wrap items-center gap-3 pt-2">
            <button type="submit" name="_method" value="PUT" class="bg-teal-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-teal-700 transition-colors">Save Template</button>
            <button type="submit" formaction="{{ route('admin.email-settings.templates.preview', $type) }}" formtarget="_blank" formnovalidate
                    class="border border-teal-600 text-teal-700 px-6 py-3 rounded-lg font-semibold hover:bg-teal-50 transition-colors">Preview Template</button>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold text-gray-800 pb-3 mb-3 border-b border-gray-100">Placeholders</h3>
            <p class="text-xs text-gray-500 mb-3">Click to insert into the field you last selected. Visitor values are escaped automatically; missing optional fields show “Not provided”.</p>
            <ul class="space-y-1.5">
                @foreach($available as $key => $description)
                <li class="flex items-start gap-2">
                    <button type="button" @click="insert(@js($token($key)))" class="shrink-0 font-mono text-xs bg-gray-100 hover:bg-teal-50 hover:text-teal-700 px-2 py-1 rounded">{{ $token($key) }}</button>
                    <span class="text-xs text-gray-500 pt-1">{{ $description }}</span>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-2">
            <h3 class="font-semibold text-gray-800 pb-3 mb-1 border-b border-gray-100">Send Test Template</h3>
            <p class="text-xs text-gray-500">Sends the template as currently typed (saved or not), filled with sample enquiry data.</p>
            <label for="{{ $id('test_recipient') }}" class="{{ $label }}">Send to</label>
            <input type="email" id="{{ $id('test_recipient') }}" name="test_recipient" value="{{ $mine ? old('test_recipient', auth()->user()->email) : auth()->user()->email }}" class="{{ $input }}">
            <button type="submit" formaction="{{ route('admin.email-settings.templates.test', $type) }}"
                    class="w-full bg-gray-700 text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-800 transition-colors">Send Test Template</button>
        </div>
    </div>
</form>
