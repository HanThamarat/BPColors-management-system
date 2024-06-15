<x-app-layout>
    @component('components.content-header.guide')
        @slot('data', [
            'title' => 'รายการสต็อกสี',
            'guide' => [
                'active' => 'รายการสต็อกสี',
            ],
            'list' => [
                'head' => 'สต็อกสี',
            ],
        ])
    @endcomponent
    @component('stock-color.content-view.content-list.components.form')
        
    @endcomponent
</x-app-layout>