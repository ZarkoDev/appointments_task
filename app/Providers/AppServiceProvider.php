<?php

namespace App\Providers;

use App\View\Components\Client\AlertsContainerComponent;
use App\View\Components\Client\AppointmentsTableComponent;
use App\View\Components\Client\NotificationMethodsComponent;
use App\View\Components\Client\PaginationComponent;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();

        Blade::component('appointments-table', AppointmentsTableComponent::class);
        Blade::component('pagination', PaginationComponent::class);
        Blade::component('alerts-container', AlertsContainerComponent::class);
        Blade::component('notification-methods', NotificationMethodsComponent::class);
    }
}
