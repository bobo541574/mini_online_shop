<?php

namespace App\Console\Commands;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AssignPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:assign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        DB::beginTransaction();

        try {
            $this->info('---- Inserting User ----');

            $user = new User();

            if (!$user->where('email', "superadmin@gmail.com")->exists()) {
                $user->create([
                    'role_id' => 1,
                    'first_name' => "Super",
                    'last_name' => "Admin",
                    'user_name' => "super admin",
                    'email' => "superadmin@gmail.com",
                    'email_verified_at' => now(),
                    'phone' => "09999999999",
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'remember_token' => Str::random(10),
                ]);
                $this->info('---- Inserting Role ----');
            } else {
                $this->info('---- Hey!, "Super User" already is created. So, I carry on "Inserting Role". ----');
            }

            $role = new Role();

            if ($role->count() < 1) {
                $this->roleCreate($role);

                $this->info('---- "Super Admin" role is created ----');
            } else {
                if (!$role->where('name_en', 'Super Admin')->exists()) {
                    $this->roleCreate($role);

                    $this->info('---- "Super Admin" role is created. ----');
                } else {
                    $this->info('---- Hey!, "Super Admin" role is already created. So, I carry on "Role & permissions are assinged". ----');
                }
            }

            $role->find(1)->permissions()->sync(Permission::get());

            $this->info('---- Role & permissions are assinged.  ----');

            DB::commit();
        } catch (Exception $e) {

            DB::rollBack();

            $this->info('---- Error!, role & permissions are not assinged.  ----');
        }
    }

    protected function roleCreate($role)
    {
        $role->create([
            'name_en' => "Super Admin",
            'name_mm' => "စူပါအက်မင်",
            'slug' => strtoslug('Super Admin'),
        ]);
    }
}
