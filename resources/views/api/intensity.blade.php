<?xml version="1.0" encoding="UTF-8"?>
<locations>
    @foreach($locations as $location)
        <location>
            @foreach($location as $key => $value)
                @if(!is_array($value))
                    <{{ $key }}>{{ $value }}</{{ $key }}>
                @else
                    <{{ $key }}>
                        @if($key == 'data')
                            {{-- Data --}}
                            @foreach($value as $_k => $_v)
                                <{{ $_k }}>
                                    @if(!is_array($_v))
                                            {{ $_v }}
                                        </{{ $_k }}>
                                        @continue
                                    @endif
                                    @foreach($_v as $__k => $__v)
                                        <{{ $__k }}>{{ $__v }}</{{ $__k }}>
                                    @endforeach
                                </{{ $_k }}>
                            @endforeach
                            {{-- //Data --}}

                        @else
                            {{-- Nested --}}
                            @foreach($value as $items)
                                <{{ str_singular($key) }}>
                                @foreach($items as $_k => $_v)
                                    <{{ $_k }}>{{ $_v }}</{{ $_k }}>
                                @endforeach
                                </{{ str_singular($key) }}>
                            @endforeach
                            {{-- //Nested --}}
                        @endif

                    </{{ $key }}>
                @endif
            @endforeach
        </location>
    @endforeach
</locations>
