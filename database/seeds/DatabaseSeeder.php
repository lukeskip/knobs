<?php

use Illuminate\Database\Seeder;
use App\Song;
use App\User;
use App\Role;
use App\Option;
use App\Payment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$admin_token = str_random(60);
    	$musician_token = str_random(60);
    	$critic_token = str_random(60);
        // check if table users is empty

		DB::table('roles')->insert([

			[
				'name' => 'admin',
				'token' => $admin_token,
			],
			[
				'name' => 'critic',
				'token' => $critic_token,
			],
			[
				'name' => 'musician',
				'token' => $musician_token,
			]

		]);

		$role_admin		= Role::where('name','admin')->first();
		$role_critic 	= Role::where('name','critic')->first();
		$role_musician 	= Role::where('name','musician')->first();

		$user = new User;
		$user->name = 'Sergio';
		$user->email = 'contacto@chekogarcia.com.mx';
		$user->password = bcrypt('Futurama84!');
		$user->save();
		$user->roles()->attach($role_admin->id);

		$user = new User;
		$user->name = 'Cesar';
		$user->email = 'curador@reydecibel.com.mx';
		$user->password = bcrypt('KnbsAntonio23!#');
		$user->save();
		$user->roles()->attach($role_admin->id);

	

        DB::table('categories')->insert([

				[
					'slug' => 'creativity',
					'label' => 'Creatividad',
					'label_en' => 'Creativity',
					'instructions'=>'',
					'type' => 'knob',
					'order' => 1,
					'importance'=> 2,
					'subject' => 'music'
				],
				[
					'slug' => 'lyrics',
					'label' => 'Letra',
					'label_en' => 'Lyrics',
					'instructions'=>'',
					'type' => 'knob',
					'order' => 1,
					'importance'=> 2,
					'subject' => 'music'
				],
				[
					'slug' => 'arrangements',
					'label' => 'Arreglos',
					'label_en' => 'Arrangements',
					'instructions'=>'',
					'type' => 'knob',
					'order' => 1,
					'importance'=> 2,
					'subject' => 'music'
				],
				[
					'slug' => 'recording',
					'label' => 'Grabación',
					'label_en' => 'Recording',
					'instructions'=>'',
					'type' => 'knob',
					'order' => 1,
					'importance'=> 2,
					'subject' => 'music'
				],
				[
					'slug' => 'mix',
					'label' => 'Mezcla',
					'label_en' => 'Mix',
					'instructions'=>'',
					'type' => 'knob',
					'order' => 1,
					'importance'=> 2,
					'subject' => 'music'
				],
				[
					'slug' => 'master',
					'label' => 'Masterización',
					'label_en' => 'Master',
					'instructions'=>'',
					'type' => 'knob',
					'order' => 1,
					'importance'=> 2,
					'subject' => 'music'
				],
				[
					'slug' => 'commercial',
					'label' => 'Potencial Comercial',
					'label_en' => 'Commercial Potencial',
					'instructions'=>'',
					'type' => 'knob',
					'order' => 1,
					'importance'=> 1,
					'subject' => 'music'
				],
				[
					'slug' => 'artistic',
					'label' => 'Potencial Artístico',
					'label_en' => 'Artistic Potencial',
					'instructions'=>'',
					'type' => 'knob',
					'order' => 1,
					'importance'=> 1,
					'subject' => 'music'
				],
				[
					'slug' => 'good',
					'label' => 'Lo bueno',
					'label_en' => 'The good',
					'instructions'=>'Resalta aquello que tiene potencial en la canción, no existe material que no tenga nada de pontencial.',
					'type' => 'textarea',
					'order' => 1,
					'importance'=> 2,
					'subject' => 'music',
					
				],
				[
					'slug' => 'bad',
					'label' => 'Lo malo',
					'label_en' => 'The bad',
					'instructions'=>'A nadie le gusta que le digan cosas malas de sus creaciones así que se respetuoso, firme y directo.',
					'type' => 'textarea',
					'order' => 1,
					'importance'=> 2,
					'subject' => 'music',
					
				],
				[
					'slug' => 'next',
					'label' => 'Qué hacer',
					'label_en' => 'Next Steps',
					'instructions'=>'Diles cómo pueden mejorar, esta es una parte básica y es lo que la banda está esperando de ti, comparte tu experiencia',
					'type' => 'textarea',
					'order' => 1,
					'importance'=> 1,
					'subject' => 'music',	
				],

		]);

		
    }
}
