<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
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
          'name' => 'payment_wire',
          'code' => 'wire',
          'icon' => 'payment-bank',
          'desc' => 'payment_wire_desc',
          'subs' => 0,
          'order' => 0,
        ],
        [
          'active' => 1,
          'name' => 'payment_dotpay',
          'code' => 'dotpay',
          'icon' => 'payment-dotpay',
          'desc' => 'payment_dotpay_desc',
          'subs' => 1,
          'order' => 0,
        ],
        [
          'active' => 0,
          'name' => 'payment_paypal',
          'code' => 'paypal',
          'icon' => 'payment-paypal',
          'desc' => 'payment_paypal_desc',
          'subs' => 0,
          'order' => 0,
        ],
      ];

      DB::table('payments')->delete();

      DB::table('payments')->insert( $dataInsert );
    }
}
