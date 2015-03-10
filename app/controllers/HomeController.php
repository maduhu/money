<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}


	/*
	 method to deal with money
	*/

	 public function tigo()
	 {
	 	//capture variables
	 	$data = Input::all();
		$phone = $data["from"];
		$body  = $data["body"];
		$time  = $data["time"];

		//explode body
		$pieces = explode(" ", $body);

		//extract requred variables
		$new_amount = str_replace(",","",chop($pieces[4],'.'));
		$amount = str_replace(",","",$pieces[7]);
		$sndr_name = $pieces[10]." ".chop($pieces[11],',');
		$sndr_phone = chop($pieces[12],'.');
		$date = $pieces[13];
		$time = $pieces[14];
		$time_period = chop($pieces[15],',');
		$reffernce_no = chop($pieces[18],'.');	

		//insert into table Tigopesa
		$t = New Tigopesa;
		$t->new_balance = $new_amount;
		$t->amount = $amount;
		$t->name = $sndr_name;
		$t->phone = $sndr_phone;
		$t->date = $date;
		$t->time_sent = $time;
		$t->time_period = $time_period;
		$t->refference_number = $reffernce_no;
		$t->save();
		var_dump($t);
	}
}
