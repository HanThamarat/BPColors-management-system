@foreach (@$data['btn-data-arr'] as $item)
    <button class="transition ease-in-out delay-150 text-{{ @$item['icon-color'] != '' ? @$item['icon-color'] : '' }}-500 hover:-translate-y-1 hover:scale-100 duration-300 bg-gray-100 py-5 px-5 w-2 h-2 flex justify-center items-center rounded-full hover:drop-shadow-md hover:text-{{ @$item['icon-hover-color'] != '' ? @$item['icon-hover-color'] : '' }}-500 duration" wire:click="{{ @$item['active-func'] }}({{ @$data['claim_id'] }})">
        <i class="{{ @$item['icon'] }}"></i>
    </button>
@endforeach