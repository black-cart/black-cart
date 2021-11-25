@if (!empty($news))
  <!-- Our Blog-->
  @foreach ($news as $key => $blog)
    <div class="p-b-63">
      <a href="{{ $blog->getUrl() }}" class="hov-img0 how-pos5-parent">
        <img src="{{ asset($blog->getThumb()) }}" alt="IMG-BLOG">

        <div class="flex-col-c-m size-123 bg9 how-pos5">
          <span class="ltext-107 cl2 txt-center">
            {{ $blog->created_at->format('d') }}
          </span>

          <span class="stext-109 cl3 txt-center">
            {{ $blog->created_at->format('M Y') }}
          </span>
        </div>
      </a>

      <div class="p-t-32">
        <h4 class="p-b-15">
          <a href="{{ $blog->getUrl() }}" class="ltext-108 cl2 hov-cl1 trans-04">
            {{ $blog->title }}
          </a>
        </h4>

        <p class="stext-117 cl6">
          {!! \Illuminate\Support\Str::limit($blog->content, 200) !!}
        </p>

        <div class="flex-w flex-sb-m p-t-18">
          <span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
            <span>
              <span class="cl4">By</span> Admin  
              <span class="cl12 m-l-4 m-r-6">|</span>
            </span>

            <span>
              StreetStyle, Fashion, Couple  
              <span class="cl12 m-l-4 m-r-6">|</span>
            </span>

            <span>
              8 Comments
            </span>
          </span>

          <a href="{{ $blog->getUrl() }}" class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
            Continue Reading

            <i class="fa fa-long-arrow-right m-l-9"></i>
          </a>
        </div>
      </div>
    </div>
  @endforeach
  <!-- Pagination -->
  <div class="flex-l-m flex-w w-full p-t-10 m-lr--7">
    <a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
      1
    </a>

    <a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7">
      2
    </a>
  </div>
@endif