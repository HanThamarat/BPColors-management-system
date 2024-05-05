<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    @if (@$UserRole[0]->role == "admin")
        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            {{ __('บันทึกข้อมูล BP') }}
        </x-nav-link>
        <x-nav-link href="{{ route('showbp') }}" :active="request()->routeIs('showbp')">
            {{ __('ข้อมูล BP') }}
        </x-nav-link>
        <x-nav-link href="{{ route('postreport') }}" :active="request()->routeIs('postreport')">
            {{ __('Report') }}
        </x-nav-link>
        <x-nav-link href="{{ route('manage-user') }}" :active="request()->routeIs('manage-user')">
            {{ __('Manage User') }}
        </x-nav-link>
    @else
        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            {{ __('บันทึกข้อมูล BP') }}
        </x-nav-link>
        <x-nav-link href="{{ route('showbp') }}" :active="request()->routeIs('showbp')">
            {{ __('ข้อมูล BP') }}
        </x-nav-link>
        <x-nav-link href="{{ route('postreport') }}" :active="request()->routeIs('postreport')">
            {{ __('Report') }}
        </x-nav-link>
    @endif
</div>
