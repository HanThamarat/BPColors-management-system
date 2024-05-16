<div class="lg:w-3/5 px-2 py-4">
    <div class="rounded px-2 py-5 bg-white drop-shadow-md">
        <div class="flex justify-between items-center">
            <div class="text-sm text-blue-600">
                <i class="fa-regular fa-user"></i>
                <span>ข้อมูล BP (BP Details)</span>
            </div>
            <div>
                <button class="btn-edit" wire:click.prevent="openFormCustomer"><i class="fa-solid fa-pen-to-square text-sm"></i></button>
            </div>
        </div>
        <x-detail>
            <div class="justify-between flex">
                <div class="w-full mr-2">
                    <div class="flex justify-between border-b my-1">
                        <span>สถานะ: </span>
                        <p>{{ $getUserData->payment_st !== '' ? $getUserData->payment_st : 'ไม่มีข้อมูล' }}</p>
                    </div>
                    <div class="flex justify-between border-b my-1">
                        <span>เลขที่เคลม: </span>
                        <p>{{ $getUserData->no_claim !== '' ? $getUserData->no_claim : 'ไม่มีข้อมูล' }}</p>
                    </div>
                    <div class="flex justify-between border-b my-1">
                        <span>ทะเบียนรถ: </span>
                        <p>{{ $getUserData->no_regiscar !== '' ? $getUserData->no_regiscar : 'ไม่มีข้อมูล' }}</p>
                    </div>
                    <div class="flex justify-between border-b my-1">
                        <span>ยีห้อ: </span>
                        <p>{{ $getUserData->car_brand !== '' ? $getUserData->car_brand : 'ไม่มีข้อมูล'  }}</p>
                    </div>
                    <div class="flex justify-between border-b my-1">
                        <span>รุ่นรถ: </span>
                        <p>{{ $getUserData->car_model !== '' ? $getUserData->car_model : 'ไม่มีข้อมูล'  }}</p>
                    </div>
                    <div class="flex justify-between border-b my-1">
                        <span>เลขตัวถัง: </span>
                        <p>{{ $getUserData->car_chassis !== '' ? $getUserData->car_chassis : 'ไม่มีข้อมูล'  }}</p>
                    </div>
                    <div class="flex justify-between border-b my-1">
                        <span>ผู้รับเคส: </span>
                        <p>{{ $getUserData->user_con !== '' ? $getUserData->user_con : 'ไม่มีข้อมูล'  }}</p>
                    </div>
                    <div class="flex justify-between border-b my-1">
                        <span>เลขที่กรมธรรม์: </span>
                        <p>{{ $getUserData->no_policy !== '' ? $getUserData->no_policy : 'ไม่มีข้อมูล'  }}</p>
                    </div>
                    <div class="flex justify-between border-b my-1">
                        <span>แหล่งที่มาลูกค้า: </span>
                        <p>{{ $getUserData->cus_resource !== '' ? $getUserData->cus_resource : 'ไม่มีข้อมูล'  }}</p>
                    </div>
                    <div class="flex justify-between border-b my-1">
                        <span>แหล่งต่อประกัน: </span>
                        <p>{{ $getUserData->insure_source !== '' ? $getUserData->insure_source : 'ไม่มีข้อมูล'  }}</p>
                    </div>
                    <div class="flex justify-between border-b my-1">
                        <span>ประกัน: </span>
                        <p>{{ $getUserData->insure_name !== '' ? $getUserData->insure_name : 'ไม่มีข้อมูล'  }}</p>
                    </div>
                    <div class="flex justify-between border-b my-1">
                        <span>สถานะการซ่อม: </span>
                        <p>{{ $getUserData->job_status !== '' ? $getUserData->job_status : 'ไม่มีข้อมูล'  }}</p>
                    </div>
                </div>
                <div class="w-full ml-2">
                    <div class="flex justify-between border-b my-1">
                        <span>เลขที่ Job (BP) (RO) (SA): </span>
                        <p>{{ $getUserData->no_job !== '' ? $getUserData->no_job : 'ไม่มีข้อมูล'  }}</p>
                    </div>
                    <div class="flex justify-between border-b my-1">
                        <span>ประเภทประกันภัย: </span>
                        <p>{{ $getUserData->insure_type !== '' ? $getUserData->insure_type : 'ไม่มีข้อมูล'  }}</p>
                    </div>
                    <div class="flex justify-between border-b my-1">
                        <span>ประเภท EMCS: </span>
                        <p>{{ $getUserData->emcs !== '' ? $getUserData->emcs : 'ไม่มีข้อมูล'  }}</p>
                    </div>
                    <div class="flex justify-between border-b my-1">
                        <span>ประเภทงาน: </span>
                        <p>{{ $getUserData->car_job !== '' ? $getUserData->car_job : 'ไม่มีข้อมูล'  }}</p>
                    </div>
                    <div>
                        <span>หมายเหตุ: </span>
                        <div class="bg-white px-2 py-2 flex rounded h-48">
                            <p class="">{{ $getUserData->remark != '' ? $getUserData->remark : 'ไม่มีข้อมูล'}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </x-detail>
    </div>
    <div class="rounded px-2 py-5 mt-2 bg-white drop-shadow-md">
        <div class="flex justify-between items-center text-sm" id="tab-bar">
            {{-- <button class="btn-detail w-full  py-1 px-2 rounded bg-blue-500 text-white mr-1" onclick="handleDetail()">รายละเอียดอื่นๆ</button>
            <button class="btn-repaire w-full  py-1 px-2 rounded  ml-1" onclick="handleRepaire()">รายการซ่อม</button> --}}
            <button wire:loading.class="bg-blue-500 text-white" onclick="handleDetail()" class="btn-detail w-full flex justify-center items-center gap-x-2 py-1 px-2 rounded {{ $cus_tail ? 'bg-blue-500 text-white' : 'hover:bg-blue-400 hover:text-white' }} duration-150 mr-1" wire:click.prevent="handledetail({{ 0 }})" {{ $cus_tail ? 'disabled' : '' }}>
                <span wire:loading.class="hidden" class="">รายละเอียดอื่นๆ</span>
                <svg wire:loading aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
            </button>
            <button wire:loading.class="bg-blue-500 text-white" onclick="handleRepaire()" class="btn-repaire w-full flex justify-center items-center gap-x-2 py-1 px-2 rounded {{ $repair_tail ? 'bg-blue-500 text-white' : 'hover:bg-blue-400 hover:text-white' }} duration-150 ml-1" wire:click.prevent="handledetail({{ 1 }})" {{ $repair_tail ? 'disabled' : '' }}>
                <span wire:loading.class="hidden" class="">รายการซ่อม</span>
                <svg wire:loading aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
            </button>
        </div>
        <div class="animate-pulse flex space-x-4">
                <div wire:loading class="flex-1 space-y-6 py-1 my-5">
                <div class="h-2 bg-blue-600 rounded"></div>
                <div class="space-y-3">
                    <div class="grid grid-cols-3 gap-4">
                    <div class="h-2 bg-blue-600 rounded col-span-2"></div>
                    <div class="h-2 bg-blue-600 rounded col-span-1"></div>
                    </div>
                    <div class="h-2 bg-blue-600 rounded"></div>
                </div>
                </div>
          </div>
          <div wire:loading.class="hidden">
                <div class="detail__bp  {{ $cus_tail ? '' : 'hidden' }}">
                    @if ($getUserData->date_cliam !== null)
                        <div class="mt-0 py-4 px-4 rounded bg-gray-100 text-sm">
                            <div class="flex justify-end">
                                <button class="w-10 h-10 flex justify-center items-center rounded-full bg-white mb-5" wire:click.prevent="openPopup({{ 0 }})"><i class="fa-solid fa-pen-to-square text-sm"></i></button>
                            </div>
                            <div class="flex w-full">
                                <div class="w-3/6 mr-4">
                                    <div>
                                        <div class="border-b">
                                            <span>วันที่เคลม : {{ $getUserData->date_cliam !== null ?  $getUserData->date_cliam : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>วันที่นัดหมายรับบริการ : {{ $getUserData->date_service !== null ?  $getUserData->date_service : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>วันที่รับรถ : {{ $getUserData->date_carin !== null ?  $getUserData->date_carin : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>วันที่ซ่อม : {{ $getUserData->date_repair !== null ?  $getUserData->date_repair : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>วันที่ส่งมอบระบบ : {{ $getUserData->date_repair !== null ?  $getUserData->date_repair : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>วันนัดส่งมอบจริง : {{ $getUserData->date_send_next !== null ?  $getUserData->date_send_next : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <div class="mt-2 border-b">
                                            <span>อนุมัติค่าแรง : {{ $getUserData->firm_doit !== null ?  $getUserData->firm_doit : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>อนุมัติรวม : {{ $getUserData->firm_all !== null ?  $getUserData->firm_all : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>อนุมัติค่าอะไหล่ : {{ $getUserData->firm_sparepart !== null ?  $getUserData->firm_sparepart : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>วันที่ส่งรถ : {{ $getUserData->date_send_car !== null ?  $getUserData->date_send_car : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <div class="border-b">
                                            <span>เลขที่ใบกำกับภาษี (SA): {{ $getUserData->invoice_no !== null ?  $getUserData->invoice_no : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>วันวางบิลตัวจริง: {{ $getUserData->date_bill !== null ?  $getUserData->date_bill : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>จำนวนเงินรับจริง: {{ $getUserData->total_pay !== null ?  $getUserData->total_pay : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>เลขที่วางบิล (Cashier): {{ $getUserData->bill_no !== null ?  $getUserData->bill_no : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>วันกำหนดจ่ายเงิน: {{ $getUserData->date_paybill !== null ?  $getUserData->date_paybill : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>วันที่ได้รับเงิน: {{ $getUserData->date_transfer !== null ?  $getUserData->date_transfer : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-3/6 ml-4">
                                    <div>
                                        <div class="border-b">
                                            <span>ประเมินค่าแรง : {{ $getUserData->cost_doit !== null ?  $getUserData->cost_doit : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>ประเมินค่าอะไหล่ : {{ $getUserData->cost_sparepart !== null ?  $getUserData->cost_sparepart : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>ประเมินรวม : {{ $getUserData->cost_totel !== null ?  $getUserData->cost_totel : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>ประกันอนุมัติ : {{ $getUserData->date_firmins !== null ?  $getUserData->date_firmins : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <div class="border-b">
                                            <span>วันส่งมอบ/วันเปิดแจ้งหนี้ DMS: {{ $getUserData->date_dms !== null ?  $getUserData->date_dms : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>วันที่ได้อนุมัติ E-Claim: {{ $getUserData->date_fecliam !== null ?  $getUserData->date_fecliam : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>วันที่ขออนุมัติใน E-Claim: {{ $getUserData->date_ecliam !== null ?  $getUserData->date_ecliam : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                        <div class="mt-2 border-b">
                                            <span>ค่า exzept: {{ $getUserData->exzept !== null ?  $getUserData->exzept : 'ไม่มีข้อมูล' }}</span>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <span>หมายเหตุ: </span>
                                        <div class="bg-white px-2 py-2 flex rounded h-48">
                                            <p class="">{{ $getUserData->note_service != '' ? $getUserData->note_service : 'ไม่มีข้อมูล'}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="stock__con">
                            <img src="{{ asset('img/out-of-stock.png') }}" class="out__of animate-bounce animate-infinite animate-duration-1000 animate-delay-500 animate-ease-out" alt="">
                        </div>
                        <div class="flex justify-center text-gray-600 mt-2">
                            <span>ยังไม่ข้อมูลรายละเอียด BP</span>
                        </div>
                        <div class="flex justify-center mt-2">
                            <button wire:loading.class.add="hidden" class="px-4 h-10 rounded text-sm bg-blue-500 text-white hover:bg-blue-600 duration-100 ease-in-out" wire:click.prevent="openPopup({{ 0 }})">
                                เพิ่มรายละเอียด
                            </button>
                            <button wire:loading class="px-4 h-10 rounded text-sm bg-blue-400 text-white">
                                @component('components.content-Loading.spinner')@endcomponent
                            </button>
                        </div>
                    @endif
            </div>
            <div class="detail__repair {{ $repair_tail ? '' : 'hidden' }}">
                @if (count($wipData) === 0)
                    <div class=" stock__con">
                        <img src="{{ asset('img/out-of-stock.png') }}" class="out__of animate-bounce animate-infinite animate-duration-1000 animate-delay-500 animate-ease-out" alt="">
                    </div>
                    <div class="flex justify-center text-gray-600 mt-2">
                        <span>ยังไม่ข้อมูลรายการซ่อม</span>
                    </div>
                    <div class="flex justify-center mt-2">
                        <button wire:loading.class.add="hidden" class="px-4 py-2 rounded text-sm bg-blue-500 text-white hover:bg-blue-600 duration-100 ease-in-out" wire:click.prevent="openPopup({{ 1 }})">เพิ่มรายการซ่อม</button>
                        <button wire:loading class="px-4 h-10 rounded text-sm bg-blue-400 text-white">
                            @component('components.content-Loading.spinner')@endcomponent
                        </button>
                    </div>
                @else
                    <div class="flex justify-between mt-3 items-center">
                        <div class="text-sm text-blue-600">
                            <i class="fa-regular fa-user"></i>
                            <span>ข้อมูลรายการซ่อม (Repair Details)</span>
                        </div>
                        <div>
                            <button class="btn-edit" wire:click="openPopup({{ 1 }})"><i class="fa-solid fa-pen-to-square text-sm"></i></button>
                        </div>
                    </div>
                    @foreach ($wipData as $item)
                        <x-detail>
                            <div class="flex justify-between text-blue-600">
                                <div class="flex items-center w-full justify-center">
                                    <div>
                                        <i class="fa-solid fa-screwdriver-wrench mr-2"></i>
                                    </div>
                                    <div>
                                        <span>ประเภทงาน</span>
                                        <span class="block">{{ $item->type_doit }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <div>
                                        <i class="fa-solid fa-user mr-2"></i>
                                    </div>
                                    <div>
                                        <span>ช่างผู้รับผิดชอบ</span>
                                        <span class="block">{{ $item->respon_name }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <div>
                                        <i class="fa-solid fa-screwdriver-wrench mr-2"></i>
                                    </div>
                                    <div>
                                        <span>วันที่เริ่ม</span>
                                        <span class="block">{{ $item->date_start }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <div>
                                        <i class="fa-solid fa-right-to-bracket mr-2"></i>
                                    </div>
                                    <div>
                                        <span>วันที่สิ้นสุด</span>
                                        <span class="block">{{ $item->date_stop }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <div>
                                        <i class="fa-solid fa-calculator mr-2"></i>
                                    </div>
                                    <div>
                                        <span>คำนวณค่าแรง</span>
                                        <span class="block">{{ $item->cal_doit }}</span>
                                    </div>
                                </div>
                            </div>
                        </x-detail>
                    @endforeach
                @endif
            </div>
          </div>
    </div>
</div>
@include('manageBP.components.content-popup.customer-popup')
@include('manageBP.components.content-popup.form-popup')