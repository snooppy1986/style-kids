<?php

namespace App\Livewire\Pagination;

use Livewire\Component;
use Livewire\WithPagination;

class CustomPaginationLinksView extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.pagination.custom-pagination-links-view');
    }
}
