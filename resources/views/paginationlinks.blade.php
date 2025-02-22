@if ($paginator->hasPages())
<div class="pagination mt-5 pt-4">
    <ul class="list-inline">
        <!-- Previous page link -->
        @if ($paginator->onFirstPage())
            <li class="list-inline-item"><a disabled><i class="fas fa-arrow-left"></i></a></li>
        @else
            <li class="list-inline-item"><a href="{{$paginator->previousPageUrl()}}" rel="prev"><i class="fas fa-arrow-left"></i></a></li>
        @endif

        <!-- Pagination elements here -->
        @foreach ($elements as $element)
            <!-- Make three dots -->
            @if (is_string($element))
                <li class="list-inline-item disabled"><a href=""><span>{{$element}}</span></a></li>
            @endif

            <!-- Links array here -->
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="list-inline-item"><a href="" class="active"><span>{{$page}}</span></a></li>
                    @else
                        <li class="list-inline-item"><a href="{{$url}}">{{$page}}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- Next page link -->
        @if ($paginator->hasMorePages())
            <li class="list-inline-item"><a href="{{$paginator->nextPageUrl()}}"><i class="fas fa-arrow-right"></i></a></li>
        @else
            <li class="list-inline-item"><a disabled><i class="fas fa-arrow-right"></i></a></li>
        @endif
    </ul>
</div>
@endif