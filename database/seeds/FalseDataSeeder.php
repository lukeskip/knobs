<?php

use Illuminate\Database\Seeder;

class FalseDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([

			[
				'name' => 'Paulo Castro',
				'picture' => 'profile-1.jpg',
                'expertice' => 'musician',
                'phone' => '4444444444',
                'summary' => 'Est eiusmod officia cupidatat sint elit irure sunt qui ex anim ea aliqua ad exercitation. Cupidatat minim pariatur sint elit. Qui eu dolor reprehenderit officia culpa aliqua ex sunt amet sint dolore. Adipisicing esse enim duis occaecat incididunt nisi. Culpa qui laboris duis quis fugiat laborum ipsum commodo nulla nostrud ullamco est.',
                'genre'  => 'rock',
                'user_id'  => '1',
                'pricing'  => '800',
                'status'=>'approved'
			],
			[
				'name' => 'Ericka Chávez',
				'picture' => 'profile-2.jpg',
                'expertice' => 'musician',
                'phone' => '4444444444',
                'summary' => 'Velit ex eiusmod sint laborum laboris. Culpa duis consequat ad labore laborum nulla occaecat eu labore pariatur. Sunt laborum consequat enim ipsum aliquip quis sint quis amet. Dolor nulla enim magna do irure ut officia nostrud ullamco in. Anim aliqua occaecat aute dolor quis velit et quis et ex excepteur. Adipisicing ipsum sit nulla esse.',
                'genre'  => 'pop',
                'user_id'  => '2',
                'pricing'  => '1200',
                'status'=>'approved'
			],
            [
				'name' => 'Carlos Vera',
				'picture' => 'profile-3.jpg',
                'expertice' => 'producer',
                'phone' => '4444444444',
                'summary' => 'Consequat irure velit fugiat magna irure elit ex. Non aliquip eu qui esse pariatur in magna irure anim tempor aute in ullamco nostrud. Nulla anim labore quis id velit eu velit esse non enim et reprehenderit.',
                'genre'  => 'metal',
                'user_id'  => '2',
                'pricing'  => '600',
                'status'=>'approved'
			],
            [
				'name' => 'David Reyes',
				'picture' => 'profile-4.jpg',
                'expertice' => 'producer',
                'phone' => '4444444444',
                'summary' => 'Consequat irure velit fugiat magna irure elit ex. Non aliquip eu qui esse pariatur in magna irure anim tempor aute in ullamco nostrud. Nulla anim labore quis id velit eu velit esse non enim et reprehenderit.',
                'genre'  => 'latin',
                'user_id'  => '2',
                'pricing'  => '1000',
                'status'=>'approved'
			],

		]);
    }
}
