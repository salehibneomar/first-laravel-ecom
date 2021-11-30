
@if ($paginator->hasPages())
<ul class="list-inline list-unstyled">
   
    @if ($paginator->onFirstPage())
        <li class="pagination-next-prev-button disabled"><span><i class="fa fa-angle-left"></i></span></li>
    @else
        <li><a href="{{ $paginator->previousPageUrl() }}" class="pagination-next-prev-button"><i class="fa fa-angle-left"></i></a></li>
    @endif

    @foreach ($elements as $element)
       
        @if (is_string($element))
            <li class="disabled"><span>{{ $element }}</span></li>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="pagination-active"><span>{{ $page }}</span></li>
                @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach


    @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}" class="pagination-next-prev-button" ><i class="fa fa-angle-right"></i></a></li>
    @else
        <li class="pagination-next-prev-button disabled"><span><i class="fa fa-angle-right"></i></span></li>
    @endif

</ul>

@endif 