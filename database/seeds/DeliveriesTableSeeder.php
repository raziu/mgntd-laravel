<?php

use Illuminate\Database\Seeder;

class DeliveriesTableSeeder extends Seeder
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
          'active' => 1,
          'name' => 'delivery_free',
          'icon' => 'free-delivery-truck',
          'desc' => 'delivery_free_desc',
          'delivery_time' => 'delivery_free_time',
          'order' => 0,
          'price' => '0.00'
        ],
        [
          'active' => 1,
          'name' => 'delivery_express',
          'icon' => 'express-shipping',
          'desc' => 'delivery_express_desc',
          'delivery_time' => 'delivery_express_time',
          'order' => 0,
          'price' => '8.00'
        ]
      ];

      DB::table('deliveries')->delete();

      DB::table('deliveries')->insert( $dataInsert );
    }
}
