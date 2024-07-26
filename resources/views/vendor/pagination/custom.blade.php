@if ($paginator->hasPages())
  <div class="custom-pagination text-center">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <a href="#" class="prev disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
        <i class="bi bi-arrow-left"></i>
      </a>
    @else
      <a href="{{ $paginator->previousPageUrl() }}" class="prev" rel="prev" aria-label="@lang('pagination.previous')">
        <i class="bi bi-arrow-left"></i>
      </a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
      {{-- "Three Dots" Separator --}}
      @if (is_string($element))
        <a href="#" class="disabled" aria-disabled="true">{{ $element }}</a>
      @endif

      {{-- Array Of Links --}}
      @if (is_array($element))
        @foreach ($element as $page => $url)
          {{-- Show active page, first page, last page, and pages near the active page --}}
          @if ($page == $paginator->currentPage())
            <a href="#" class="active" aria-current="page">{{ $page }}</a>
          @elseif (
              $page == 1 ||
                  $page == $paginator->lastPage() ||
                  ($page >= $paginator->currentPage() - 2 && $page <= $paginator->currentPage() + 2))
            <a href="{{ $url }}">{{ $page }}</a>
          @elseif ($page == $paginator->currentPage() - 3 || $page == $paginator->currentPage() + 3)
            <a href="#" class="disabled">...</a>
          @endif
        @endforeach
      @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <a href="{{ $paginator->nextPageUrl() }}" class="next" rel="next" aria-label="@lang('pagination.next')">
        <i class="bi bi-arrow-right"></i>
      </a>
    @else
      <a href="#" class="next disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
        <i class="bi bi-arrow-right"></i>
      </a>
    @endif
  </div>
@endif
