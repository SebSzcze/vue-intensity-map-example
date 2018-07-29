<tr :class="{ 'bg-grey-lightest': index % 2 !== 0 }">
    <td class="p-4 w-16">
        <a :href="'/{{ $controller::ROUTE_KEY }}/' + item.id + '/edit'" class="text-sm font-medium text-grey" v-text="item.id"></a>
    </td>

    <td class="p-4"><span v-text="item.lat"></span></td>
    <td class="p-4"><span v-text="item.lng"></span></td>
    <td class="p-4"><span v-text="item.address"></span></td>

    <td class="w-32 pr-4">
        @component('lari::components.actions', ['route' => $controller::ROUTE_KEY ])

        @endcomponent
    </td>
</tr>
