<?php

declare(strict_types=1);

namespace Rinvex\Contacts\Providers;

use Rinvex\Contacts\Models\Contact;
use Illuminate\Support\ServiceProvider;
use Rinvex\Support\Traits\ConsoleTools;
use Rinvex\Contacts\Console\Commands\MigrateCommand;
use Rinvex\Contacts\Console\Commands\PublishCommand;
use Rinvex\Contacts\Console\Commands\RollbackCommand;

class ContactsServiceProvider extends ServiceProvider
{
    use ConsoleTools;

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        MigrateCommand::class => 'command.rinvex.contacts.migrate',
        PublishCommand::class => 'command.rinvex.contacts.publish',
        RollbackCommand::class => 'command.rinvex.contacts.rollback',
    ];

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(realpath(__DIR__.'/../../config/config.php'), 'rinvex.contacts');

        // Bind eloquent models to IoC container
        $this->app->singleton('rinvex.contacts.contact', $contactModel = $this->app['config']['rinvex.contacts.models.contact']);
        $contactModel === Contact::class || $this->app->alias('rinvex.contacts.contact', Contact::class);

        // Register console commands
        ! $this->app->runningInConsole() || $this->registersCommands();
    }

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        // Publish Resources
        ! $this->app->runningInConsole() || $this->publishesConfig('rinvex/laravel-contacts');
        ! $this->app->runningInConsole() || $this->publishesMigrations('rinvex/laravel-contacts');
    }
}
