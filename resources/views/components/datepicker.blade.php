@props(['wirename', 'placeholderValue', 'inputname'])

<input datepicker datepicker-autohide type="text" class="block w-full py-1 px-2 rounded" placeholder="{{ $placeholderValue }}" wire:model="{{ $wirename }}" name="{{ $inputname }}" readonly>
