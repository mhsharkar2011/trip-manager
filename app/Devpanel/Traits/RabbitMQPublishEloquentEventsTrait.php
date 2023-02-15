<?php

namespace App\Devpanel\Traits;

use App\RabbitMQService;

trait RabbitMQPublishEloquentEventsTrait {

    private static function _get_routing_key($model, $action) {
        $entity = class_basename($model);

        $routing_key = sprintf('%s.%s.%s', 
            strtolower(config('app.name')),
            strtolower($entity),
            $action
        );

        return $routing_key;
    }

    private static function _publish($model, $action) {
        RabbitMQService::publish(
            static::_get_routing_key($model, $action), 
            $model->toArray()
        );
    }

    public static function bootRabbitMQPublishEloquentEventsTrait() {
        static::created(function($model) {
            static::_publish($model, 'create');
        });

        static::updated(function($model) {
            static::_publish($model, 'update');
        });

        static::deleted(function($model) {
            static::_publish($model, 'delete');
        });
    }

}