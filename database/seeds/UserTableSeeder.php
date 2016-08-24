<?php

/**
 * @package     Dashboard
 * @author      Ian Olson <me@ianolson.io>
 * @license     MIT
 * @copyright   2015, Laraflock
 * @link        https://github.com/laraflock
 */

use Illuminate\Database\Seeder;
use Laraflock\Dashboard\Repositories\Auth\AuthRepositoryInterface as Auth;
use Laraflock\Dashboard\Repositories\Role\RoleRepositoryInterface as Role;
use Laraflock\Dashboard\Repositories\User\UserRepositoryInterface as User;

class UserTableSeeder extends Seeder
{
    /**
     * Auth interface.
     *
     * @var Auth
     */
    protected $auth;

    /**
     * Role interface.
     *
     * @var Role
     */
    protected $role;

    /**
     * User interface.
     *
     * @var User
     */
    protected $user;

    /**
     * The constructor.
     *
     * @param Auth $auth
     * @param Role $role
     * @param User $user
     */
    public function __construct(Auth $auth, Role $role, User $user)
    {
        $this->auth = $auth;
        $this->role = $role;
        $this->user = $user;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultUser = [
          'email'      => 'perk_jiang@163.com',
          'password'   => '123456',
          'first_name' => '{{first_name}}',
          'last_name'  => '{{last_name}}',
        ];

        $this->auth->registerAndActivate($defaultUser, false);

        $role = $this->role->getBySlug('administrator');
        $user = $this->user->getById(1);

        $role->users()
             ->attach($user);
    }
}