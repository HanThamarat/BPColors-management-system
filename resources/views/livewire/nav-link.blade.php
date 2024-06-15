@if (auth()->user()->hasRole(['admin', 'superadmin', 'BP']))
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link href="{{ route('create') }}" :active="request()->routeIs('create')">
            {{ __('บันทึกข้อมูล BP') }}
        </x-nav-link>
        <x-nav-link href="{{ route('showbp') }}" :active="request()->routeIs('showbp')">
            {{ __('ข้อมูล BP') }}
        </x-nav-link>
        <x-nav-link href="{{ route('postreport') }}" :active="request()->routeIs('postreport')">
            {{ __('Report') }}
        </x-nav-link>
        @hasrole(['superadmin'])
        <x-nav-link href="{{ route('manage-user') }}" :active="request()->routeIs('manage-user')">
            {{ __('Manage User') }}
        </x-nav-link>
        <x-nav-link href="{{ route('manage-job') }}" :active="request()->routeIs('manage-job')">
            {{ __('Manage Job') }}
        </x-nav-link>
        @endhasrole
    </div>
@elseif(auth()->user()->hasRole(['colorstock']))
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link href="{{ route('stock.index') }}" :active="request()->routeIs('stock.index')">
            {{ __('สร้างสต็อกสี') }}
        </x-nav-link>
        <x-nav-link href="{{ route('page.index') }}?page={{ 'incomingStock' }}" :active="request()->routeIs('page.index')">
            {{ __('นำเข้า-ออก') }}
        </x-nav-link>
        <x-nav-link href="{{ route('stocklist.index') }}" :active="request()->routeIs('stocklist.index')">
            {{ __('รายการสต็อกสี') }}
        </x-nav-link>
    </div>
@endif