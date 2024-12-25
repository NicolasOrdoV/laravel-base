<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //*Lazy loading
        // Model::preventLazyLoading(!app()->isProduction());

        Vite::useScriptTagAttributes([
            'async' => true
        ]);
        // Gate::define('update-post', function( $user, $post) {
        //     return $user->id === $post->user_id;
        // });
        Gate::define('update-view-user-admin', function ($user, $userParams, $permissionName) {
            return ($user->hasRole('Admin') || !$userParams->hasRole('Admin')) && Auth::user()->hasPermissionTo($permissionName);
        });
        Gate::define('is-admin', function ($user) {
            return $user->hasRole('Admin');
        });
        //$this->removeIndexPHPFromUrl();
    }

    //*Eliminar index.php del proyecto
    function removeIndexPHPFromUrl()
    {
        if (Str::contains(request()->getRequest(), '/index.php')) {
            $url = str_replace('index.php/', '', request()->getRequestUri());
            if (strlen($url) > 0) {
                return redirect($url);
                // header("Location: $url", true, 301);
                // exit;
            }
        }
    }
}
