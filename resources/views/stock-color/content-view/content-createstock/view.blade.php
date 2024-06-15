<x-app-layout>
    @component('components.content-header.guide')
        @slot('data', [
            'title' => 'สร้างสต็อกสี',
            'guide' => [
                'active' => 'สร้างสต็อกสี',
            ],
            'list' => [
                'head' => 'สต็อกสี',
            ],
        ])
    @endcomponent
    <x-cardnon>
        @include('stock-color.content-view.content-createstock.input')
    </x-cardnon>
    @include('stock-color.content-view.content-createstock.content-liststock.view')
</x-app-layout>