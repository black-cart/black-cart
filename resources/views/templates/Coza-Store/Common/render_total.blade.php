@if (!empty($dataTotal) && count($dataTotal))
    @foreach ($dataTotal as $key => $element)
        @if ($element['code']=='total')
            <div class="flex-w flex-t p-b-15 showTotal">
                <div class="size-208">
                    <span class="mtext-101 cl2">
                        {!! $element['title'] !!}:
                    </span>
                </div>

                <div class="size-209 p-t-1">
                    <span class="mtext-110 cl2" id="{{ $element['code'] }}">
                        {{$element['text'] }}
                    </span>
                </div>
            </div>
        @elseif($element['value'] !=0)
            <div class="flex-w flex-t p-t-15 p-b-15 showTotal">
                <div class="size-208">
                    <span class="mtext-101 cl2">
                        {!! $element['title'] !!}:
                    </span>
                </div>

                <div class="size-209 p-t-1">
                    <span class="mtext-110 cl2" id="{{ $element['code'] }}">
                        {{$element['text'] }}
                    </span>
                </div>
            </div>
        @endif
        @if($element['code'] == 'discount' && $element['value'] < 0)
            @push('scripts')
                <script type="text/javascript">     
                    $('#removeCoupon').addClass('flex-c-m');
                </script>
            @endpush
        @endif
    @endforeach
@endif