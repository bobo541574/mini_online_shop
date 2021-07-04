<?php

namespace App\Console\Commands;

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class CreatePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create permissions for user authorization.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('---- Deleting Permission Table ----');

        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();

        $this->info('---- Inserting Permissions ----');

        $permission = new Permission();

        $count = 0;

        $lists = config('permissions');

        foreach ($lists as $key => $list) {
            $type = explode('-', $key);

            foreach ($list as $p) {
                $permission->create([
                    'name_en' => $p['name_en'],
                    'name_mm' => $p['name_mm'],
                    'slug' => $p['slug'],
                    'type' => Str::of(strtolower($key))->singular(),
                ]);

                $count = $count + 1;
            }
        }

        $this->info('----  permissions are created.  ----');
    }
}
