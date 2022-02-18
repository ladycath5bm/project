<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        
        $permissionAdminIndex = Permission::create(['name' => 'admin.home']);

        $permissionAdminUsersIndex = Permission::create(['name' => 'admin.users.index']);
        $permissionAdminUsersCreate = Permission::create(['name' => 'admin.users.create']);
        $permissionAdminUsersEdit = Permission::create(['name' => 'admin.users.edit']);

        $permissionAdminProductsIndex = Permission::create(['name' => 'admin.products.index']);
        $permissionAdminProductsCreate = Permission::create(['name' => 'admin.products.create']);
        $permissionAdminProductsEdit = Permission::create(['name' => 'admin.products.edit']);
        $permissionAdminProductsDelete = Permission::create(['name' => 'admin.products.destroy']);

        $permissionAdminCtaegoryIndex = Permission::create(['name' => 'admin.categories.index']);
        $permissionAdminCategoryCreate = Permission::create(['name' => 'admin.categories.create']);
        $permissionAdminCategoryEdit = Permission::create(['name' => 'admin.categories.edit']);
        $permissionAdminCategoryDelete = Permission::create(['name' => 'admin.categories.destroy']);

        $rolAdmin = Role::create(['name' => 'admin'])->syncPermissions([ $permissionAdminProductsIndex,
            $permissionAdminIndex,
            
            $permissionAdminUsersIndex,
            $permissionAdminUsersCreate,
            $permissionAdminUsersEdit,

            $permissionAdminProductsCreate,
            $permissionAdminProductsEdit,
            $permissionAdminProductsDelete,

            $permissionAdminCtaegoryIndex,
            $permissionAdminCategoryCreate,
            $permissionAdminCategoryEdit,
            $permissionAdminCategoryDelete,
        ]);

        $rolCustom = Role::create(['name' => 'custom']);
    }
}
