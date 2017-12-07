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
    protected $signature = 'rinvex:rollback:contacts';

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
    public function handle()
    {
        $this->warn($this->description);
        $this->call('migrate:reset', ['--path' => 'vendor/rinvex/contacts/database/migrations']);
    }
}
