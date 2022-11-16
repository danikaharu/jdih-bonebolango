@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination custom-pagination">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1"><img
                            src="{{ asset('template_user/assets/img/icon/arrow-left.svg') }}" alt="arrow-previous"></a>
                </li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><img
                            src="{{ asset('template_user/assets/img/icon/arrow-left.svg') }}" alt="arrow-previous"></a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled">{{ $element }}</li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a class="page-link">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <img src="{{ asset('template_user/assets/img/icon/arrow-right.svg') }}" alt="arrow-next">
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#">
                        <img src="{{ asset('template_user/assets/img/icon/arrow-right.svg') }}" alt="arrow-next">
                    </a>
                </li>
            @endif
        </ul>
@endif
