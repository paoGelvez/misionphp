<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\Deportes;
use App\Models\entrenadores;
use App\Models\Equipos;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        Permission::create(['name' => 'create deportes']);
        Permission::create(['name' => 'delete deportes']);
        Permission::create(['name' => 'edit deportes']);
        Permission::create(['name' => 'list deportes']);
        Permission::create(['name' => 'create entrenadores']);
        Permission::create(['name' => 'delete entrenadores']);
        Permission::create(['name' => 'edit entrenadores']);
        Permission::create(['name' => 'list entrenadores']);
        Permission::create(['name' => 'create equipo']);
        Permission::create(['name' => 'delete equipo']);
        Permission::create(['name' => 'edit equipo']);
        Permission::create(['name' => 'list equipo']);
        Permission::create(['name' => 'create jugadores']);
        Permission::create(['name' => 'delete jugadores']);
        Permission::create(['name' => 'edit jugadores']);
        Permission::create(['name' => 'list jugadores']);
        Permission::create(['name' => 'create posiciones']);
        Permission::create(['name' => 'delete posiciones']);
        Permission::create(['name' => 'edit posiciones']);
        Permission::create(['name' => 'list posisiones']);

        $admin = Role::create(['name'=>'admin']);
        $admin->givePermissionTo(Permission::all());

        $Manager = Role::create(['name'=> 'Manager']);
        $Manager->givePermissionTo(['list posisiones','edit posiciones','delete posiciones','create posiciones','list jugadores','edit jugadores','delete jugadores','create jugadores','list equipo','edit equipo','delete equipo','create equipo']);


        Deportes::factory(5)->create();
        entrenadores::factory(5)->create();
        User::factory(5)->create();

    }


}
