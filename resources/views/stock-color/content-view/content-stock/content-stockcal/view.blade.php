<x-fullcard>
    <div class="flex items-center justify-center flex-wrap gap-y-3 gap-x-3">
        @foreach (@$data['stockData'] as $item)
        @component('components.content-card.card-cal')
            @slot('data', [
                "StockCal" => @$item->StockCal,
                "ProductNo" => @$item->ProductNo,
                "ProDetail" => @$item->ProductDetail,
            ])
        @endcomponent
        @endforeach
    </div>
</x-fullcard>