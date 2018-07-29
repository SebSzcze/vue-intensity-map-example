<tr :class="{ 'bg-grey-lightest': index % 2 !== 0 }">
    <td class="p-4 w-12">
        <a :href="'/{{ $controller::ROUTE_KEY }}/' + item.id + '/edit'" class="text-sm font-medium text-grey" v-text="item.id"></a>
    </td>

    <td class="p-4 max-w-xs">
        <a :href="'/{{ $controller::ROUTE_KEY }}/' + item.id + '/edit'" class="text-grey-dark font-medium block" v-text="item.title"></a>
        <span class="text-grey" v-text="item.body"></span>
        <a :href="item.url" class="text-grey block mt-4" v-text="item.url"></a>
    </td>
    <td class="p-4">
        <span class="text-grey" v-text="item.email"></span>
    </td>
    <td class="p-4">
        <span class="text-grey font-medium" v-text="item.organizer"></span>

        <span class="text-grey block mt-4" v-text="item.name"></span>
        <span class="text-grey block " v-text="item.phone"></span>
    </td>

    <td class="p-4">
        <span class=" font-medium text-grey-darker" v-text="item.date"></span>
    </td>

    <td class="p-4">
        <span class="text-xs text-grey block">Dodano</span>
        <span class="text-xs text-grey-dark block mb-2" v-text="item.created_at"></span>

        <span class="text-xs text-grey block">Ostatnia zmiana</span>
        <span class="text-xs text-grey-dark block" v-text="item.updated_at"></span>

        <span class="text-xs text-grey block mt-4" v-if="item.sent_at" >Mail wysłano</span>
        <span class="text-xs text-grey-dark block" v-if="item.sent_at" v-text="item.sent_at"></span>
    </td>

    <td class="w-32 pr-4">
        @component('lari::components.actions', ['route' => $controller::ROUTE_KEY,  'edit' => false  ])
            @slot('before')
                <a :href="'/{{ $controller::ROUTE_KEY }}/' + item.id + '/edit'" v-tooltip="'Konwertuj zgłoszenie na wydarzenie'" class="bg-grey-light px-2 py-1 text-grey-dark">
                    <icon name="edit"></icon>
                </a>
            @endslot
        @endcomponent
    </td>

</tr>
