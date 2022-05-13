<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

        $permissionAdminProductsModules = Permission::create(['name' => 'admin.products.modules']);

        Role::create(['name' => 'admin'])->syncPermissions([
        
            $permissionAdminIndex,

            $permissionAdminUsersIndex,
            $permissionAdminUsersCreate,
            $permissionAdminUsersEdit,

            $permissionAdminProductsIndex,
            $permissionAdminProductsCreate,
            $permissionAdminProductsEdit,
            $permissionAdminProductsDelete,

            $permissionAdminCtaegoryIndex,
            $permissionAdminCategoryCreate,
            $permissionAdminCategoryEdit,
            $permissionAdminCategoryDelete,

            $permissionAdminProductsModules,
        ]);

        Role::create(['name' => 'custom']);
    }
}
