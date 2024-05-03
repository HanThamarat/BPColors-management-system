<x-app-layout>
    {{-- @livewire('customer-screen') --}}
    <livewire:customer-screen lazy />
    @include('manageBP.components.content-customer.script-cus')
    {{-- @component('components.cus-placehoder')
        
    @endcomponent --}}
</x-app-layout>