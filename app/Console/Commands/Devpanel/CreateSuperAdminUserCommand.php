<?php

namespace App\Console\Commands\Devpanel;

use App\Models\User;
use Illuminate\Console\Command;

class CreateSuperAdminUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:create-super-admin
    {--name=Reza : name of the super admin user}
    {--email=reza@itconquest.com : login email, has to be unique and not existing already}
    {--password= : password for the login}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use this to create the first super admin or more. 
    If ran without email, pwd then a super admin will be created with the default email, pwd';

    protected $name;
    protected $email;
    protected $password;

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
     * @return mixed
     */
    public function handle()
    {
        $this->name = $this->option('name');
        $this->email = $this->option('email');
        $this->password = $this->option('password') ?: '@#ITC132132';

        $userT = \DB::table('users');

        if ($userT->where('email', $this->email)->exists()) {
            return $this->error('The email ('. $this->email .') already exists in the database');
        }

        try {
            $userT->insert([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'role' => User::ROLE_SUPER_ADMIN,
                'email_verified_at' => now(),
            ]);

            $this->info('The super admin user ('. $this->email  .') was created');
            return 0;
        } catch(\Exception $ex) {
            $this->error('The super admin user ('. $this->email  .') could not be created due to an error: ' . $ex->getMessage());
            return 1;
        }

    }
}
