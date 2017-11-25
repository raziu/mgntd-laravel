<?php

use Illuminate\Database\Seeder;

class PaymentsOptionsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $options = [
      '1' => 'mTransfer',
      '2' => 'Inteligo',
      '4' => 'iPKO',
      '6' => 'Przelew24 BZWBK',
      '18' => 'Przelew z Bank BPH',
      '36' => 'Bank PEKAO',
      '38' => 'ING',
      '44' => 'Millennium',
      '45' => 'ALIOR',
      '46' => 'CITI Handlowy',
      '48' => 'R-Przelew Raiffeisen',
      '50' => 'Toyota Bank',
      '51' => 'BOŚ',
      '56' => 'EUROBANK',
      '58' => 'Deutsche Bank',
      '60' => 'T-Mobile',
      '65' => 'IDEA Paylink',
      '66' => 'PBS Bank',
      '70' => 'Pocztowy24',
      '72' => 'Płacę z ORANGE',
      '73' => 'BLIK',
      '74' => 'BPS SGB',
      '75' => 'Plus Bank',
      '76' => 'GET IN Bank',
      '80' => 'NOBLE Bank',
      '81' => 'Idea Bank',
      '84' => 'Volkswagen Bank',
      //'86' => 'TrustPay',
      '20' => 'test'
    ];

    $dataInsert = [];
    foreach( $options as $k => $o )
    {
      $dataInsert[] = [
        'active' => 1,
        'parent' => 2,
        'name' => $o,
        'code' => $k,
        'icon' => '/img/dotpay/channel_'.$k.'_pl-140x70.png'
      ];
    }

    DB::table('payments_options')->delete();
    
    DB::table('payments_options')->insert( $dataInsert );
  }
}
