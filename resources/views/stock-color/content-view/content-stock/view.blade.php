<x-app-layout>
    @component('components.content-header.guide')
        @slot('data', [
            'title' => 'นำสินค้าเข้า',
            'guide' => [
                'active' => 'นำสินค้าเข้า',
            ],
            'list' => [
                'head' => 'สต็อกสี',
            ],
        ])
    @endcomponent
    @component('stock-color.content-view.content-stock.components.tab')
        
    @endcomponent
    @component('stock-color.content-view.content-stock.content-stockcal.view')
        @slot('data', [
            "stockData" => $stockData,
        ])
    @endcomponent
</x-app-layout>