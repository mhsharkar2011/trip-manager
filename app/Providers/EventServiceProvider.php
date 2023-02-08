<?php

namespace App\Providers;

use App\RabbitMQService;
use App\Listeners\LogLoginEvent;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class => [
            LogLoginEvent::class,
        ],
        // \SocialiteProviders\Manager\SocialiteWasCalled::class => [
        //     // ... other providers
        //     'SocialiteProviders\\Shopify\\ShopifyExtendSocialite@handle',
        //     'SocialiteProviders\\GitLab\\GitLabExtendSocialite@handle',
        // ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('*', function ($eventName, array $data) {
            //Framework has a lot of events
            //if we want to log all events for testing, we have to skip the log event itself,
            //otherwise will fall into infinite loop
            if ('Illuminate\Log\Events\MessageLogged' !== $eventName) {
                // logger('catch all event handler, event name:' . $eventName, (array)$data);
            }

            if (
                Str::startsWith($eventName, 'App\Events')
                || Str::startsWith($eventName, 'App\Providers')
            ) { //handle only custom events that we add for this app

                // logger('catch all event handler, event name:' . $eventName, (array)$data);    

                //get the last part from App\Events|Providers\<Event>
                $eventName = explode('\\', $eventName);
                $eventName = end($eventName);

                $routing_key = sprintf('%s.%s', config('app.name'), $eventName);

                RabbitMQService::publish($routing_key, $data);
            }
        });
    }
}
