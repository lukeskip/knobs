<?php

use Illuminate\Database\Seeder;

class OptionsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('options')->truncate();

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

		// Creamos el option taxes 
		$option = new Option;
		$option->type = 'text';
		$option->label = 'Impuestos';
		$option->slug = 'taxes';
		$option->description = 'Es la cantidad de impuestos que se pagarán por cada transacción en porcentaje';
		$option->value = '16';
		$option->save();

		// Creamos el option critic_share 
		$option = new Option;
		$option->type = 'text';
		$option->label = 'Porcentaje Crítico';
		$option->slug = 'critic_share';
		$option->description = 'Es el porcentaje de ganancias por cada transacción que se le pagará al crítico';
		$option->value = '50';
		$option->save();

		// Creamos el option conekta_commission 
		$option = new Option;
		$option->type = 'text';
		$option->label = 'Comisión Conekta';
		$option->slug = 'conekta_commission';
		$option->description = 'Es la cantidad de comisión en pesos que se le paga a Conekta';
		$option->value = '5';
		$option->save();

		// Creamos el option paypal_commission 
		$option = new Option;
		$option->type = 'text';
		$option->label = 'Comisión Paypal';
		$option->slug = 'paypal_commission';
		$option->description = 'Es la cantidad de comisión en pesos que se le paga a Paypal';
		$option->value = '5';
		$option->save();


		// Creamos el option paypal_action
		$option = new Option;
		$option->type = 'text';
		$option->label = 'Tiempo de caducidad Oxxo';
		$option->slug = 'oxxo_expiration';
		$option->description = 'Tiempo en el que expira el pago de conekta';
		$option->value = '24';
		$option->save();


    }
}
