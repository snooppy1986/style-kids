<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\CompanyInfo;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {

        $categories = Category::query()
            ->with('children')
            ->whereNull('parent_id')
            ->get();
        $company_info = CompanyInfo::query()->where('active', '=', 1)->first();

        return view('layouts.app', compact('categories', 'company_info'));
    }
}
