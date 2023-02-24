<?php

namespace App\Providers;

use App\Models\User;
use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(Newsletter::class,function (){
            $client = new ApiClient();
            $client->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us10'
            ]);
            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();

        Gate::define('admin', function (User $user){
            return $user->username ==='JeffreyWay';
        });

        // ? => indicate that if there is a user then check if he is admin or not , if there is not a user do not do this work
        Blade::if('admin',function (){
            return request()->user()?->can('admin');
        });
    }
}
