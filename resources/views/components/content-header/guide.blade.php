<div class="w-5/6 my-5 mx-auto" data-aos="fade-down" data-aos-duration="1000">
    <div class="flex justify-between">
        <div class="font-medium text-red-600">
            <span>{{ @$data['title'] }}</span>
        </div>
        <div>
            <ul class="flex text-blue-600">
                <li class="font-medium">{{ @$data['guide']['active']}}</li>
                @foreach (@$data['list'] as $key => $item)
                    <li>/{{ @$item->head }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>