<div class="border {{ @$data['StockCal'] <= 0 || @$data['StockCal'] < 20 ? ' border-red-500 animate-pulse animate-infinite animate-duration-1000 animate-ease-in-out' : ' border-blue-500' }} rounded-md drop-shadow-sm px-2 py-3 w-[360px]">
    <div class="flex gap-x-1 items-end">
        <img src="{{ asset('gif/box-stock.gif') }}" class="h-[35px]" alt="">
        <span class="{{ @$data['StockCal'] <= 0 || @$data['StockCal'] < 20 ? 'text-red-500' : 'text-blue-500' }}">{{ @$data['ProductNo'] }}</span>
    </div>
    <div class="my-2 text-[14px]">
        <span class="{{ @$data['StockCal'] <= 0 || @$data['StockCal'] < 20 ? 'text-red-500' : 'text-blue-500' }}">รายละเอียดสินค้า: {{ @$data['ProDetail'] }}</span>
    </div>
    <div class="w-full bg-gray-200 rounded my-2">
        @if (@$data['StockCal'] <= 0)
            <div class="bg-red-500 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded" style="width: 100%">กรุณาเติมสต็อก</div>
        @else
            <div class="{{ @$data['StockCal'] < 20 ? 'bg-red-500' : 'bg-blue-500' }} text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded" style="width: {{ @$data['StockCal'] > 100 ? 100 : @$data['StockCal'] }}%"> {{ @$data['StockCal'] }}%</div>
        @endif
    </div>
</div>