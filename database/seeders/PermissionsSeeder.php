<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit advertisements']);
        Permission::create(['name' => 'delete advertisements']);
        Permission::create(['name' => 'create advertisements']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit admins']);
        Permission::create(['name' => 'delete admins']);
        Permission::create(['name' => 'create admins']);


        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'user']);
        $role1->givePermissionTo('edit advertisements');
        $role1->givePermissionTo('delete advertisements');
        $role1->givePermissionTo('create advertisements');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('edit advertisements');
        $role2->givePermissionTo('delete advertisements');
        $role2->givePermissionTo('create advertisements');
        $role2->givePermissionTo('edit users');
        $role2->givePermissionTo('delete users');
        $role2->givePermissionTo('create users');

        $role3 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider
        $role3->givePermissionTo('edit admins');
        $role3->givePermissionTo('delete admins');
        $role3->givePermissionTo('create admins');

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Gabriel Gonzalez',
            'email' => 'user@example.com',
            'phone' => '999999999',

        ]);
        $user->assignRole($role1);
        $adverisement = Advertisement::find(1);
        $user->advertisements()->save($adverisement);

        $adverisement = Advertisement::find(2);
        $user->advertisements()->save($adverisement);

        $adverisement = Advertisement::find(3);
        $user->advertisements()->save($adverisement);
        
        $user = \App\Models\User::factory()->create([
            'name' => 'Adrian Sunye',
            'email' => 'user2@example.com',
            'phone' => '888888886',
        ]);
        $user->assignRole($role1);
        $adverisement = Advertisement::find(4);
        $user->advertisements()->save($adverisement);

        $adverisement = Advertisement::find(5);
        $user->advertisements()->save($adverisement);

        $adverisement = Advertisement::find(6);
        $user->advertisements()->save($adverisement);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'user3@example.com',
            'phone' => '55555555',
        ]);
        $user->assignRole($role1);
        $adverisement = Advertisement::find(7);
        $user->advertisements()->save($adverisement);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Admin User',
            'email' => 'admin@example.com',
            'phone' => '222222222',

        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Super-Admin User',
            'email' => 'superadmin@example.com',
            'phone' => '0023002030',

        ]);
        $user->assignRole($role3);
    }
}