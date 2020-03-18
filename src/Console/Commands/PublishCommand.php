<?php

declare(strict_types=1);

namespace Rinvex\Contacts\Console\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rinvex:publish:contacts {--f|force : Overwrite any existing files.} {--r|resource=all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Rinvex Contacts Resources.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->alert($this->description);

        switch ($this->option('resource')) {
            case 'config':
                $this->call('vendor:publish', ['--tag' => 'rinvex-contacts-config', '--force' => $this->option('force')]);
                break;
            case 'migrations':
                $this->call('vendor:publish', ['--tag' => 'rinvex-contacts-migrations', '--force' => $this->option('force')]);
                break;
            default:
                $this->call('vendor:publish', ['--tag' => 'rinvex-contacts-config', '--force' => $this->option('force')]);
                $this->call('vendor:publish', ['--tag' => 'rinvex-contacts-migrations', '--force' => $this->option('force')]);
                break;
        }

        $this->line('');
    }
}
