{{-- Module top --}}

@isset ($bc_blocksContent['top'])
  @foreach ( $bc_blocksContent['top'] as $layout)
    @php
      $arrPage = explode(',', $layout->page)
    @endphp
    @if ($layout->page == '*' || (isset($layout_page) && in_array($layout_page, $arrPage)))
      @if ($layout->type =='html')
        {!! $layout->text !!}
      @elseif($layout->type =='view')
        @if (view()->exists($bc_templatePath.'.block.'.$layout->text))
          @include($bc_templatePath.'.block.'.$layout->text)
        @endif
      @endif
    @endif
  @endforeach
@endisset

{{-- //Module top --}}