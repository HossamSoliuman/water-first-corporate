<aside x-show="sidebarOpen" x-cloak class="w-64 bg-navy-900 text-white flex flex-col shrink-0 fixed inset-y-0 left-0 z-50 lg:static lg:z-auto lg:!flex">
    <div class="p-5 border-b border-white/10">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/waterfirst-logo.svg') }}" alt="WaterFirst" class="h-9 w-auto brightness-0 invert opacity-90">
            <span class="text-xs font-semibold text-slate-400 uppercase tracking-widest">Admin</span>
        </a>
    </div>

    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-0.5 text-sm">
        @php
        $nav = [
            ['admin.dashboard',           'squares-2x2',            'Dashboard',          'admin/'],
            ['admin.leads.index',         'inbox',                  'Leads',              'admin/leads'],
            ['admin.blogs.index',         'pencil-square',          'Blog Posts',         'admin/blogs'],
            ['admin.blog-categories.index','folder',               'Blog Categories',    'admin/blog-categories'],
            ['admin.blog-tags.index',     'tag',                   'Blog Tags',          'admin/blog-tags'],
            ['admin.case-studies.index',  'clipboard-document-list','Case Studies',       'admin/case-studies'],
            ['admin.case-study-categories.index','folder',         'CS Categories',      'admin/case-study-categories'],
            ['admin.industries.index',    'building-office',        'Industries',         'admin/industries'],
            ['admin.expertise.index',     'cog-6-tooth',            'Expertise',          'admin/expertise'],
            ['admin.job-listings.index',  'briefcase',              'Careers',            'admin/job-listings'],
            ['admin.career-images.index','photo',                  'Career Gallery',     'admin/career-images'],
            ['admin.team-members.index',  'user-group',             'Team Members',       'admin/team-members'],
            ['admin.software-logos.index','computer-desktop',       'Softwares We Use',   'admin/software-logos'],
            ['admin.hero-slides.index',   'film',                   'Hero Video',         'admin/hero-slides'],
            ['admin.pages.index',         'document-arrow-down',    'Pages',              'admin/pages'],
            ['admin.users.index',         'user-circle',            'Users',              'admin/users'],
            ['admin.settings.index',      'cog-6-tooth',            'Settings',           'admin/settings'],
        ];
        @endphp

        @foreach($nav as [$route,$icon,$label,$match])
        @php $active = request()->is($match.'*'); @endphp
        <a href="{{ route($route) }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-150 {{ $active ? 'bg-teal-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
            <x-icon name="{{ $icon }}" class="w-4 h-4 shrink-0"/>
            <span>{{ $label }}</span>
            @if($route === 'admin.leads.index' && $unreadLeads > 0)
            <span class="ml-auto bg-brown-500 text-white text-xs rounded-full px-1.5 py-0.5 min-w-[1.25rem] text-center font-semibold">{{ $unreadLeads }}</span>
            @endif
        </a>
        @endforeach
    </nav>

    <div class="p-4 border-t border-white/10">
        <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 text-xs text-slate-500 hover:text-white transition-colors">
            <x-icon name="arrow-long-right" class="w-3.5 h-3.5"/>
            View site
        </a>
    </div>
</aside>
