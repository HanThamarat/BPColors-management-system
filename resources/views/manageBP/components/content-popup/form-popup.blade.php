@php
    $u_role = auth()->user()->role;
@endphp
@if ($formType !== 1) 
    <div id="popup-modal" tabindex="-1" class="popup__style {{ $popupForm ? '' : 'hidden' }} overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 flex">
        <div class="relative p-4 w-5/6">
            <div class="relative bg-white rounded-lg shad py-8 px-4">
                @if ($u_role == 'admin')
                    <form>
                        <div class="text-blue-600 border-b pb-4 flex justify-between items-center">
                            <div>
                                <i class="fa-solid fa-circle-info"></i>
                                <span> รายละเอียดอื่นๆ</span>
                            </div>
                            <div>
                                <button class="w-5 h-5 justify-center flex items-center rounded-full hover:bg-blue-500 hover:text-white duration-100 ease-in-out" wire:click.prevent="closePopup">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                        <div class="w-full my-4 flex">
                            <div class="w-3/6 mr-5">
                                <div class="flex w-full">
                                    <div class="w-full mr-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่เข้าเคลม</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_cliam">
                                            @error('date_cliam') <span class="error text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่รับรถ</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded"  wire:model="date_carin">
                                            @error('date_carin') <span class="error text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่ส่งมอบระบบ</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" readonly>
                                        </div>
                                    </div>
                                    <div class="w-full ml-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่นัดหมายรับบริการ</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded"  wire:model="date_service">
                                            @error('date_service') <span class="error text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่ซ่อม</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_repair">
                                            @error('date_repair') <span class="error text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันนัดส่งมอบจริง</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_send_next">
                                            @error('date_send_next') <span class="error text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="flex w-full mt-5">
                                    <div class="w-full mr-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">ประเมินค่าแรง</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="cost_doit">
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">ประเมินรวม</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="cost_totel">
                                        </div>
                                    </div>
                                    <div class="w-full ml-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">ประเมินค่าอะไหล่</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="cost_sparepart">
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">ประกันอนุมัติ</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_firmins">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex w-full mt-5">
                                    <div class="w-full mr-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">อนุมัติค่าแรง</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="firm_doit">
                                            @error('firm_doit') <span class="error text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">อนุมัติรวม</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="firm_all">
                                        </div>
                                    </div>
                                    <div class="w-full ml-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">อนุมัติค่าอะไหล่</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="firm_sparepart">
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่ส่งรถ</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_send_car">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-3/6 ml-5">
                                <div class="flex w-full">
                                    <div class="w-full mr-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันส่งมอบ/วันเปิดแจ้งหนี้ DMS</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_dms">
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่ได้อนุมัติ E-Claim</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_fecliam">
                                        </div>
                                    </div>
                                    <div class="w-full ml-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่ขออนุมัติใน E-Claim</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_ecliam">
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">ค่า exzept</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="exzept">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex w-full mt-5">
                                    <div class="w-full mr-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">เลขที่ใบกำกับภาษี (SA)</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="invoice_no">
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันวางบิลตัวจริง</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_bill">
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">จำนวนเงินรับจริง</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="total_pay">
                                        </div>
                                    </div>
                                    <div class="w-full ml-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">เลขที่วางบิล (Cashier)</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="bill_no">
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันกำหนดจ่ายเงิน</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_paybill">
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่ได้รับเงิน</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_transfer">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex w-full mt-5">
                                    <div class="w-full">
                                        <label for="">หมายเหตุ</label>
                                        <textarea name="" id="" rows="4" class="w-full rounded" wire:model="note_service"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 flex justify-end">
                            <button wire:loading.class.add="hidden" class="py-2 px-5 rounded bg-blue-500 text-white hover:bg-blue-600 duration-100 ease-in-out mr-2" wire:click.prevent="insertDetail">Save Data</button>
                            <button wire:loading class="py-2 px-5 rounded bg-blue-400 text-white mr-2">@component('components.content-Loading.spinner') @endcomponent</button>
                        </div>         
                    </form>
                @else
                    <form>
                        <div class="text-blue-600 border-b pb-4 flex justify-between items-center">
                            <div>
                                <i class="fa-solid fa-circle-info"></i>
                                <span> รายละเอียดอื่นๆ</span>
                            </div>
                            <div>
                                <button class="w-5 h-5 justify-center flex items-center rounded-full hover:bg-blue-500 hover:text-white duration-100 ease-in-out" wire:click.prevent="closePopup">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                        <div class="w-full my-4 flex">
                            <div class="w-3/6 mr-5">
                                <div class="flex w-full">
                                    <div class="w-full mr-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่เข้าเคลม</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_cliam" {{ $date_cliam != '0000-00-00' ? 'disabled' : '' }}>
                                            {{-- <input type="text" datepicker datepicker-autohide class="block w-full py-1 px-2 rounded" wire:model="date_cliam" placeholder="วว/ดด/ป" readonly> --}}
                                            @error('date_cliam') <span class="error text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่รับรถ</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" id="date_carin" wire:model="date_carin" {{ $date_carin != '' ? 'disabled' : '' }}>
                                            @error('date_carin') <span class="error text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่ส่งมอบระบบ</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" readonly>
                                        </div>
                                    </div>
                                    <div class="w-full ml-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่นัดหมายรับบริการ</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded"  wire:model="date_service" {{ $date_service != '' ? 'disabled' : '' }}>
                                            @error('date_service') <span class="error text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่ซ่อม</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_repair" {{ $date_repair != '' ? 'disabled' : '' }}>
                                            @error('date_repair') <span class="error text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันนัดส่งมอบจริง</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_send_next" {{ $date_send_next != '' ? 'disabled' : '' }}>
                                            @error('date_send_next') <span class="error text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="flex w-full mt-5">
                                    <div class="w-full mr-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">ประเมินค่าแรง</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="cost_doit" {{ $cost_doit != '0.00' ? 'disabled' : '' }}>
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">ประเมินรวม</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="cost_totel" {{ $cost_totel != '0.00' ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                    <div class="w-full ml-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">ประเมินค่าอะไหล่</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="cost_sparepart" {{ $cost_sparepart != '0.00' ? 'disabled' : '' }}>
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">ประกันอนุมัติ</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_firmins" {{ $date_firmins != '' ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex w-full mt-5">
                                    <div class="w-full mr-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">อนุมัติค่าแรง</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="firm_doit" {{ $firm_doit != '0.00' ? 'disabled' : '' }}>
                                            @error('firm_doit') <span class="error text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">อนุมัติรวม</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="firm_all" {{ $firm_all != '0.00' ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                    <div class="w-full ml-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">อนุมัติค่าอะไหล่</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="firm_sparepart" {{ $firm_sparepart != '0.00' ? 'disabled' : '' }}>
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่ส่งรถ</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_send_car"  {{ $date_send_car != '' ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-3/6 ml-5">
                                <div class="flex w-full">
                                    <div class="w-full mr-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันส่งมอบ/วันเปิดแจ้งหนี้ DMS</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_dms" {{ $date_dms != '' ? 'disabled' : '' }}>
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่ได้อนุมัติ E-Claim</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_fecliam" {{ $date_fecliam != '' ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                    <div class="w-full ml-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่ขออนุมัติใน E-Claim</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_ecliam" {{ $date_ecliam != '' ? 'disabled' : '' }}>
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">ค่า exzept</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="exzept" {{ $exzept != '0.00' ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex w-full mt-5">
                                    <div class="w-full mr-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">เลขที่ใบกำกับภาษี (SA)</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="invoice_no" {{ $invoice_no != '' ? 'disabled' : '' }}>
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันวางบิลตัวจริง</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_bill" {{ $date_bill != '' ? 'disabled' : '' }}>
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">จำนวนเงินรับจริง</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="total_pay" {{ $total_pay != '0.00' ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                    <div class="w-full ml-1">
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">เลขที่วางบิล (Cashier)</label>
                                            <input type="text" class="block w-full py-1 px-2 rounded" wire:model="bill_no" {{ $bill_no != '' ? 'disabled' : '' }}>
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันกำหนดจ่ายเงิน</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_paybill" {{ $date_paybill != '' ? 'disabled' : '' }}>
                                        </div>
                                        <div class="text-sm w-full my-2 mr-2">
                                            <label for="">วันที่ได้รับเงิน</label>
                                            <input type="date" class="block w-full py-1 px-2 rounded" wire:model="date_transfer" {{ $date_transfer != '' ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex w-full mt-5">
                                    <div class="w-full">
                                        <label for="">หมายเหตุ</label>
                                        <textarea name="" id="" rows="4" class="w-full rounded" wire:model="note_service" {{ $note_service != '' ? 'disabled' : '' }}></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 flex justify-end">
                            <button wire:loading.class.add="hidden" class="py-2 px-5 rounded bg-blue-500 text-white hover:bg-blue-600 duration-100 ease-in-out mr-2" wire:click.prevent="insertDetail">Save Data</button>
                            <button wire:loading class="py-2 px-5 rounded bg-blue-400 text-white mr-2">@component('components.content-Loading.spinner') @endcomponent</button>
                        </div>         
                    </form>
                @endif
            </div>
        </div>
    </div>
@else
<div id="popup-modal" tabindex="-1" class="popup__style {{ $popupForm ? '' : 'hidden' }} overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 flex">
    <div class="relative p-4 w-5/6">
        <div class="relative bg-white rounded-lg shadow py-8 px-4">
            <form>
                <div class="text-blue-600 border-b pb-4 flex justify-between items-center">
                    <div>
                        <i class="fa-solid fa-circle-info"></i>
                        <span> รายละเอียดอื่นๆ</span>
                    </div>
                    <div>
                        <button class="w-5 h-5 justify-center flex items-center rounded-full hover:bg-blue-500 hover:text-white duration-100 ease-in-out" wire:click.prevent="closePopup">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
                @if (count($wipData) !== 0)
                    @foreach ($type_doit as $index => $input)
                                <div class="w-full flex items-center my-4">
                                    <div class="w-full mr-2">
                                        <label>ประเภทงาน</label>
                                        @if (count($wipData) >= $index+1)
                                            <select name="type_doit[]" id="type_doit" wire:model="type_doit.{{ $index }}.type_doit" class="w-full py-1 px-2 rounded mr-2">
                                        @else
                                            <select name="type_doit[]" id="type_doit" wire:model="type_doit.{{ $index }}" class="w-full py-1 px-2 rounded mr-2">
                                        @endif
                                            <option value="">--ประเภทงาน--</option>
                                            @foreach ($getJob as $res_job)
                                                <option value="{{ $res_job->job_name }}">{{ $res_job->job_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-full mx-2">
                                        <label>ช่างผู้รับผิดชอบ</label>
                                        @if (count($wipData) >= $index+1)
                                            <select name="respon_name[]" id="type_doit" wire:model="respon_name.{{ $index }}.respon_name" class="w-full py-1 px-2 rounded">
                                        @else
                                            <select name="respon_name[]" id="type_doit" wire:model="respon_name.{{ $index }}" class="w-full py-1 px-2 rounded">
                                        @endif
                                            <option value="">--ช่าง--</option>
                                            @foreach ($technician as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-full mx-2">
                                        <label>วันเริ่มงาน</label>
                                        @if (count($wipData) >= $index+1)
                                            <input type="date" class="w-full py-1 px-2 rounded" wire:model="date_start.{{ $index }}.date_start">
                                        @else
                                            <input type="date" class="w-full py-1 px-2 rounded" wire:model="date_start.{{ $index }}">
                                        @endif
                                    </div>
                                    <div class="w-full mx-2">
                                        <label>วันจบงาน</label>
                                        @if (count($wipData) >= $index+1)
                                            <input type="date" class="w-full py-1 px-2 rounded" wire:model="date_stop.{{ $index }}.date_stop">
                                        @else
                                            <input type="date" class="w-full py-1 px-2 rounded" wire:model="date_stop.{{ $index }}">
                                        @endif
                                    </div>
                                    <div class="w-full ml-2">
                                        <label>คำนวณค่าแรง</label>
                                        <input type="text" wire:model="cal_doit.{{ $index }}.cal_doit" class="w-full py-1 px-2 rounded" value="test" placeholder="คำนวณ AUTO" readonly>
                                    </div>
                                    <button wire:click.prevent="removeInput({{ $index }})"><i class="fa-solid fa-trash text-red-600"></i></button>
                                </div>
                        @endforeach
                @else
                    @foreach($type_doit as $index => $input)
                        <div class="w-full flex items-center my-4">
                            <div class="w-full mr-2">
                                <label>ประเภทงาน</label>
                                <select name="type_doit[]" id="type_doit" wire:model="type_doit.{{ $index }}" class="w-full py-1 px-2 rounded mr-2">
                                    <option value="">--ประเภทงาน--</option>
                                    @foreach ($getJob as $res_job)
                                        <option value="{{ $res_job->job_name }}">{{ $res_job->job_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full mx-2">
                                <label>ช่างผู้รับผิดชอบ</label>
                                <select name="respon_name[]" id="type_doit" wire:model="respon_name.{{ $index }}" class="w-full py-1 px-2 rounded">
                                    <option value="">--ช่าง--</option>
                                    @foreach ($technician as $item)
                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full mx-2">
                                <label>วันเริ่มงาน</label>
                                <input type="date" class="w-full py-1 px-2 rounded" wire:model="date_start.{{ $index }}">
                            </div>
                            <div class="w-full mx-2">
                                <label>วันจบงาน</label>
                                <input type="date" class="w-full py-1 px-2 rounded" wire:model="date_stop.{{ $index }}">
                            </div>
                            <div class="w-full ml-2">
                                <div>
                                    <label>คำนวณค่าแรง</label>
                                    <div class="flex items-end">
                                        <input type="text" wire:model="cal_doit.{{ $index }}" class="w-full py-1 px-2 rounded" value="test" placeholder="คำนวณ AUTO" readonly>
                                        <button wire:click.prevent="removeInput({{ $index }})"><i class="fa-solid fa-trash text-red-600"></i></button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="mt-5 flex justify-between">
                    <div>
                        <button class="py-2 px-5 rounded bg-blue-500 text-white hover:bg-blue-600 duration-100 ease-in-out mr-2" wire:click.prevent='addInput'><i class="fa-solid fa-plus pr-2"></i><span>ADD</span></button>
                    </div>
                    <div>
                        <button class="py-2 px-5 rounded bg-blue-500 text-white hover:bg-blue-600 duration-100 ease-in-out mr-2" wire:click.prevent="formRepair">Save Data</button>
                    </div>
                </div>         
            </form>
        </div>
    </div>
</div>
@endif