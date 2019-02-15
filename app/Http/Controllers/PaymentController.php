<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Option;
use App\Song;
use App\User;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;

class PaymentController extends Controller
{
	public function __construct()
	{
			\Conekta\Conekta::setApiKey(env('CONEKTA_SECRET_KEY'));
			\Conekta\Conekta::setApiVersion("2.0.0");
	}

	//Creando un pago mediante Oxxo.
	public function CreatePayOxxo(Request $request)
	{         
		$options     = Option::all(); 
		$song_id     = $request->song_id;
		$price_knob  = 200;
		$now         = Date::now()->add('12 day');
		$expire      = strtotime($now);
		$user_id     = Auth::user()->id;   

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
					'name'  => "Sergio Garcia",
					'phone' => "5535555637",
					// 'email' => $request->input('email')
					'email' => 'contacto@chekogarcia.com.mx'
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


			
			return response()->json(['success' => true,'message'=>$pS,'code'=>$payment->order_id]);

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


			}       
			
	}

	public function confirmation_paypal(Request $request){

			$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
  $keyval = explode ('=', $keyval);
  if (count($keyval) == 2)
    $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
$req = 'cmd=_notify-validate';
if (function_exists('get_magic_quotes_gpc')) {
  $get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
  if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
    $value = urlencode(stripslashes($value));
  } else {
    $value = urlencode($value);
  }
  $req .= "&$key=$value";
}

// inspect IPN validation result and act accordingly
if (strcmp ($req, "VERIFIED") == 0) {
  // The IPN is verified, process it:
  // check whether the payment_status is Completed
  // check that txn_id has not been previously processed
  // check that receiver_email is your Primary PayPal email
  // check that payment_amount/payment_currency are correct
  // process the notification
  // assign posted variables to local variables
  $item_name = $_POST['item_name'];
  $item_number = $_POST['item_number'];
  $payment_status = $_POST['payment_status'];
  $payment_amount = $_POST['mc_gross'];
  $payment_currency = $_POST['mc_currency'];
  $txn_id = $_POST['txn_id'];
  $receiver_email = $_POST['receiver_email'];
  $payer_email = $_POST['payer_email'];
  // IPN message values depend upon the type of notification sent.
  // To loop through the &_POST array and print the NV pairs to the screen:
  foreach($_POST as $key => $value) {
    echo $key . " = " . $value . "<br>";
  }
} else if (strcmp ($res, "INVALID") == 0) {
  // IPN invalid, log for manual investigation
  echo "The response from IPN was: <b>" .$res ."</b>";
}

// Step 2: POST IPN data back to PayPal to validate
$ch = curl_init('https://ipnpb.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
// In wamp-like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "https://curl.haxx.se/docs/caextract.html" and set
// the directory path of the certificate as shown below:
// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
if ( !($res = curl_exec($ch)) ) {
  // error_log("Got " . curl_error($ch) . " when processing IPN data");
  curl_close($ch);
  exit;
}


			$payment                    = new Payment;
			$payment->order_id          = $item_number;
			$payment->amount            = '32';
			$payment->total             = '23';
			$payment->method            = '234234';
			$payment->status            = '234234';
			$payment->reference         = '234234';
			$payment->expires_at        = '234234';
			$payment->status            = 'pending';
			$payment->song_id           = 1;
			$payment->user_id           = 1;
			$payment->save();

curl_close($ch);			

   
	 
	
			// if ($data->type == 'charge.paid'){
				
			//     $order_id   =  $data->data->object->order_id;
			//     $status     =  $data->data->object->status;
			//     $payment    =  Payment::where('order_id',$order_id)->first();

			//     $payment->status = $status;
			//     $payment->save();


			// }       
			
	}

		
		//Manejo de respuestas
		private function Response($success,$result)
		{
				if($success==0){ $result=$result->getMessage(); } 
				$out = array("type"=>$success,"data"=>$result);
				return view('sweet.testResponse')->with('response',$out); 
		}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Song $song)
	{
		return view('sweet.payment_create')->with('song',$song);
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
	public function show(Payment $payment)
	{
		//
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
