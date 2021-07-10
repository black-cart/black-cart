<!--main left-->
  @section('block_main_content_left')
      @yield('blockStoreLeft')
      <!--Module left -->
      @isset ($sc_blocksContent['left'])
      <div class="row position-absolute w-25 left-100">
        <div class="col-lg-3 col-md-6">
          <ul class="nav nav-pills nav-pills-primary nav-pills-icons flex-column" role="tablist">
            @foreach ( $sc_blocksContent['left'] as $key => $layout)
              <li class="nav-item">
                <a class="nav-link {{$key == 0 ? 'active show' : ''}}" data-toggle="tab" href="#link{{$key}}" role="tablist">
                  @php
                    $title = 'front.'.strtolower(str_replace(' ', '_', $layout->name));
                  @endphp
                  {{ trans($title) }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
        <div class="col-md-8 overflow-hidden rounded my-cus-card">
          <div class="tab-content">
              @foreach ( $sc_blocksContent['left'] as $key => $layout)
                @php
                  $arrPage = explode(',', $layout->page)
                @endphp
                @if (empty($layout->page) || $layout->page == '*' || (isset($layout_page) && in_array($layout_page, $arrPage)))
                  @if ($layout->type =='html')
                    {!! $layout->text !!}
                  @elseif($layout->type =='view')
                    @if (view()->exists($sc_templatePath.'.block.'.$layout->text))
                      <div class="tab-pane {{$key == 0 ? 'active' : ''}}" id="link{{$key}}">
                        @include($sc_templatePath.'.block.'.$layout->text)
                      </div>
                    @endif
                  @endif
                @endif
              @endforeach
          </div>
        </div>
      </div>
      @endisset
      <!--//Module left -->
  @show
<!--//main left-->
