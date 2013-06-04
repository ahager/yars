<?php

class BusinessesTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
    	DB::table('businesses')->delete();

        $businesses = array(
            [
                'slug'      => 'default',
                'name'      => 'Default',
                'website'   => 'xbooking.com.ar',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        #    [
        #        'slug'      => 'rodostyle',
        #        'name'      => 'rodostyle',
        #        'website'   => 'rodostlye.com.ar',
        #        'created_at' => new DateTime,
        #        'updated_at' => new DateTime,
        #    ],
        #    [
        #        'slug'      => 'hgnc',
        #        'name'      => 'HGNC',
        #        'website'   => 'hgnc.com.ar',
        #        'created_at' => new DateTime,
        #        'updated_at' => new DateTime,
        #    ],
        );

        // Uncomment the below to run the seeder
        DB::table('businesses')->insert($businesses);
    }

}