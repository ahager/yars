<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        $adminRole = new Role;
        $adminRole->name = 'admin';
        $adminRole->save();

        $adminRole = new Role;
        $adminRole->name = 'collaborator';
        $adminRole->save();

        $commentRole = new Role;
        $commentRole->name = 'client';
        $commentRole->save();

        $user = User::where('username','=','admin')->first();
        $user->attachRole( $adminRole );

        $user = User::where('username','=','user')->first();
        $user->attachRole( $commentRole );
    }

}
