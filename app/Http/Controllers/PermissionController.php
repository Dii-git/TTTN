<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{   

    public function Permission()
    {   
        $user_permission = Permission::where('slug','create-posts')->first();
        $manager_permission = Permission::where('slug', 'edit-users')->first();

        //RoleTableSeeder.php
        $user_role = new Role();
        $user_role->slug = 'user';
        $user_role->name = 'User';
        $user_role->save();
        $user_role->permissions()->attach($user_permission);

        $manager_role = new Role();
        $manager_role->slug = 'manager';
        $manager_role->name = 'Manager';
        $manager_role->save();
        $manager_role->permissions()->attach($manager_permission);

        $user_role = Role::where('slug','user')->first();
        $manager_role = Role::where('slug', 'manager')->first();

        $createPosts = new Permission();
        $createPosts->slug = 'create-posts';
        $createPosts->name = 'Create Posts';
        $createPosts->save();
        $createPosts->roles()->attach($user_role);

        $editUsers = new Permission();
        $editUsers->slug = 'edit-users';
        $editUsers->name = 'Edit Users';
        $editUsers->save();
        $editUsers->roles()->attach($manager_role);

        $user_role = Role::where('slug','user')->first();
        $manager_role = Role::where('slug', 'manager')->first();
        $user_perm = Permission::where('slug','create-posts')->first();
        $manager_perm = Permission::where('slug','edit-users')->first();

        $manager = new User();
        $manager->username = 'Dii Admin';
        $manager->email = 'cao.huu.duy.150999@gmail.com';
        $manager->password = bcrypt('123456789');
        $manager->level = '1';
        $manager->save();
        $manager->roles()->attach($manager_role);
        $manager->permissions()->attach($manager_perm);

        $user_1 = new User();
        $user_1->username = 'Cao Huu Duy';
        $user_1->email = 'duybibeo@gmail.com';
        $user_1->password = bcrypt('123456789');
        $user_1->level = '0';
        $user_1->save();
        $user_1->roles()->attach($user_role);
        $user_1->permissions()->attach($user_perm);

        $user_2 = new User();
        $user_2->username = 'Dii Dii';
        $user_2->email = 'user2@gmail.com';
        $user_2->password = bcrypt('123456789');
        $user_2->level = '0';
        $user_2->save();
        $user_2->roles()->attach($user_role);
        $user_2->permissions()->attach($user_perm);
        
        return redirect()->back();
    }
}