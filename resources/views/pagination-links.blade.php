@if ($paginator->hasPages())
    <div class="box-footer clearfix">
        <ul class="pagination pagination-sm no-margin pull-right">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li wire:click="previousPage"><a href="#">Sebelumnya</a></li>
        @else
            <li wire:click="previousPage"><a href="#">Sebelumnya</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                            <li class="active" wire:click="gotoPage({{ $page }})"><a href="#">{{ $page }}</a></li>
                        @else
                            <li wire:click="gotoPage({{ $page }})"><a href="#">{{ $page }}</a></li>
                       @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li wire:click="nextPage"><a href="#">Berikutnya</a></li>
            @else
            <li wire:click="nextPage"><a href="#">Berikutnya</a></li>
        @endif

        </ul>
    </div>
@endif

