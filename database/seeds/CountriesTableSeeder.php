<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $countries = [
        ['af' , 'Afganistan' , 'Afghanistan' , 'Afghanistan'],
        ['al' , 'Albania' , 'Albania' , 'Albanien'],
        ['dz' , 'Algieria' , 'Algeria' , 'Algerien'],
        ['ad' , 'Andora' , 'Andorra' , 'Andorra'],
        ['ao' , 'Angola' , 'Angola' , 'Angola'],
        ['ag' , 'Antigua i Barbuda' , 'Antigua and Barbuda' , 'Antigua und Barbuda'],
        ['sa' , 'Arabia Saudyjska' , 'Saudi Arabia' , 'Saudi-Arabien'],
        ['ar' , 'Argentyna' , 'Argentina' , 'Argentinien'],
        ['am' , 'Armenia' , 'Armenia' , 'Armenien'],
        ['au' , 'Australia' , 'Australia' , 'Australien'],
        ['at' , 'Austria' , 'Austria' , 'Österreich'],
        ['az' , 'Azerbejdżan' , 'Azerbaijan' , 'Aserbaidschan'],
        ['bs' , 'Bahamy' , 'Bahamas' , 'Bahamas'],
        ['bh' , 'Bahrajn' , 'Bahrain' , 'Bahrain'],
        ['bd' , 'Bangladesz' , 'Bangladesh' , 'Bangladesch'],
        ['bb' , 'Barbados' , 'Barbados' , 'Barbados'],
        ['be' , 'Belgia' , 'Belgium' , 'Belgien'],
        ['bz' , 'Belize' , 'Belize' , 'Belize'],
        ['bj' , 'Benin' , 'Benin' , 'Benin'],
        ['bt' , 'Bhutan' , 'Bhutan' , 'Bhutan'],
        ['by' , 'Białoruś' , 'Belarus' , 'Weißrussland / Belarus'],
        ['mm' , 'Birma' , 'Myanmar' , 'Birma'],
        ['bo' , 'Boliwia' , 'Bolivia' , 'Bolivien'],
        ['ba' , 'Bośnia i Hercegowina' , 'Bosnia and Herzegovina' , 'Bosnien und Herzegowina'],
        ['bw' , 'Botswana' , 'Botswana' , 'Botsuana'],
        ['br' , 'Brazylia' , 'Brazil' , 'Brasilien'],
        ['bn' , 'Brunei' , 'Brunei Darussalam' , 'Brunei'],
        ['bg' , 'Bułgaria' , 'Bulgaria' , 'Bulgarien'],
        ['bf' , 'Burkina Faso' , 'Burkina Faso' , 'Burkina Faso'],
        ['bi' , 'Burundi' , 'Burundi' , 'Burundi'],
        ['cl' , 'Chile' , 'Chile' , 'Chile'],
        ['cn' , 'Chiny' , 'China' , 'Republik China'],
        ['hr' , 'Chorwacja' , 'Croatia' , 'Kroatien'],
        ['cy' , 'Cypr' , 'Cyprus' , 'Zypern'],
        ['td' , 'Czad' , 'Chad' , 'Tschad'],
        ['me' , 'Czarnogóra' , 'Montenegro' , 'Montenegro'],
        ['cz' , 'Czechy' , 'Czech Republic' , 'Tschechien'],
        ['dk' , 'Dania' , 'Denmark' , 'Dänemark'],
        ['cd' , 'Demokratyczna Republika Konga' , 'Congo' , 'Kongo, Republik'],
        ['dm' , 'Dominika' , 'Dominica' , 'Dominica'],
        ['do' , 'Dominikana' , 'Dominican Republic' , 'Dominikanische Republik'],
        ['dj' , 'Dżibuti' , 'Djibouti' , 'Dschibuti'],
        ['eg' , 'Egipt' , 'Egypt' , 'Ägypten'],
        ['ec' , 'Ekwador' , 'Ecuador' , 'Ecuador'],
        ['er' , 'Erytrea' , 'Eritrea' , 'Eritrea'],
        ['ee' , 'Estonia' , 'Estonia' , 'Estland'],
        ['et' , 'Etiopia' , 'Ethiopia' , 'Äthiopien'],
        ['fj' , 'Fidżi' , 'Fiji' , 'Fidschi'],
        ['ph' , 'Filipiny' , 'Philippines' , 'Philippinen'],
        ['fi' , 'Finlandia' , 'Finland' , 'Finnland'],
        ['fr' , 'Francja' , 'France' , 'Frankreich'],
        ['ga' , 'Gabon' , 'Gabon' , 'Gabun'],
        ['gm' , 'Gambia' , 'Gambia' , 'Gambia'],
        ['gh' , 'Ghana' , 'Ghana' , 'Ghana'],
        ['gr' , 'Grecja' , 'Greece' , 'Griechenland'],
        ['gd' , 'Grenada' , 'Grenada' , 'Grenada'],
        ['ge' , 'Gruzja' , 'Georgia' , 'Georgien'],
        ['gy' , 'Gujana' , 'Guyana' , 'Guyana'],
        ['gt' , 'Gwatemala' , 'Guatemala' , 'Guatemala'],
        ['gn' , 'Gwinea' , 'Guinea' , 'Guinea'],
        ['gw' , 'Gwinea Bissau' , 'Guinea-Bissau' , 'Guinea-Bissau'],
        ['gq' , 'Gwinea Równikowa' , 'Equatorial Guinea' , 'Äquatorialguinea'],
        ['ht' , 'Haiti' , 'Haiti' , 'Haiti'],
        ['es' , 'Hiszpania' , 'Spain' , 'Spanien'],
        ['nl' , 'Holandia' , 'Netherlands' , 'Königreich der Niederlande'],
        ['hn' , 'Honduras' , 'Honduras' , 'Honduras'],
        ['in' , 'Indie' , 'India' , 'Indien'],
        ['id' , 'Indonezja' , 'Indonesia' , 'Indonesien'],
        ['iq' , 'Irak' , 'Iraq' , 'Irak'],
        ['ir' , 'Iran' , 'Iran' , 'Iran'],
        ['ie' , 'Irlandia' , 'Ireland' , 'Irland'],
        ['im' , 'Islandia' , 'Isle of Man' , 'Island'],
        ['il' , 'Izrael' , 'Israel' , 'Israel'],
        ['jm' , 'Jamajka' , 'Jamaica' , 'Jamaika'],
        ['jp' , 'Japonia' , 'Japan' , 'Japan'],
        ['ye' , 'Jemen' , 'Yemen' , 'Jemen'],
        ['jo' , 'Jordania' , 'Jordan' , 'Jordanien'],
        ['kh' , 'Kambodża' , 'Cambodia' , 'Kambodscha'],
        ['cm' , 'Kamerun' , 'Cameroon' , 'Kamerun'],
        ['ca' , 'Kanada' , 'Canada' , 'Kanada'],
        ['qa' , 'Katar' , 'Qatar' , 'Katar'],
        ['kz' , 'Kazachstan' , 'Kazakhstan' , 'Kasachstan'],
        ['ke' , 'Kenia' , 'Kenya' , 'Kenia'],
        ['kg' , 'Kirgistan' , 'Kyrgyzstan' , 'Kirgisistan'],
        ['ki' , 'Kiribati' , 'Kiribati' , 'Kiribati'],
        ['co' , 'Kolumbia' , 'Colombia' , 'Kolumbien'],
        ['km' , 'Komory' , 'Comoros' , 'Komoren'],
        ['cg' , 'Kongo' , 'Congo' , 'Kongo, Demokratische Republik'],
        ['kr' , 'Korea Południowa' , 'Korea, Republic of' , 'Korea, Süd'],
        ['kp' , 'Korea Północna' , 'Korea, Democratic People`s Republic of' , 'Korea, Nord'],
        ['cr' , 'Kostaryka' , 'Costa Rica' , 'Costa Rica'],
        ['cu' , 'Kuba' , 'Cuba' , 'Kuba'],
        ['kw' , 'Kuwejt' , 'Kuwait' , 'Kuwait'],
        ['la' , 'Laos' , 'Lao People`s Democratic Republic' , 'Laos'],
        ['ls' , 'Lesotho' , 'Lesotho' , 'Lesotho'],
        ['lb' , 'Liban' , 'Lebanon' , 'Libanon'],
        ['lr' , 'Liberia' , 'Liberia' , 'Liberia'],
        ['ly' , 'Libia' , 'Libyan Arab Jamahiriya' , 'Libyen'],
        ['li' , 'Liechtenstein' , 'Liechtenstein' , 'Liechtenstein'],
        ['lt' , 'Litwa' , 'Lithuania' , 'Litauen'],
        ['lu' , 'Luksemburg' , 'Luxembourg' , 'Luxemburg'],
        ['lv' , 'Łotwa' , 'Latvia' , 'Lettland'],
        ['mk' , 'Macedonia' , 'Macedonia' , 'Mazedonien'],
        ['mg' , 'Madagaskar' , 'Madagascar' , 'Madagaskar'],
        ['mw' , 'Malawi' , 'Malawi' , 'Malawi'],
        ['mv' , 'Malediwy' , 'Maldives' , 'Malediven'],
        ['my' , 'Malezja' , 'Malaysia' , 'Malaysia'],
        ['ml' , 'Mali' , 'Mali' , 'Mali'],
        ['mt' , 'Malta' , 'Malta' , 'Malta'],
        ['ma' , 'Maroko' , 'Morocco' , 'Marokko'],
        ['mr' , 'Mauretania' , 'Mauritania' , 'Mauretanien'],
        ['mu' , 'Mauritius' , 'Mauritius' , 'Mauritius'],
        ['mx' , 'Meksyk' , 'Mexico' , 'Mexiko'],
        ['fm' , 'Mikronezja' , 'Micronesia' , 'Mikronesien'],
        ['md' , 'Mołdawia' , 'Moldova' , 'Moldawien'],
        ['mc' , 'Monako' , 'Monaco' , 'Monaco'],
        ['mn' , 'Mongolia' , 'Mongolia' , 'Mongolei'],
        ['mz' , 'Mozambik' , 'Mozambique' , 'Mosambik'],
        ['na' , 'Namibia' , 'Namibia' , 'Namibia'],
        ['nr' , 'Nauru' , 'Nauru' , 'Nauru'],
        ['np' , 'Nepal' , 'Nepal' , 'Nepal'],
        ['de' , 'Niemcy' , 'Germany' , 'Deutschland'],
        ['ne' , 'Niger' , 'Niger' , 'Niger'],
        ['ng' , 'Nigeria' , 'Nigeria' , 'Nigeria'],
        ['ni' , 'Nikaragua' , 'Nicaragua' , 'Nicaragua'],
        ['no' , 'Norwegia' , 'Norway' , 'Norwegen'],
        ['nz' , 'Nowa Zelandia' , 'New Zealand' , 'Neuseeland'],
        ['om' , 'Oman' , 'Oman' , 'Oman'],
        ['pk' , 'Pakistan' , 'Pakistan' , 'Pakistan'],
        ['pw' , 'Palau' , 'Palau' , 'Palau'],
        ['pa' , 'Panama' , 'Panama' , 'Panama'],
        ['pg' , 'Papua-Nowa Gwinea' , 'Papua New Guinea' , 'Papua-Neuguinea'],
        ['py' , 'Paragwaj' , 'Paraguay' , 'Paraguay'],
        ['pe' , 'Peru' , 'Peru' , 'Peru'],
        ['pl' , 'Polska' , 'Poland' , 'Polen'],
        ['pt' , 'Portugalia' , 'Portugal' , 'Portugal'],
        ['za' , 'Republika Południowej Afryki' , 'South Africa' , 'Südafrika'],
        ['cf' , 'Republika Środkowoafrykańska' , 'Central African Republic' , 'Zentralafrikanische Republik'],
        ['cv' , 'Republika Zielonego Przylądka' , 'Cape Verde' , 'Kap Verde'],
        ['ru' , 'Rosja' , 'Russian Federation' , 'Russland'],
        ['ro' , 'Rumunia' , 'Romania' , 'Rumänien'],
        ['rw' , 'Rwanda' , 'Rwanda' , 'Ruanda'],
        ['kn' , 'Saint Kitts i Nevis' , 'Saint Kitts and Nevis' , 'St. Kitts und Nevis'],
        ['lc' , 'Saint Lucia' , 'Saint Lucia' , 'St. Lucia'],
        ['vc' , 'Saint Vincent i Grenadyny' , 'Saint Vincent and the Grenadines' , 'St. Vincent und die Grenadinen'],
        ['sv' , 'Salwador' , 'El Salvador' , 'El Salvador'],
        ['ws' , 'Samoa' , 'Samoa' , 'Samoa'],
        ['sm' , 'San Marino' , 'San Marino' , 'San Marino'],
        ['sn' , 'Senegal' , 'Senegal' , 'Senegal'],
        ['rs' , 'Serbia' , 'Serbia' , 'Serbien'],
        ['sc' , 'Seszele' , 'Seychelles' , 'Seychellen'],
        ['sl' , 'Sierra Leone' , 'Sierra Leone' , 'Sierra Leone'],
        ['sg' , 'Singapur' , 'Singapore' , 'Singapur'],
        ['sk' , 'Słowacja' , 'Slovakia' , 'Slowakei'],
        ['si' , 'Słowenia' , 'Slovenia' , 'Slowenien'],
        ['so' , 'Somalia' , 'Somalia' , 'Somalia'],
        ['lk' , 'Sri Lanka' , 'Sri Lanka' , 'Sri Lanka'],
        ['us' , 'Stany Zjednoczone' , 'United States' , 'Vereinigte Staaten'],
        ['sz' , 'Suazi' , 'Swaziland' , 'Swasiland'],
        ['sd' , 'Sudan' , 'Sudan' , 'Sudan'],
        ['sr' , 'Surinam' , 'Suriname' , 'Suriname'],
        ['sy' , 'Syria' , 'Syrian Arab Republic' , 'Syrien'],
        ['ch' , 'Szwajcaria' , 'Switzerland' , 'Schweiz'],
        ['se' , 'Szwecja' , 'Sweden' , 'Schweden'],
        ['tj' , 'Tadżykistan' , 'Tajikistan' , 'Tadschikistan'],
        ['th' , 'Tajlandia' , 'Thailand' , 'Thailand'],
        ['tz' , 'Tanzania' , 'Tanzania' , 'Tansania'],
        ['tl' , 'Timor Wschodni' , 'Timor-Leste' , 'Osttimor / Timor-Leste'],
        ['tg' , 'Togo' , 'Togo' , 'Togo'],
        ['to' , 'Tonga' , 'Tonga' , 'Tonga'],
        ['tt' , 'Trynidad i Tobago' , 'Trinidad and Tobago' , 'Trinidad und Tobago'],
        ['tn' , 'Tunezja' , 'Tunisia' , 'Tunesien'],
        ['tr' , 'Turcja' , 'Turkey' , 'Türkei'],
        ['tm' , 'Turkmenistan' , 'Turkmenistan' , 'Turkmenistan'],
        ['tv' , 'Tuvalu' , 'Tuvalu' , 'Tuvalu'],
        ['ug' , 'Uganda' , 'Uganda' , 'Uganda'],
        ['ua' , 'Ukraina' , 'Ukraine' , 'Ukraine'],
        ['uy' , 'Urugwaj' , 'Uruguay' , 'Uruguay'],
        ['uz' , 'Uzbekistan' , 'Uzbekistan' , 'Usbekistan'],
        ['vu' , 'Vanuatu' , 'Vanuatu' , 'Vanuatu'],
        ['va' ,'Watykan' , 'Vatican' , 'Vatikan'],
        ['ve' , 'Wenezuela' , 'Venezuela' , 'Venezuela'],
        ['hu' , 'Węgry' , 'Hungary' , 'Ungarn'],
        ['gb' , 'Wielka Brytania' , 'United Kingdom' , 'Großbritannien'],
        ['vn' , 'Wietnam' , 'Viet Nam' , 'Vietnam'],
        ['it' , 'Włochy' , 'Italy' , 'Italien'],
        ['ci' , 'Wybrzeże Kości Słoniowej' , 'Côte d`Ivoire' , 'Elfenbeinküste'],
        ['mh' , 'Wyspy Marshalla' , 'Marshall Islands' , 'Marshallinseln'],
        ['sb' , 'Wyspy Salomona' , 'Solomon Islands' , 'Salomonen'],
        ['st' , 'Wyspy Świętego Tomasza i Książęca' , 'Sao Tome and Principe' , 'Sao Tomé und Príncipe'],
        ['zm' , 'Zambia' , 'Zambia' , 'Sambia'],
        ['zw' , 'Zimbabwe' , 'Zimbabwe' , 'Zimbabwe'],
        ['ae' ,'Zjednoczone Emiraty Arabskie' ,'United Arab Emirates' , 'Vereinigte Arabische Emirate']
      ];

      $insertArr = [];
      foreach( $countries as $c )
      {
        $insertArr[] = [
          'iso' => $c[0],
          'pl' => $c[1],
          'en' => $c[2],
          'de' => $c[3]
        ];
      }

      DB::table('countries')->delete();

      DB::table('countries')->insert( $insertArr );
    }
}
