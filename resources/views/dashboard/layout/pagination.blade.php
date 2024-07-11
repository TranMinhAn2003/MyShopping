<div class="pagination">
    <ul>
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
</div>

<style>
.pagination {
margin: 20px 0;
text-align: center;
}

.pagination ul {
display: inline-block;
padding: 0;
margin: 0;
}

.pagination li {
display: inline;
margin: 0;
}

.pagination li a,
.pagination li span {
padding: 8px 12px;
margin: 0 4px;
color: #333;
background-color: #f7f7f7;
border: 1px solid #ddd;
border-radius: 4px;
text-decoration: none;
}

.pagination li.disabled span {
color: #aaa;
background-color: #eee;
cursor: not-allowed;
}

.pagination li.active a,
.pagination li.active span {
color: #fff;
background-color: #337ab7;
border-color: #337ab7;
cursor: default;
}
</style>
