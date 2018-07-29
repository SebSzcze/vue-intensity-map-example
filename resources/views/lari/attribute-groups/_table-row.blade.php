<tr :class="{ 'bg-grey-lightest': index % 2 !== 0 }">
    <td class="p-4 w-16">
        <a :href="'/{{ $controller::ROUTE_KEY }}/' + item.id + '/edit'" class="text-sm font-medium text-grey" v-text="item.id"></a>
    </td>

    <td class="p-4">
        <span class="text-xs text-grey max-w-xs" v-text="item.key"></span>
    </td>
    <td class="p-4 flex-1">
        <span class="text-grey-dark" v-text="item.name"></span>
        <div class="text-grey-light" v-text="item.info"></div>
    </td>

    <td class="w-32 pr-4">
        @component('lari::components.actions', ['route' => $controller::ROUTE_KEY ])

        @endcomponent
    </td>
</tr>
