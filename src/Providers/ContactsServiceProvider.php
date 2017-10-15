<?php

declare(strict_types=1);

namespace Rinvex\Contacts\Providers;

use Illuminate\Support\ServiceProvider;
use Rinvex\Contacts\Contracts\ContactContract;
use Rinvex\Contacts\Console\Commands\MigrateCommand;
use Rinvex\Contacts\Console\Commands\PublishCommand;

class ContactsServiceProvider extends ServiceProvider
{
    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        MigrateCommand::class => 'command.rinvex.contacts.migrate',
        PublishCommand::class => 'command.rinvex.contacts.publish',
    ];

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(realpath(__DIR__.'/../../config/config.php'), 'rinvex.contacts');

        // Bind eloquent models to IoC container
        $this->app->singleton('rinvex.contacts.contact', function ($app) {
            return new $app['config']['rinvex.contacts.models.contact']();
        });
        $this->app->alias('rinvex.contacts.contact', ContactContract::class);

        // Register console commands
        ! $this->app->runningInConsole() || $this->registerCommands();
    }

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        // Load migrations
        ! $this->app->runningInConsole() || $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        // Publish Resources
        ! $this->app->runningInConsole() || $this->publishResources();
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    protected function publishResources()
    {
        $this->publishes([realpath(__DIR__.'/../../config/config.php') => config_path('rinvex.contacts.php')], 'rinvex-contacts-config');
        $this->publishes([realpath(__DIR__.'/../../database/migrations') => database_path('migrations')], 'rinvex-contacts-migrations');
    }

    /**
     * Register console commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        // Register artisan commands
        foreach ($this->commands as $key => $value) {
            $this->app->singleton($value, function ($app) use ($key) {
                return new $key();
            });
        }

        $this->commands(array_values($this->commands));
    }
}
