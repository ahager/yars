<?php

class ContactsTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
    	// DB::table('contacts')->delete();

        $contacts = array(
        	array('name' => 'Ariel', 'lastname' => 'Vallese', 'gender' => 'male', 'nin' => '31438771'),
			array('name' => 'Cecilia', 'lastname' => 'Arancio', 'gender' => 'female', 'nin' => '30345678')
        );

        // Uncomment the below to run the seeder
        DB::table('contacts')->insert($contacts);
    }

}