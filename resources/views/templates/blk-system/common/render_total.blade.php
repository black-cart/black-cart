@if (!empty($dataTotal) && count($dataTotal))
    @foreach ($dataTotal as $key => $element)
        @if ($element['code']=='total')
            <hr class="line-info mb-3">
            <div class="media align-items-center">
              <h3 class="h6 text-secondary mr-3">{!! $element['title'] !!}</h3>
              <div class="media-body text-right" id="{{ $element['code'] }}">
                <span>{{$element['text'] }}</span>
              </div>
            </div>
        @elseif($element['value'] !=0)
            <div class="media align-items-center">
              <h3 class="h6 text-secondary mr-3">{!! $element['title'] !!}</h3>
              <div class="media-body text-right" id="{{ $element['code'] }}">
                <span>{{$element['text'] }}</span>
              </div>
            </div>
        @endif
    @endforeach
@endif