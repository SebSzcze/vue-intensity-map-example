<tr :class="{ 'bg-grey-lightest': index % 2 !== 0 }">
    <td class="p-4 w-16">
        <a :href="'/{{ $controller::ROUTE_KEY }}/' + item.id + '/edit'" class="text-sm font-medium text-grey" v-text="item.id"></a>
    </td>

    <td class="p-4 max-w-xs">
        <a :href="'/{{ $controller::ROUTE_KEY }}/' + item.id + '/edit'" class="text-base text-grey-dark font-medium block" v-text="item.name"></a>
    </td>
    <td class="p-4">
        <span class="text-grey" v-text="item.entities_count"></span>
    </td>

    <td class="p-4">
        <span class="text-xs text-grey" v-text="item.updated_at"></span>
    </td>

    <td class="p-4">
        <span class="text-xs text-grey" v-text="item.created_at"></span>
    </td>

    <td class="w-32 pr-4">
        @component('lari::components.actions', ['route' => $controller::ROUTE_KEY ])

        @endcomponent
    </td>

</tr>
