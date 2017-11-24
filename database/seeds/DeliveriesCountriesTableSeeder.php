<?php

use Illuminate\Database\Seeder;

class DeliveriesCountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $dataInsert = [
        [
          'country_id' => 0, // for all
          'delivery_id' => 1 // free
        ],
        [
          'country_id' => 135, // Poland
          'delivery_id' => 2 // express
        ],
      ];

      DB::table('deliveries_countries')->delete();
      
      DB::table('deliveries_countries')->insert( $dataInsert );
    }
}
