<?php

declare(strict_types=1);

namespace Rinvex\Contacts\Console\Commands;

use Illuminate\Console\Command;

class RollbackCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rinvex:rollback:contacts {--f|force : Force the operation to run when in production.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback Rinvex Contacts Tables.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->alert($this->description);

        $path = config('rinvex.contacts.autoload_migrations') ?
            'vendor/rinvex/laravel-contacts/database/migrations' :
            'database/migrations/rinvex/laravel-contacts';

        if (file_exists($path)) {
            $this->call('migrate:reset', [
                '--path' => $path,
                '--force' => $this->option('force'),
            ]);
        } else {
            $this->warn('No migrations found! Consider publish them first: <fg=green>php artisan rinvex:publish:contacts</>');
        }

        $this->line('');
    }
}
