<style>
    body {
   --sb-track-color: #F5F5F5;
   --sb-thumb-color: #3B82F6;
   --sb-size: 5px;
   }

   .stock__list {
       margin-top: 5px;
       height: 300px;
       overflow-y: scroll;
       padding: 5px;
   }

   .stock__list::-webkit-scrollbar {
       width: var(--sb-size);
   }

   .stock__list::-webkit-scrollbar-track {
       background: var(--sb-track-color);
       border-radius: 4px;
   }

   .stock__list::-webkit-scrollbar-thumb {
       background: var(--sb-thumb-color);
       border-radius: 4px;
   }

   @supports not selector(::-webkit-scrollbar) {
       .stock__list {
           scrollbar-color: var(--sb-thumb-color)
                            var(--sb-track-color);
       }
   }
</style>
<div class="flex gap-x-2 items-center text-red-500 mb-5" data-aos="fade-up" data-aos-duration="1000">
    {{-- <i class="fa-solid fa-boxes-stacked"></i> --}}
    <img src="{{ asset('gif/delivery-completed.gif') }}" class="h-[35px]" alt="">
    <span>สต็อกนำออกปัจจุบัน</span>
</div>
<div class="text-[14px] overflow-x-auto stock__list" data-aos="fade-up" data-aos-duration="1000">
    <table class="w-full border-back border-collapse">
        <thead class="font-prompt">
            <tr class="border-2 rounded">
                <th class="py-2">รหัสสินค้า</th>
                <th>คำอธิบาย</th>
                <th>หน่วย</th>
                <th>จำนวน</th>
                <th>ราคาต่อหน่อย</th>
                <th>ราคารวม</th>
                <th>วัทที่ออก</th>
            </tr>
        </thead>
        <tbody class="text-center my-2">
            @foreach ($res as $key => $item)
                <tr class="border-b">
                    <td class="py-2">{{ $item->Product_Id }}</td>
                    <td>{{ $item->Stock->ProductDetail }}</td>
                    <td>{{ $item->Stock->UnitType }}</td>
                    <td>{{ number_format($item->OutGramQuantity, 2) }}</td>
                    <td>{{ $item->Stock->UnitPrice }}</td>
                    <td>{{ number_format($item->OutUnitPrice) }}</td>
                    <td>{{ $item->DateSt_Out }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>