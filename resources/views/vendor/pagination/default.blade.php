@if ($paginator->hasPages())
  <nav class="pagination">
    <ul>
      {{-- Previous Page Link --}}
      @if ($paginator->onFirstPage())
        <li class="disabled" aria-disabled="true" aria-label="{{ __('pagination.previous') }}"><a href="#">
            <i class="fa fa-caret-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}" aria-hidden="true"></i>
          </a>
        </li>
      @else
        <li>
          <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}">
            <i class="fa fa-caret-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}" aria-hidden="true"></i>
          </a>
        </li>
      @endif

      {{-- Pagination Elements --}}
      @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
          <li class="disabled" aria-disabled="true">
            <span>{{ $element }}</span>
          </li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <li class="active" aria-current="page">
                <a href="{{ $url }}">{{ $page }}</a>
              </li>
            @else
              <li><a href="{{ $url }}">{{ $page }}</a></li>
            @endif
          @endforeach
        @endif
      @endforeach

      {{-- Next Page Link --}}
      @if ($paginator->hasMorePages())
        <li>
          <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
            <i class="fa fa-caret-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}" aria-hidden="true"></i>
          </a>
        </li>
      @else
        <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
          <i class="fa fa-caret-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}" aria-hidden="true"></i>
        </li>
      @endif
    </ul>
  </nav>
@endif
