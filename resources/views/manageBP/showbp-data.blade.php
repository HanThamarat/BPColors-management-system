<x-app-layout>
    <style>
        body {
        --sb-track-color: #F5F5F5;
        --sb-thumb-color: #3B82F6;
        --sb-size: 5px;
        }

        .select__ml {
            height: 250px;
            overflow-y: scroll;
            padding: 20px;
        }

        .select__ml::-webkit-scrollbar {
            width: var(--sb-size);
        }

        .select__ml::-webkit-scrollbar-track {
            background: var(--sb-track-color);
            border-radius: 4px;
        }

        .select__ml::-webkit-scrollbar-thumb {
            background: var(--sb-thumb-color);
            border-radius: 4px;
        }

        @supports not selector(::-webkit-scrollbar) {
            .select__ml {
                scrollbar-color: var(--sb-thumb-color)
                                var(--sb-track-color);
            }
        }

        table {
            height: 200;
            overflow-y: scroll;
        }
    </style>
    {{-- @livewire('show-bp') --}}
    <x-fullcard>
        <livewire:show-bp lazy />
    </x-fullcard>
    <script>
        document.title = "BP | Customer Detail";
        const dropEl = document.querySelector('.dropEls');

        function handleDropdnow() {
            dropEl.classList.remove('hidden');
            // console.log(dropEl);
        }
    </script>
</x-app-layout>