<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();


        $permissions = array(
            array(
                'name'      => 'manage_business',
                'display_name'      => 'Administrar Negocios'
            ),
            array(
                'name'      => 'manage_contacts',
                'display_name'      => 'Administrar Contactos'
            ),
            array(
                'name'      => 'make_reservations',
                'display_name'      => 'Hacer Reservas'
            ),
        );

        DB::table('permissions')->insert( $permissions );

        DB::table('permission_role')->delete();

        $permissions = array(
            array(
                'role_id'      => 1,
                'permission_id' => 1
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 2
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 3
            ),
            array(
                'role_id'      => 2,
                'permission_id' => 2
            ),
            array(
                'role_id'      => 3,
                'permission_id' => 3
            ),
        );

        DB::table('permission_role')->insert( $permissions );
    }

}
