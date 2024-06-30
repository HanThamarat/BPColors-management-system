<x-fullcard>
    <div id="card-stockcal" class="flex items-center justify-center flex-wrap gap-y-3 gap-x-3">
        @if (count(@$data['stockData']) !== 0) 
            @foreach (@$data['stockData'] as $item)
                @component('components.content-card.card-cal')
                    @slot('data', [
                        "StockCal" => @$item->StockCal,
                        "ProductNo" => @$item->ProductNo,
                        "ProDetail" => @$item->ProductDetail,
                    ])
                @endcomponent
            @endforeach
        @else
        <div>
            <div class="stock__con flex justify-center my-6">
                <img src="{{ asset('img/out-of-stock.png') }}" class="out__of w-[100px] animate-bounce animate-infinite animate-duration-1000 animate-delay-500 animate-ease-out" alt="">
            </div>
            <div class="flex justify-center text-gray-600 mt-1">
                <span>ยังไม่ข้อมูลสต็อกสินค้า</span>
            </div>
        </div>
        @endif
    </div>
</x-fullcard>
