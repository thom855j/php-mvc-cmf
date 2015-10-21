<?php
/*
 * Default controller for frontend rendering of views
 * @author Thomas Elvin
 */
// use folllowing classes
namespace App\Http\Controllers;

use WebSupportDK\PHPMvcFramework\Controller;
use App\Exceptions\Handler;

class EmailsController extends Controller
{

	// variable for storing view data
	public $data;

	/**
	 * Construct this object by extending the base Controller class and view
	 */
	public function __construct()
	{
		// construct Controller
		parent::__construct();
		// Parse default data about app
	}

	public function index()
	{
	return redirect(config('router.controller'));
	}

	public function send($email)
	{
		$mail = $this->App->get('Mailer') ; 
		$mail->addAddress($email, 'Hello World!');  

		//$template = get_view('emails/welcome'); 
		$mail->addAttachment(uploaded_file('demo.png'), 'Demo attachment');    // Optional name

		$mail->Subject = 'Here is the subject';
		$mail->Body    = view('emails/demo');
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
    	echo 'Message could not be sent.';
    	echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
    	echo 'Message has been sent';
			}
		}

}
