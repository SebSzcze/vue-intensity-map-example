<tr :class="{ 'bg-grey-lightest': index % 2 !== 0 }">
    <td class="p-4 w-16">
        <a :href="'/{{ $controller::ROUTE_KEY }}/' + item.id + '/edit'" class="text-sm font-medium text-grey" v-text="item.id"></a>
    </td>

    <td class="p-4">
        <span class="text-xs text-grey" v-text="item.key"></span>
    </td>

    <td class="p-4 max-w-xs">
        <a :href="'/{{ $controller::ROUTE_KEY }}/' + item.id + '/edit'" class="text-grey-dark font-medium block" v-text="item.name"></a>
        <span class="block text-grey text-xs font-medium" v-html="item.description"></span>
        <span class="block mt-2 text-grey">/#/natezenia,@{{ item.key }}</span>
    </td>

    <td class="w-32 pr-4">
        @component('lari::components.actions', ['route' => $controller::ROUTE_KEY ])
            @slot('before')
                <a :href="`{{ config('app.url') }}/#/natezenia,${item.key}`" target="_blank" class="bg-grey-light px-2 py-1 text-grey-dark">
                    <icon name="link"></icon>
                </a>
            @endslot
        @endcomponent
    </td>

</tr>
