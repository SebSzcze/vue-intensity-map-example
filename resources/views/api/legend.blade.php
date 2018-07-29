<?xml version="1.0" encoding="UTF-8"?>
<legend>
    @foreach($legend as $item)
        <item>
            <id>{{ $item->get('id') }}</id>
            <name>{{ $item->get('name') }}</name>
            <labels>
                @foreach($item->get('labels') as $label)
                    <label>{{ $label }}</label>
                @endforeach
            </labels>
            <options>
                @if($item->get('options'))

            @foreach($item->get('options') as $option)
                    <option>{{ $option }}</option>
                @endforeach

                @endif
            </options>
        </item>
    @endforeach
</legend>
