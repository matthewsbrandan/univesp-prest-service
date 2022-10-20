<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Area;
use App\Models\User;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
      $owner = User::whereEmail('admin@prestservice.com')->first();

      $areas = collect([
        [
          'slug' => Area::generateSlug('Lovely and cosy apartment'),
          'name' => 'Lovely and cosy apartment',
          'description' => 'Siri\'s latest trick is offering a hands-free TV viewing experience, that will allow consumers to turn on or off their television, change inputs, fast forward.',
          'code' => '85910-110',
          'address' => json_encode([
            'code' => '85910-110',
            'street' => 'Rua Vereador Francisco Galdino de Lima',
            'number' => rand(100, 9999),
            'district' => 'Vila Pioneiro',
            'city' => 'Toledo',
            'state' => 'PR',
            'complement' => null
          ]),
          'image' => 'images/seeder/areas/house.jpg',
          'user_id' => $owner->id
        ],
        [
          'slug' => Area::generateSlug('Single room in the center of the city'),
          'name' => 'Single room in the center of the city',
          'description' => 'As Uber works through a huge amount of internal management turmoil, the company is also consolidating and rationalizing more of its international business.',
          'code' => '59072-470',
          'address' => json_encode([
            'code' => '59072-470',
            'street' => 'Rua Santa Clara',
            'number' => rand(100, 9999),
            'district' => 'Felipe Camarão',
            'city' => 'Natal',
            'state' => 'RN',
            'complement' => null
          ]),
          'image' => 'images/seeder/areas/pool.jpg',
          'user_id' => $owner->id
        ],[
          'slug' => Area::generateSlug('Independent house bedroom kitchen'),
          'name' => 'Independent house bedroom kitchen',
          'description' => 'Music is something that every person has his or her own specific opinion about. Different people have different taste, and various types of music.',
          'code' => '54310-610',
          'address' => json_encode([
            'code' => '54310-610',
            'street' => 'Avenida Zequinha Barreto',
            'number' => rand(100, 9999),
            'district' => 'Prazeres',
            'city' => 'Jaboatão dos Guararapes',
            'state' => 'PE',
            'complement' => null
          ]),
          'image' => 'images/seeder/areas/antalya.jpg',
          'user_id' => $owner->id
        ],[
          'slug' => Area::generateSlug('Zen Gateway with pool and garden'),
          'name' => 'Zen Gateway with pool and garden',
          'description' => 'Fast forward, rewind and more, without having to first invoke a specific skill, or even press a button on their remote.',
          'code' => '59073-290',
          'address' => json_encode([
            'code' => '59073-290',
            'street' => 'Rua Tamirim',
            'number' => rand(100, 9999),
            'district' => 'Planalto',
            'city' => 'Natal',
            'state' => 'RN',
            'complement' => null
          ]),
          'image' => 'images/seeder/areas/tiny-house.jpg',
          'user_id' => $owner->id
        ],[
          'slug' => Area::generateSlug('Cheapest hotels for a luxury vacation'),
          'name' => 'Cheapest hotels for a luxury vacation',
          'description' => 'Today, the company announced it will be combining its rides-on-demand business and UberEATS.',
          'code' => '72314-718',
          'address' => json_encode([
            'code' => '72314-718',
            'street' => 'Área ADE Conjunto 18',
            'number' => rand(100, 9999),
            'district' => 'Samambaia Sul (Samambaia)',
            'city' => 'Brasília',
            'state' => 'DF',
            'complement' => null
          ]),
          'image' => 'images/seeder/areas/air-bnb.jpg',
          'user_id' => $owner->id
        ],[
          'slug' => Area::generateSlug('Cozy Double Room Near Station'),
          'name' => 'Cozy Double Room Near Station',
          'description' => 'Different people have different taste, and various types of music have many ways of leaving an impact on someone.',
          'code' => '58704-133',
          'address' => json_encode([
            'code' => '58704-133',
            'street' => 'Travessa Francisca Maria da Silva',
            'number' => rand(100, 9999),
            'district' => 'Belo Horizonte',
            'city' => 'Patos',
            'state' => 'PB',
            'complement' => null
          ]),
          'image' => 'images/seeder/areas/palm-house.jpg',
          'user_id' => $owner->id
        ]
      ]);

      foreach($areas as $area) Area::create($area);
    }
}
