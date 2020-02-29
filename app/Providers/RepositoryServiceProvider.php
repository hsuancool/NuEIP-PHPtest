<?php

namespace App\Providers;

use App\Repositories\AccountInfoRepository;
use App\Repositories\AccountInfoRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AccountInfoRepositoryInterface::class, AccountInfoRepository::class);
    }
}