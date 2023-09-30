<nav id="pagination">
    <ul class="pagination">
        <li class="page-item{{ $data->currentPage() == 1 ? ' disabled' : '' }}">
            <a class="page-link shadow" href="{{ $data->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $data->currentPage() == 1 ? 'true' : 'false' }}">
                <i data-acorn-icon="chevron-left"></i>
            </a>
        </li>
        
        @php
            $showPages = isset($pages) ? $pages : 5;
            $startPage = max(1, $data->currentPage() - floor($showPages / 2));
            $endPage = min($data->lastPage(), $startPage + $showPages - 1);
        @endphp
        
        @for ($i = $startPage; $i <= $endPage; $i++)
            <li class="page-item{{ $data->currentPage() == $i ? ' active' : '' }}">
                <a class="page-link shadow page" href="{{ $data->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        
        <li class="page-item{{ $data->currentPage() == $data->lastPage() ? ' disabled' : '' }}">
            <a class="page-link shadow" href="{{ $data->nextPageUrl() }}" aria-disabled="{{ $data->currentPage() == $data->lastPage() ? 'true' : 'false' }}">
                <i data-acorn-icon="chevron-right"></i>
            </a>
        </li>
    </ul>
</nav>
