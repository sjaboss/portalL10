<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Crear roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Crear permisos para cada recurso
        $resources = ['secciones', 'noticias', 'publicidades', 'historiales', 'videos', 'baner', 'redes', 'logos', 'usuarios'];
        
        foreach ($resources as $resource) {
            $permissions = [
                "view_{$resource}",
                "create_{$resource}",
                "edit_{$resource}",
                "delete_{$resource}"
            ];
            
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }
        }

        // Asignar todos los permisos al rol admin
        $adminRole->givePermissionTo(Permission::all());
    }
}
