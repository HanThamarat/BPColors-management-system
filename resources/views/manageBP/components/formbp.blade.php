<div class="my-10 flex justify-center items-center animate-fade-down animate-one animate-duration-1000 animate-delay-1000 animate-ease-in-out">
    <div class="lg:w-5/6 rounded-md bg-white drop-shadow block lg:flex">
        <div class="lg:w-1/6 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-md justify-center flex items-end">
            <span>

            </span>
            <img src="{{ asset('img/customer.png') }}" class="object-cover animate-fade-up animate-once h-48 " alt="">
        </div>
        <div class="lg:w-5/6 py-4 px-4">
            <form>
            <div class="font-medium">
                <span>CREATE NEW CUSTOMER</span>
            </div>
            <div class="w-full my-4 lg:flex">
                <div class="w-full lg:mr-2">
                    <label>ชื่อลูกค้า</label>
                    <input type="text" placeholder="กรุณากรอกชื่อลูกค้า" class="w-full rounded" wire:model="cus_name" required>
                    @error('cus_name') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="w-full lg:mx-2">
                    <label>เบอร์โทรลูกค้า</label>
                    <input type="text" placeholder="กรุณากรอกชื่อลูกค้า" class="w-full rounded" wire:model="cus_phoneNumber" required>
                    @error('cus_phoneNumber') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="w-full lg:mx-2">
                    <label>สถานะ</label>
                    <select name="claim_status" id="" class="w-full rounded" wire:model="claim_status">
                        <option value="">-สถานะ-</option>
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
                    @error('claim_status') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
                    <div class="w-full lg:ml-2 flex items-center justify-around border rounded">
                        <div>
                            <input class="rounded mr-1" type="checkbox" value="1" id="flexCheckDefault" wire:model="except"/>
                            <label for="flexCheckDefault">Except</label>
                        </div>
                        <div>
                            <input class="rounded mr-1" type="checkbox" value="1" id="flexCheckDefault" wire:model="color"/>
                            <label for="flexCheckDefault">ทำสีรอบคัน</label>
                        </div>
                    </div>
            </div>
            <div class="w-full my-4 lg:flex">
                <div class="w-full lg:mr-2">
                    <label>เลขที่เคลม</label>
                    <input type="text" placeholder="เลขที่เคลม" class="w-full rounded" wire:model="clm_number">
                    @error('clm_number') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="w-full lg:mx-2">
                    <label>ทะเบียนรถ</label>
                    <input type="text" placeholder="ทะเบียนรถ" class="w-full rounded" wire:model="regiscar_number">
                    @error('car_number') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="w-full lg:mx-2">
                    <label>ยีห้อ</label>
					<select name="car_brand" id="car_brand" class="block w-full rounded" wire:model="car_brand">
						<option value="">---กรุณาเลือกยี่ห้อ---</option>
                        
                        @foreach ($GetBrand as $items)
                            <option value="{{ $items->brand_name }}">{{ $items->brand_name }}</option>
                        @endforeach
					</select>
                    @error('car_brand') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="w-full lg:ml-2">
                    <label>รุ่นรถ</label>
                    <input type="text" placeholder="รุ่นรถ" class="w-full rounded" wire:model="car_model">
                    @error('car_brand') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="w-full my-4 lg:flex">
                <div class="w-full lg:mr-2">
                    <label>เลขตัวถัง</label>
                    <input type="text" placeholder="เลขตัวถัง" class="w-full rounded" wire:model="car_body_number">
                </div>
                <div class="w-full lg:mx-2">
                    <label>ผู้รับเคส</label>
                    <select name="clm_recipient" id="" class="w-full rounded" wire:model="clm_recipient">
                        <option value="">---เลือกผู้รับเคส---</option>
                        <option value="สิทธิศักดิ์ กังสกุล">สิทธิศักดิ์ กังสกุล</option>
                        <option value="ศุภวัฒน์ หลานเด็น" >ศุภวัฒน์ หลานเด็น</option>
                        <option value="สิริกาญจน์ หีมเอียด" >สิริกาญจน์ หีมเอียด</option>
                    </select>
                </div>
                <div class="w-full lg:mx-2">
                    <label>เลขที่กรมธรรม์</label>
                    <input type="text" placeholder="เลขที่กรมธรรม์" class="w-full rounded" wire:model="policy_number">
                </div>
                <div class="w-full lg:ml-2">
                    <label>แหล่งที่มาลูกค้า</label>
                    <select name="cus_resource" class="w-full rounded" wire:model="cus_resource">
                        <option value="">--แหล่งที่มาลูกค้า--</option>
                        <option value="ลูกค้า Walk in ด้วยตัวเอง">ลูกค้า Walk in ด้วยตัวเอง</option>
                        <option value="ลูกค้า Walk in จากการแนะนำจากคนรู้จัก">ลูกค้า Walk in จากการแนะนำจากคนรู้จัก</option>
                        <option value="ลูกค้า Walk in จากสื่อโฆษณาการประชาสัมพันธ์">ลูกค้า Walk in จากสื่อโฆษณาการประชาสัมพันธ์</option>
                        <option value="จากการส่งต่อมาจากฝ่ายศูนย์บริการ">จากการส่งต่อมาจากฝ่ายศูนย์บริการ</option>
                        <option value="จากการแนะนำจากบริษัทประกัน หรือ เซอร์เวย์">จากการแนะนำจากบริษัทประกัน หรือ เซอร์เวย์</option>
                        <option value="ลูกค้า Daily claim">ลูกค้า Daily claim</option>
                        <option value="ลูกค้า Survey">ลูกค้า Survey</option>
                        <option value="ลูกค้าประกันปี 2">ลูกค้าประกันปี 2</option>			
                    </select>
                </div>
            </div>
            <div class="w-full my-4 lg:flex">
                <div class="w-full lg:mr-2">
                    <label>เลขที่ Job (BP) (RO) (SA)</label>
                    <div id="getBrand"></div>
                    <input type="text" placeholder="เลขที่ Job (BP) (RO) (SA)" class="w-full rounded" wire:model="job_number">
                </div>
                <div class="w-full lg:mx-2">
                    <label>แหล่งต่อประกัน</label>
                    <select id="insure_source" class="w-full rounded" wire:model="insurence">
                        <option value="">---กรุณาเลือก---</option>
                        <option value="บริษัท ชูเกียรติ">บริษัท ชูเกียรติ</option>
                        <option value="โบร๊คเกอร์อื่น">โบร๊คเกอร์อื่น</option>	
                    </select>
                </div>
                <div class="w-full lg:mx-2">
                    <label>ประเภทประกันภัย</label>
                    <select id="insure_type" class="w-full block rounded" wire:model="insurence_type">
                        <option value="">---ประเภทประกันภัย---</option>	
                        <option value="เบี้ยประกันห้าง">เบี้ยประกันห้าง</option>
                        <option value="เบี้ยประกันอู่">เบี้ยประกันอู่</option>
                        <option value="ซ่อมเงินสด">ซ่อมเงินสด</option>
                        <option value="เงินส่วนต่างค่าแรง-ค่าอะไหล่">เงินส่วนต่างค่าแรง-ค่าอะไหล่</option>
                        <option value="เงินค่า Excess">เงินค่า Excess</option>																
                        <option value="เคลมภายใน">เคลมภายใน</option>			
                    </select>
                </div>
                <div class="w-full lg:ml-2">
                    <label>ประกัน</label>
					<select id="insure_name" class="w-full rounded" wire:model="insurence_name">
						<option value="">---กรุณาเลือกประกัน---</option>
						@foreach ($GetInsurances as $items)
                            <option value="{{ $items->insure_name }}">{{ $items->insure_name }}</option>
                        @endforeach
					</select>
                </div>
            </div>
            <div class="w-full my-4 lg:flex">
                <div class="w-full lg:mr-2">
                    <label>ประเภท EMCS</label>
					<select id="emcs" class="w-full rounded" wire:model="insurence_EMCS">
                        <option value="">---กรุณาเลือก--</option>
                        <option value="EMCS">EMCS</option>
                        <option value="NO-EMCS">NO - EMCS</option>
                    </select>
                </div>
                <div class="w-full lg:mx-2">
                    <label>ประเภทงาน</label>
					<select id="car_job" class="w-full rounded" wire:model="work_type">
                        <option value="">---กรุณาเลือกประเภทงาน---</option>
                        <option value="L-เบา">L-เบา</option>
                        <option value="M-กลาง">M-กลาง</option>
                        <option value="H1">H1</option>
                        <option value="H2">H2</option>
                        <option value="H3">H3</option>
                        <option value="PDS">PDS</option>		
                    </select>
                </div>
                <div class="w-full lg:ml-2">
                    <label>สถานะการซ่อม</label>
                    <select id="job_status" class="w-full rounded"  wire:model="status_repair">
                        <option value="">---กรุณาเลือกกาซ่อม---</option>
                        <option value="01-ถอด">01-ถอด</option>
                        <option value="02-เคาะ">02-เคาะ</option>
                        <option value="03-เตรียมพื้น">03-เตรียมพื้น</option>
                        <option value="04-ติดกระดาษ">04-ติดกระดาษ</option>
                        <option value="05-ประกอบ">05-ประกอบ</option>
                        <option value="06-ขัดสี">06-ขัดสี</option>
                        <option value="07-QC">07-QC</option>
                        <option value="08-ติดตั้งตกเต่ง">08-ติดตั้งตกเต่ง</option>	
                    </select>
                </div>
            </div>
            <div class="w-full lg:my-4">
                <label>หมายเหตุ</label>
                <textarea  id="" rows="7" class="w-full rounded" wire:model="note"></textarea>
            </div>
            <div class="w-full my-4 flex justify-end">
               <button wire:loading.class.add="hidden" class="w-48 h-10 rounded bg-blue-500 text-white font-medium hover:bg-blue-600 duration-100 ease-in-out" type="submit" wire:click.prevent="createClaim">
                    Create Customer
                </button>
                <button wire:loading class="px-4 h-10 rounded text-sm bg-blue-400 text-white" disabled>
                        @component('components.content-loading.spinner') @endcomponent
                </button>
            </div>
        </form>
        </div>
    </div>
</div>