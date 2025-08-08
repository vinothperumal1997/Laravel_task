<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Interfaces\LoanDetailRepositoryInterface;
use App\Repositories\LoanDetailRepository;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        $this->app->bind(LoanDetailRepositoryInterface::class, LoanDetailRepository::class);
    }

  
    public function boot(): void
    {
            Paginator::useBootstrapFive();

    }
}
