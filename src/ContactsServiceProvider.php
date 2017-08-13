<?php

declare(strict_types=1);

namespace Rinvex\Contacts;

use Illuminate\Support\ServiceProvider;
use Rinvex\Contacts\Console\Commands\MigrateCommand;

class ContactsServiceProvider extends ServiceProvider
{
    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        MigrateCommand::class => 'command.rinvex.tenantable.migrate',
    ];

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(realpath(__DIR__.'/../config/config.php'), 'rinvex.contacts');

        // Register artisan commands
        foreach ($this->commands as $key => $value) {
            $this->app->singleton($value, function ($app) use ($key) {
                return new $key();
            });
        }

        $this->commands(array_values($this->commands));
    }

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // Load migrations
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

            // Publish Resources
            $this->publishResources();
        }
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    protected function publishResources()
    {
        $this->publishes([realpath(__DIR__.'/../config/config.php') => config_path('rinvex.contacts.php')], 'rinvex-contacts-config');
        $this->publishes([realpath(__DIR__.'/../database/migrations') => database_path('migrations')], 'rinvex-contacts-migrations');
    }
}
