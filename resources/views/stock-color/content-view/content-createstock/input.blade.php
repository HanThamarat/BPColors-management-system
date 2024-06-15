<style>
.grapic {
	background: linear-gradient(-45deg, #ee7752, #23a6d5, #23d5ab);
	background-size: 400% 400%;
	animation: gradient 15s ease infinite;
}

@keyframes gradient {
	0% {
		background-position: 0% 50%;
	}
	50% {
		background-position: 100% 50%;
	}
	100% {
		background-position: 0% 50%;
	}
}
</style>
<form id="stockData" class="w-full">
    <div class="w-full flex justify-between">
        <div class="grapic w-1/5 rounded">
            <div class="flex justify-center py-2 px-10 bg-blue-400 text-white rounded">
                <span>สร้างสต็อกสี</span>
            </div>
            <div class="h-[50px]"></div>
            <div class="items-end">
                <img src="{{ asset('img/color_service.png') }}" class="" alt="">
            </div>
        </div>
        <div class="w-4/5 px-4 py-8" data-aos="fade-up" data-aos-duration="1000">
            <input type="text" name="unitType" class="w-full py-1 px-2 rounded hidden" value="unit">
            <div class="w-full flex justify-between gap-x-3 mb-3">
                <div class="w-full text-[14px]">
                    <label class="text-red-500">รหัสสินค้า*</label>
                    <input type="text" name="ProductId" class="w-full py-1 px-2 rounded">
                </div>
                <div class="w-full text-[14px]">
                    <label class="text-red-500">ราคาสินค้า*</label>
                    <input id="ProductPrice" type="text" name="ProductPrice" class="w-full py-1 px-2 rounded">
                </div>
                <div class="w-full text-[14px]">
                    <label class="text-red-500">หน่วยของสินค้า*</label>
                    <input id="UnitStart" type="text" name="UnitStart" class="w-full py-1 px-2 rounded">
                </div>
                <div class="w-full text-[14px]">
                    <label class="text-red-500">ราคาต่อหน่อย*</label>
                    <input id="UnitPrice" type="text" name="UnitPrice" class="w-full py-1 px-2 rounded bg-gray-100" readonly>
                </div>
            </div>
            <div class="w-full flex justify-between gap-x-3 my-3">
                <div class="w-full text-[14px]">
                    <label class="text-red-500">ราคาละเอียดสินค้า*</label>
                    <textarea name="ProductDetail" id="" rows="2" class="w-full py-1 px-2 rounded"></textarea>
                </div>
            </div>
            <div class="w-full flex text-[14px] justify-end mt-3">
                <button id="create" type="submit" class="py-2 px-5 bg-blue-500 text-white hover:bg-blue-400 duration-150 rounded flex gap-x-2">
                    <svg aria-hidden="true" id="spint" class="hidden w-5 h-5 text-gray-100 animate-spin fill-blue-700" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span>สร้างสต็อกสี</span>
                </button>
            </div>
        </div>
    </div>
</form>
@include('stock-color.content-view.content-createstock.script')