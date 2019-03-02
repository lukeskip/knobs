<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Option;
use App\Song;
use App\User;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
	public function __construct()
	{
			\Conekta\Conekta::setApiKey(env('CONEKTA_SECRET_KEY'));
			\Conekta\Conekta::setApiVersion("2.0.0");
	}

	//Creando un pago mediante Oxxo.
	public function CreatePayOxxo(Request $request )
	{         

		$options     = Option::all(); 
		$song_id     = $request->song_id;
		$price_knob  = $options->where('slug','price')->first()->value;
		$oxxo_expiration  = $options->where('slug','oxxo_expiration')->first()->value;
		$now         = Date::now()->add($oxxo_expiration.' hours');
		
		$expire      = strtotime($now);
		$user 		 = Auth::user();
		$user_id     = $user->id;   

		$valid_order =
			array(
				'line_items'=> array(
					array(
						'name'        => "Cargo por knob",
						'description' => 'Cargo por crítica de una canción',
						'unit_price'  => $price_knob * 100,//El costo se pasa en centavos
						'quantity'    => 1,
						'metadata' => array(
							'type' => 'natural'
					)
				),  
			),

			'currency'      => 'MXN',
				// 'metadata'    => array('test' => 'extra info'),
			'charges'     => array(
				array(
					'payment_method' => array(
							'type'       => 'oxxo_cash',
							'expires_at' => $expire
					)
					//'amount' => $precio
				)
			),
			'currency'      => 'MXN',
			'customer_info' => array(
					'name'  => $user->name,
					'phone' => "5535555637",
					'email' => $user->email,
			)
		);


		try {
			$order = \Conekta\Order::create($valid_order);
			$pI = $order['id'];
			$pM = $order->charges[0]->payment_method->type;
			$pR = $order->charges[0]->payment_method->reference;
			$pS = $order['payment_status'];

			$rsp = array("id"=>$pI,"method"=>$pM,"reference"=>$pR,"status"=>$pS);
				

			$pI = $order['id'];
			$pM = $order->charges[0]->payment_method->type;
			$pS = $order['payment_status'];
			$pT = $order->amount /100; //Total de la transacción

			// Declaramos las variables que serán ocupadas en los costos
			$pQ    = 0;
			$pUP   = 0;
			$pC    = 0;
			$pQP   = 0;
			$pUPP  = 0;
			
			// asignamos la cantidad de horas y comision
			foreach ($order->line_items as $line) {
				
				$line_type = $line['metadata']['type'];  
				$pQ  = $line->quantity;
				$pUP = $line->unit_price / 100;

				
				
			}

			$pA = (($pUP * $pQ)+($pUPP * $pQP));//cargo sin contar la comision
			
			$pE = $order->charges[0]->payment_method->expires_at;
			// $rsp = array("id"=>$pI,"method"=>$pM,"reference"=>$pR,"status"=>$pS,'price'=>$price);

			$song = Song::find($song_id);
		
			if(!$song->payments){
				$payment                    = new Payment;
				$payment->order_id          = $pI;
				$payment->amount            = $pA;
				$payment->total             = $pT;
				$payment->method            = $pM;
				$payment->status            = $pS;
				$payment->reference         = $pR;
				$payment->expires_at        = $pE;
				$payment->status            = 'pending';
				$payment->song_id           = $song_id;
				$payment->user_id           = $user_id;
				$payment->save();
				
			}else{
				$payment                    = Payment::where('order_id',$song->payments->order_id)->first();
				$payment->order_id          = $pI;
				$payment->amount            = $pA;
				$payment->total             = $pT;
				$payment->method            = $pM;
				$payment->status            = $pS;
				$payment->reference         = $pR;
				$payment->expires_at        = $pE;
				$payment->status            = 'pending';
				$payment->song_id           = $song_id;
				$payment->user_id           = $user_id;
				$payment->save();
				
			}

			return redirect('/payments/'.$payment->order_id);
			

		} catch (\Conekta\ProcessingError $e){ 
			return $this->Response(0,$e);
		} catch (\Conekta\ParameterValidationError $e){
				return $this->Response(0,$e);
		} 
		catch (\Conekta\Handler $e){
				return $this->Response(0,$e);
		}

	}

	public function confirmation(){

			$body = @file_get_contents('php://input');
			$data = json_decode($body);
			http_response_code(200); // Return 200 OK 
	
			if ($data->type == 'charge.paid'){
				
				$order_id   =  $data->data->object->order_id;
				$status     =  $data->data->object->status;
				$payment    =  Payment::where('order_id',$order_id)->first();

				$payment->status = $status;
				$payment->save();


				$user_email = $payment->users->email;
				$this->email_notification($user_email,$_POST['txn_id']);
		
			}       
			
	}

	public function confirmation_paypal(Request $request){
			
	   
	    // read the post from PayPal system and add 'cmd'  
	    $req = 'cmd=_notify-validate';  
	    foreach ($_POST as $key => $value) {  
	    	$value = urlencode(stripslashes($value));  
	    	$req .= "&$key=$value";

	    }
	    Log::info(print_r($_POST,true));  
	    // post back to PayPal system to validate  
	    $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";  
	    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";  
	    $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";  

	    $fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30); 

	    Log::info(print_r($fp,true));

	  
		$status 	= strtolower($_POST['payment_status']);
		if(isset($_POST['order_id'])){
			$order_id 	= $_POST['order_id'];
		}else{
			$order_id 	= $_POST['txn_id'];
		}
		
		$item_number = explode('-',$_POST['item_number']);
		$song_id = $item_number[0];
		$user_id = $item_number[1];

		if($status == 'completed' || $status == 'pending' || $status == 'processed'){
						
			$song = Song::find($song_id);
			if($song->payments){
				$payment = Payment::find($song->payments->id);
				$payment->update(['status' => $status, 'order_id' => $_POST['txn_id'],'method' => 'paypal']);
				return response()->json(['success' => true,'message'=>'Pago fue actualizado exitosamente ']);
			}else{
				$payment                    = new Payment;
				$payment->order_id          = $_POST['txn_id'];
				$payment->amount            = $_POST['mc_gross'];
				$payment->total             = $_POST['mc_gross'];;
				$payment->method            = 'paypal';
				$payment->reference         = $_POST['txn_id'];
				$payment->expires_at        = 'not applies';
				$payment->status            = $status;
				$payment->song_id           = $item_number[0];
				$payment->user_id           = $item_number[1];
				$payment->save();

				return response()->json(['success' => true,'message'=>'Pago fue creado exitosamente ']);
			}
		}else{
			Log::info($status);
			return response()->json(['success' => false,'message'=>'El cargo fue '.$status]);
		}


		if($status == 'completed' ||  $status == 'processed'){
			$user = User::find($user_id);
			$this->email_notification($user->email,$_POST['txn_id']);
		}

		

	     
			
	}

		
	//Manejo de respuestas
	private function Response($success,$result)
	{
			if($success==0){ $result=$result->getMessage(); } 
			$out = array("type"=>$success,"data"=>$result);
			return view('sweet.testResponse')->with('response',$out); 
	}


	//Manejo de notificaciones
	private function email_notification($email)
	{
			// Enviamos recibo de pago a usuario
			sending_mails($email, $subject = 'Tu recibo de pago Knobs',['title' => 'Tu recibo de pago','link' => $link,'message' => 'Tu pago se llevó a cabo correctamente puedes revisarlo en cualquier momento desde tu dashboard o dando click en el siguiente enlace'], $template = 'receipt');

			// Enviamos notificación a los críticos
			$critics =  User::whereHas('roles', function($query){
                  $query->where('name', 'critic');
            })->get();

            foreach ($critics as $critic) {
            	sending_mails($critic->email, $subject = 'Hay una canción esperando crítica, corre antes que te la ganen',$data('title' => 'hay una canción esperando crítica','message' => 'Recuerda que cualquier crítico registrado puede tomarla, así que corre a tu dashboard a hacer la crítica','link' => 'dashboard','link_label'=>'Ir a dashboard'), $template = 'default');
            }

			
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$payments = Payment::orderBy('status','ASC');
		
		if(request()->has('s')){
        	$payments->where('order_id', 'LIKE', '%' . request()->s . '%');
        }
		
		foreach ($payments as $payment) {
			if($payment->songs->reviews()->exists()){
				$payment['partner'] = $payment->songs->reviews->user->email;	
			}else{
				$payment['partner'] = 'En espera de crítica';
			}
			
		}

		$payments = $payments->paginate();

		return view('sweet.payment_list',compact(['payments']));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Song $song)
	{	
		$user_id = Auth::user()->id;
		$options = Option::all();

		if($song->payments){
			return redirect('/payments/'.$song->payments->order_id);
		}
		return view('sweet.payment_create')->with('song',$song)->with('user_id',$user_id)->with('options',$options);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Payment  $payment
	 * @return \Illuminate\Http\Response
	 */
	public function show($order_id)
	{	
		$payment = Payment::where('order_id',$order_id)->first();
		$user = Auth::user();
        if(get_role() != 'admin' && $user->id != $payment->user_id){
            return abort(403, 'Unauthorized action.');
        }
	

		$options = Option::all();
		$user_id = $user->id;
		$payment['finish'] = false;
		$expiration = Date::createFromTimestamp($payment->expires_at);
		$expired    =  false;

		
		$now 		= Date::now();

		if($expiration < $now){
			$expired    =  true;
		}

		$expiration = $expiration->diffForHumans();
		

		if($payment->status == 'paid' || $payment->status == 'processed' || $payment->status == 'complete'){
			$title = 'Tu pago fue recibido correctamente';
			$payment['finish'] = true;
		}elseif($payment->status == 'pending'){
			$title = 'Tu pago está en espera';
		}elseif($payment->status == 'failed' || $payment->status == 'declined'){
			$title = 'Tu pago falló, intenta con otra forma de pago';
		}

		return view('sweet.payment_show',compact('payment','options','user_id','title','expiration','expired'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Payment  $payment
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Payment $payment)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Payment  $payment
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Payment $payment)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Payment  $payment
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Payment $payment)
	{
		//
	}
}
