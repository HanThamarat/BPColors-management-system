<style>
    body {
    --sb-track-color: #F5F5F5;
    --sb-thumb-color: #3B82F6;
    --sb-size: 5px;
    }

    .detail__repair {
        margin-top: 10px;
        height: 250px;
        overflow-y: scroll;
        padding: 20px;
    }

    .detail__repair::-webkit-scrollbar {
        width: var(--sb-size);
    }

    .detail__repair::-webkit-scrollbar-track {
        background: var(--sb-track-color);
        border-radius: 4px;
    }

    .detail__repair::-webkit-scrollbar-thumb {
        background: var(--sb-thumb-color);
        border-radius: 4px;
    }

    @supports not selector(::-webkit-scrollbar) {
        .detail__repair {
            scrollbar-color: var(--sb-thumb-color)
                             var(--sb-track-color);
        }
    }
</style>
<div class="mt-10 flex justify-center items-center">
    <div class="w-full justify-center lg:flex">
        @include('manageBP.components.content-customer.customer-information')
        @include('manageBP.components.content-customer.cus-showdata')
    </div>
</div>
