<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
//        // Garante redundância caso o middleware falhe
//        view()->composer('*', function ($view) {
//            if (!isset($view->getData()['currentProfissional']) && auth()->check()) {
//                $user = auth()->user()->loadMissing('profissional');
//                $view->with('currentProfissional', [
//                    'id' => $user->profissional->id ?? null,
//                    'nome' => $user->profissional->nome ?? $user->name,
//                    'thumbnail' => $user->profissional->thumbnail
//                        ? asset('storage/'.$user->profissional->thumbnail)
//                        : asset('images/default-avatar.jpg'),
//                ]);
//            }
//        });
    }
}
