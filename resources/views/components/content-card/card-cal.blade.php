<div class="border border-blue-500 rounded-md drop-shadow-sm px-2 py-3 w-[350px]">
    <div class="flex gap-x-1 items-end">
        <img src="{{ asset('gif/box-stock.gif') }}" class="h-[35px]" alt="">
        <span class="text-blue-500">{{ @$data['ProductNo'] }}</span>
    </div>
    <div class="my-2 text-[14px]">
        <span class="text-red-500">ราคาละเอียดสินค้า: {{ @$data['ProductDetail'] }}</span>
    </div>
    <div class="w-full bg-gray-200 rounded-full my-2">
        <div class="{{ @$data['StockCal'] < 20 ? 'bg-red-500' : 'bg-blue-500' }} text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: {{ @$data['StockCal'] > 100 ? 100 : @$data['StockCal'] }}%"> {{ @$data['StockCal'] }}%</div>
    </div>
</div>