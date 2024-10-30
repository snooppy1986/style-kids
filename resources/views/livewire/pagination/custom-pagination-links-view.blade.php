@php
    if (! isset($scrollTo)) {
        $scrollTo = 'body';
    }

    $scrollIntoViewJsSnippet = ($scrollTo !== false)
        ? <<<JS
           (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
        JS
        : '';
@endphp

{{--<div>
    @if ($paginator->hasPages())
        <nav>
            <ul class="pagination">
                --}}{{-- Previous Page Link --}}{{--
              --}}{{--  @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <i class='bx bx-chevron-left'></i> Prev
                    </li>
                @else
                    <li class="page-item">
                        <button type="button" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="page-link" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" aria-label="@lang('pagination.previous')">&lsaquo;</button>
                    </li>
                @endif--}}{{--
                <ul class="pagination">
                    @if($paginator->onFirstPage())
                        <li class="page-item">
                            <a class="page-link">
                                <i class='bx bx-chevron-left'></i> Prev
                            </a>
                        </li>
                    @else
                        <li class="page-item" wire:click="previousPage" wire:loading.attr="disabled" rel="prev">
                            <button type="button"
                                    dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                    class="page-link"
                                    wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                    x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                    wire:loading.attr="disabled"
                                    aria-label="@lang('pagination.previous')"> <i class='bx bx-chevron-left'></i> Prev</button>
                          --}}{{--  <a class="page-link" href="javascript:;">
                                <i class='bx bx-chevron-left'></i> Prev
                            </a>--}}{{--
                        </li>
                    @endif
                </ul>

                --}}{{-- Pagination Elements --}}{{--
                --}}{{--@foreach ($elements as $element)
                    --}}{{----}}{{-- "Three Dots" Separator --}}{{----}}{{--
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    --}}{{----}}{{-- Array Of Links --}}{{----}}{{--
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active"
                                    wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}"
                                    aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item"
                                    wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}">
                                    <button type="button"
                                            class="page-link"
                                            wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                    >{{ $page }}</button>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach--}}{{--
                <ul class="pagination">
                    @foreach($elements as $element)
                        @if(is_string($element))
                            <li class="page-item disabled d-none d-md-block" aria-disabled="true">
                                <span class="page-link">{{ $element }}</span>
                            </li>
                        @endif
                        @if(is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                        <li class="page-item active"
                                            wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}"
                                            aria-current="page">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                @else
                                        <li class="page-item"
                                            wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}">
                                            <button type="button"
                                                    class="page-link"
                                                    wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                                    x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                            >{{ $page }}</button>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </ul>
                --}}{{-- Next Page Link --}}{{--
                --}}{{--@if ($paginator->hasMorePages())
                    <li class="page-item">
                        <button type="button" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="page-link" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" aria-label="@lang('pagination.next')">&rsaquo;</button>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="page-link" aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif--}}{{--
                <ul class="pagination">
                    @if($paginator->hasMorePages())
                        <li class="page-item" wire:click="nextPage" wire:loading.attr="disabled" rel="next" >
                            <button type="button"
                                    dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                    class="page-link"
                                    wire:click="nextPage('{{ $paginator->getPageName() }}')"
                                    x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                    wire:loading.attr="disabled"
                                    aria-label="@lang('pagination.next')"
                            >Next <i class='bx bx-chevron-right'></i>
                            </button>
                            --}}{{--<a class="page-link" href="javascript:;" aria-label="Next">
                                Next <i class='bx bx-chevron-right'></i>
                            </a>--}}{{--
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link"  aria-label="Next">
                                Next <i class='bx bx-chevron-right'></i>
                            </a>
                        </li>
                    @endif

                </ul>
            </ul>
        </nav>
    @endif
</div>--}}
{{-----------------------------------}}
<div>
    @if($paginator->hasPages())
        <nav class="d-flex justify-content-between" aria-label="Page navigation">
            <ul class="pagination">
                @if($paginator->onFirstPage())
                    <li class="page-item">
                        <a class="page-link" href="javascript:;">
                            <i class='bx bx-chevron-left'></i> {{__('Previous')}}
                        </a>
                    </li>
                @else
                    <li class="page-item"
                        wire:click="previousPage"
                        wire:loading.attr="disabled"
                        x-on:click="{{ $scrollIntoViewJsSnippet }}"
                        rel="prev">
                        <a class="page-link" href="javascript:;">
                            <i class='bx bx-chevron-left'></i> {{__('Previous')}}
                        </a>
                    </li>
                @endif
            </ul>
            <ul class="pagination">
                @foreach($elements as $element)
                    @if(is_string($element))
                        <li class="page-item disabled d-none d-md-block" aria-disabled="true">
                            <span class="page-link">{{ $element }}</span>
                        </li>
                    @endif
                    @if(is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active d-none d-sm-block" aria-current="page">
                                        <span class="page-link">{{$page}}<span class="visually-hidden">(current)</span></span>
                                    </li>
                                @else
                                    <li class="page-item d-none d-sm-block">
                                        <a x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:click="gotoPage({{ $page }})" class="page-link" href="javascript:;">{{$page}}</a>
                                    </li>
                                @endif
                            @endforeach
                    @endif
                @endforeach
            </ul>

            <ul class="pagination">
                @if($paginator->hasMorePages())
                    <li class="page-item" wire:click="nextPage" wire:loading.attr="disabled"  x-on:click="{{ $scrollIntoViewJsSnippet }}" rel="next" >
                        <a class="page-link" href="javascript:;" aria-label="Next">
                            {{__('Next')}} <i class='bx bx-chevron-right'></i>
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="javascript:;" aria-label="Next">
                            {{__('Next')}} <i class='bx bx-chevron-right'></i>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
    @endif
</div>

