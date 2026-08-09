<form method="POST" action="{{ route('contact.submit') }}" class="grid gap-5">
    @csrf

    @if (session('success'))
        <div class="technical-rule bg-accent-50 p-4 text-sm text-accent-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="name" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-ink-700">Full name <span class="text-accent-600">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full rounded-sm border border-ink-200 bg-white px-4 py-3 text-sm text-ink-800 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-100 @error('name') border-accent-700 @enderror">
            @error('name') <p class="mt-1 text-xs text-accent-800">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="email" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-ink-700">Email address <span class="text-accent-600">*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full rounded-sm border border-ink-200 bg-white px-4 py-3 text-sm text-ink-800 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-100 @error('email') border-accent-700 @enderror">
            @error('email') <p class="mt-1 text-xs text-accent-800">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="phone" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-ink-700">Phone number</label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="w-full rounded-sm border border-ink-200 bg-white px-4 py-3 text-sm text-ink-800 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-100">
        </div>
        <div>
            <label for="company" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-ink-700">Organisation</label>
            <input type="text" id="company" name="company" value="{{ old('company') }}" class="w-full rounded-sm border border-ink-200 bg-white px-4 py-3 text-sm text-ink-800 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-100">
        </div>
    </div>

    <div>
        <label for="subject" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-ink-700">Project / subject</label>
        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" class="w-full rounded-sm border border-ink-200 bg-white px-4 py-3 text-sm text-ink-800 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-100">
    </div>

    <div>
        <label for="message" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-ink-700">Message <span class="text-accent-600">*</span></label>
        <textarea id="message" name="message" rows="6" required class="w-full resize-none rounded-sm border border-ink-200 bg-white px-4 py-3 text-sm text-ink-800 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-100 @error('message') border-accent-700 @enderror">{{ old('message') }}</textarea>
        @error('message') <p class="mt-1 text-xs text-accent-800">{{ $message }}</p> @enderror
    </div>

    <div>
        {!! NoCaptcha::display() !!}
        @error('g-recaptcha-response') <p class="mt-1 text-xs text-accent-800">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="wf-btn-primary w-full sm:w-auto group">
        Send enquiry <x-icon name="arrow-long-right" class="h-4 w-4 arrow-nudge" />
    </button>
</form>

@push('scripts')
    {!! NoCaptcha::renderJs() !!}
@endpush
