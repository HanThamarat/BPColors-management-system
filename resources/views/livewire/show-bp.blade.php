<div>
    <div class="block lg:flex justify-between items-center ">
        <div class="w-full">
            <span> ข้อมูล BP (BP Detail)</span>
        </div>
        <div class="block lg:flex w-full justify-end">
            <div class="lg:mr-1">
                <label for="">จากวันที่</label>
                <input type="date" class="w-full py-1 lg:px-2 rounded bg-gray-200 block" style="border: none;" wire:model.live="fromdate">
            </div>
            <div class="lg:mx-1">
                <label for="">ถึงวันที่</label>
                <input type="date" class="w-full py-1 lg:px-2 rounded bg-gray-200 block" style="border: none;" wire:model.live="todate">
            </div>
            <div class="lg:mx-1">
                <label for="">สถานะ</label>
                <select name="claim_status" id="" class="w-full py-1 lg:px-2 rounded bg-gray-200 block" style="border: none;" wire:model.live="claim_st">
                    <option value="A เปิดใบรับรถ">A เปิดใบรับรถ</option>
                    <option value="B รอประกันอนุมัติ">B รอประกันอนุมัติ</option>
                    <option value="C ประกันอนุมัติ">C ประกันอนุมัติ</option>
                    <option value="D รออะไหล่">D รออะไหล่</option>
                    <option value="E อะไหล่ครบ">E อะไหล่ครบ</option>
                    <option value="F ดำเนินการซ่อม">F ดำเนินการซ่อม</option>
                    <option value="G รถเสร็จสมบูรณ์">G รถเสร็จสมบูรณ์</option>
                    <option value="H รถส่งออก">H รถส่งออก</option>
                    <option value="I ขออนุมัติวางบิล">I ขออนุมัติวางบิล</option>
                    <option value="J วางบิลเรียบร้อย">J วางบิลเรียบร้อย</option>
                    <option value="K ชำระเงินแล้ว">K ชำระเงินแล้ว</option>
                    <option value="L ยกเลิกงานเคลม">L ยกเลิกงานเคลม</option>
                </select>
            </div>
            <div class="lg:ml-1">
                <label for="">เลข JOB</label>
                <div class="flex items-center">
                    <input type="text" class="w-full py-1 px-2 bg-gray-200 rounded" style="border: none;" placeholder="search.." wire:model.live="search">
                </div>
            </div>
            <div class="lg:ml-1">
                <label for="">ป้ายทะเบียน</label>
                <div class="flex items-center">
                    <input type="text" class="w-full py-1 px-2 bg-gray-200 rounded" style="border: none;" placeholder="search.." wire:model.live="no_regiscar">
                </div>
            </div>
        </div>
    </div>
    <div class="w-full py-4 px-2 border rounded mt-2">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 text-center">
                    <tr>
                        <th scope="col" class="px-6 py-3 rounded-s-lg">
                            เลขที่เคลม
                        </th>
                        <th scope="col" class="px-6 py-3">
                            สถานะ
                        </th>
                        <th scope="col" class="px-6 py-3">
                            ประเภทงาน
                        </th>
                        <th scope="col" class="px-6 py-3">
                            วันที่เคลม
                        </th>
                        <th scope="col" class="px-6 py-3">
                            สถานะงานอนุมัติ
                        </th>
                        <th scope="col" class="px-6 py-3">
                            วันที่รับรถ
                        </th>
                        <th scope="col" class="px-6 py-3">
                            ทะเบียนรถ
                        </th>
                        <th scope="col" class="px-6 py-3">
                            เลขที่ Job
                        </th>
                        <th scope="col" class="px-6 py-3">
                            เลขที่กรมธรรม์
                        </th>
                        <th scope="col" class="px-6 py-3">
                            อนุมัติค่าอะไหล่
                        </th>
                        <th scope="col" class="px-6 py-3">
                            อนุมัติค่าแรง
                        </th>
                        <th scope="col" class="px-6 py-3">
                            อนุมัติรวม
                        </th>
                        <th scope="col" class="px-6 py-3 rounded-e-lg">
                            action
                        </th>
                    </tr>
                </thead>
                <tbody class="overflow-auto" style="height: 50vh;">
                    {{-- {{ dd($GetClaim) }} --}}
                    @foreach ($GetClaim as $items)
                        <tr class="bg-white ">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                @if ($items->no_claim !== null)
                                    {{ $items->no_claim }}
                                @else
                                    ไม่มีข้อมูล
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($items->payment_st !== null)
                                    {{ $items->payment_st }}
                                @else
                                    ไม่มีข้อมูล
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($items->car_job !== null || $items->car_job !== '')
                                    {{ $items->car_job }}
                                @else
                                    ไม่มีข้อมูล
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($items->date_cliam !== null)
                                    {{ $items->date_cliam }}
                                @else
                                    ไม่มีข้อมูล
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($items->payment_st !== null)
                                    {{ $items->payment_st }}
                                @else
                                    ไม่มีข้อมูล
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($items->date_carin !== null)
                                    {{ $items->date_carin }}
                                @else
                                    ไม่มีข้อมูล
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($items->no_regiscar !== null)
                                    {{ $items->no_regiscar }}
                                @else
                                    ไม่มีข้อมูล
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($items->no_job !== null)
                                    {{ $items->no_job }}
                                @else
                                    ไม่มีข้อมูล
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($items->no_policy !== null || $items->no_policy == '')
                                    {{ $items->no_policy }}
                                @else
                                    ไม่มีข้อมูล
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($items->firm_sparepart !== null)
                                    {{  number_format($items->firm_sparepart) }}
                                @else
                                    ไม่มีข้อมูล
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($items->firm_all !== null)
                                    {{ number_format($items->firm_all, 2) }}
                                @else
                                    ไม่มีข้อมูล
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($items->firm_all !== null)
                                    {{ number_format($items->firm_all, 2) }}
                                @else
                                    ไม่มีข้อมูล
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-x-1">
                                    @php
                                        $btn_arr_data = [
                                            [
                                                'icon' => 'fa-regular fa-user',
                                                'icon-color' => '',
                                                'icon-hover-color' => 'blue',
                                                'active-func' => 'redirects',
                                            ],
                                            [
                                                'icon' => 'fa-solid fa-trash',
                                                'icon-color' => '',
                                                'icon-hover-color' => 'red',
                                                'active-func' => 'deleteRow',
                                            ],
                                        ];
                                    @endphp
                                    @hasrole(['superadmin'])
                                        @component('components.radius-full-btn')
                                            @slot('data', [
                                                'btn-data-arr' => $btn_arr_data,
                                                'claim_id' => $items->id
                                            ])
                                        @endcomponent
                                    @endhasrole
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $GetClaim->links() }}
        </div>            
    </div>
</div>
