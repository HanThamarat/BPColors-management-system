@foreach (@$stockCal as $item)
    @component('components.content-card.card-cal')
        @slot('data', [
            "StockCal" => @$item->StockCal,
            "ProductNo" => @$item->ProductNo,
            "ProDetail" => @$item->ProductDetail,
        ])
    @endcomponent
@endforeach
