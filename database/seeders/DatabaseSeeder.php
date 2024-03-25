<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\src\Domain\Permissions\Constants\AdminPermission;
use App\src\Models\AdminRole\AdminRole;
use App\src\Models\User\User;
use App\src\Services\AdminRole\AdminRoleServiceInterface;
use App\src\Services\User\UserServiceInterface;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function __construct(
        private readonly UserServiceInterface $adminService,
        private readonly AdminRoleServiceInterface $adminRoleService
    ) {
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $this->command->info('Seeding admin entity');

        $email = 'admin@posc.com';
        if (!$this->adminService->findByEmail($email) instanceof User) {
            /* @var AdminRole $role */
            $role = $this->adminRoleService->create(
                [
                    AdminRole::NAME_COLUMN        => 'Super',
                    AdminRole::PERMISSIONS_COLUMN => AdminPermission::SUPER,
                    AdminRole::DESCRIPTION_COLUMN => '',
                ]
            );
            $this->adminService->create(
                [
                    User::FIRST_NAME_COLUMN   => $faker->firstName(),
                    User::LAST_NAME_COLUMN    => $faker->firstName(),
                    User::PHONE_NUMBER_COLUMN => $faker->phoneNumber(),
                    User::ADDRESS_COLUMN      => $faker->address(),
                    User::EMAIL_COLUMN        => $email,
                    User::PASSWORD_COLUMN     => 'password',
                    User::ROLE_ID_COLUMN      => $role->getId(),
                ]
            );
        }
    }
}
