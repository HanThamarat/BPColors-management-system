@props(['err_name','message'])

@error('{{ $err_name }}') <span class="error text-red-500">{{ $message }}</span> @enderror