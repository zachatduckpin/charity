@props([
    'paginator',
])

@if ($paginator->hasPages())
    <nav class="dashboard-pagination" aria-label="Pagination">
        <div class="dashboard-pagination-summary">
            Showing {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} of {{ $paginator->total() }}
        </div>

        <div class="dashboard-pagination-links">
            @if ($paginator->onFirstPage())
                <span class="dashboard-pagination-link is-disabled">Previous</span>
            @else
                <a class="dashboard-pagination-link" href="{{ $paginator->previousPageUrl() }}">Previous</a>
            @endif

            <span class="dashboard-pagination-page">Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}</span>

            @if ($paginator->hasMorePages())
                <a class="dashboard-pagination-link" href="{{ $paginator->nextPageUrl() }}">Next</a>
            @else
                <span class="dashboard-pagination-link is-disabled">Next</span>
            @endif
        </div>
    </nav>
@endif
