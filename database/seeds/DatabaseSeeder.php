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
		$user->name = 'Carlos';
		$user->email = 'critico@correo.com';
		$user->password = bcrypt('willy188');
		$user->save();
		$user->roles()->attach($role_critic->id);

		$user = new User;
		$user->name = 'Perengano';
		$user->email = 'musico@correo.com';
		$user->password = bcrypt('willy188');
		$user->save();
		$user->roles()->attach($role_musician->id);

		$song               = new Song;
        $song->title        = 'Entre Sueños';
        $song->genre        = 'pop';
        $song->link         = 'https://esteesellink.com.mx';
        $song->author       = 'Noche de quiz';
        $song->english      = 1;
        $song->description  = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tortor leo, congue non sagittis sed, sagittis eu sapien. Ut feugiat dapibus suscipit. Ut semper, elit sed ultrices cursus, lorem tellus ultricies dui, ut porta ligula enim a ipsum. Etiam in leo hendrerit, dignissim velit sagittis, vulputate felis.';
        $song->status       = 'paid';
        $song->user_id       = $user->id;
        $song->save();
        
        // Payment test
		$payment = new Payment;
		$payment->order_id = '29384129319';
		$payment->amount = '200';
		$payment->total = '200';
		$payment->method = 'paypal';
		$payment->review_id = '1';
		$payment->user_id = '1';
		$payment->song_id = '1';
		$payment->status = 'paid';
		$payment->save();

		// Payment test
		$payment = new Payment;
		$payment->order_id = '29323349319';
		$payment->amount = '300';
		$payment->total = '300';
		$payment->method = 'paypal';
		$payment->review_id = '1';
		$payment->user_id = '1';
		$payment->song_id = '1';
		$payment->status = 'paid';
		$payment->save();



        // Creamos el option price
		$option = new Option;
		$option->type = 'number';
		$option->label = 'Precio por Knob';
		$option->slug = 'price';
		$option->description = 'Es el precio por cada knob que se le cobra al usuario';
		$option->value = '220';
		$option->save();

		// Creamos el option paypal_mail
		$option = new Option;
		$option->type = 'email';
		$option->label = 'Cuenta de Paypal';
		$option->slug = 'paypal_mail';
		$option->description = 'Es la cuenta paypal a la que estarán relacionados los pagos';
		$option->value = 'contacto-facilitator@chekogarcia.com.mx';
		$option->save();

		// Creamos el option paypal_action
		$option = new Option;
		$option->type = 'text';
		$option->label = 'Form Action paypal';
		$option->slug = 'paypal_action';
		$option->description = 'Es la dirección de paypal a la que se hará el post del pago';
		$option->value = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		$option->save();

		// Creamos el option payment day
		$option = new Option;
		$option->type = 'select';
		$option->label = 'Día de Pago';
		$option->slug = 'payment_day';
		$option->description = 'Es el día en el que se hace el corte de pagos a críticos';
		$option->value = 'thursday';
		$option->options = 'monday,tuesday,wednesday,thursday,friday,saturday,sunday';
		$option->labels = 'Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo';

		$option->save();


		// Creamos el option paypal_action
		$option = new Option;
		$option->type = 'text';
		$option->label = 'Tiempo de caducidad Oxxo';
		$option->slug = 'oxxo_expiration';
		$option->description = 'Tiempo en el que expira el pago de conekta';
		$option->value = '24';
		$option->save();

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
