<?php

namespace App\Providers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\ServiceProvider;
use Ramsey\Collection\Collection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('components.language_switcher', function ($view){
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });

        /*Collection paginator*/
        /*\Illuminate\Support\Collection::macro('paginate', function ($perPage = 10){
            $page = LengthAwarePaginator::resolveCurrentPage('page');

            return new LengthAwarePaginator($this->forPage($page, $perPage), $this->count(), $perPage, $page, [
                'path' => LengthAwarePaginator::resolveCurrentPage(),
                'query' => request()->query()
            ]);
        });*/
    }
}
