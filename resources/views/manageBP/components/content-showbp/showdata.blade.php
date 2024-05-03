
        <div class="flex justify-between items-center">
            <div class="font-medium">
                <span>ข้อมูล BP</span>
            </div>
            <div>
                <input type="text" class="rounded ">
            </div>
        </div>
        <div class="w-full py-8 px-2 border rounded mt-2">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 ">
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
                                    @if ($items->date_status !== null)
                                        {{ $items->date_status }}
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
                                    @if ($items->no_policy !== null)
                                        {{ $items->no_policy }}
                                    @else
                                        ไม่มีข้อมูล
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($items->firm_sparepart !== null)
                                        {{ $items->firm_sparepart }}
                                    @else
                                        ไม่มีข้อมูล
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($numClaim > 0)
                                        มี
                                    @else
                                        ไม่มี
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($items->firm_all !== null)
                                        {{ $items->firm_all }}
                                    @else
                                        ไม่มีข้อมูล
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($items->firm_all !== null)
                                        {{ $items->firm_all }}
                                    @else
                                        ไม่มีข้อมูล
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <button class="bg-gray-100 py-5 px-5 w-2 h-2 flex justify-center items-center rounded-full" wire:click="redirects({{ $items->id }})"><i class="fa-regular fa-user"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>            
        </div>