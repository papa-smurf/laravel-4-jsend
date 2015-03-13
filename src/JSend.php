<?php namespace Papasmurf\JSend;

use Response;

/**
 * 	JSend: The simple standardized JSON response format!
 *
 *  JSend is a specification that lays down some rules for how
 *  JSON responses from web servers should be formatted.
 *  
 *  "JSend focuses on application-level (as opposed to protocol- or transport-level)
 *  messaging which makes it ideal for use in REST-style applications and APIs." - by OmniTI Labs
 */
class JSend
{
	private $responder;
	private $success;
	private $fail;
	private $error;

	/**
	 * Set status representations
	 *
	 * @param 	Response 	$responder 	Response class with a json method
	 *
	 * @return JSend
	 */
	public function __construct(Response $responder)
	{
		$this->responder = $responder;
		$this->success 	= 'success';
		$this->fail 	= 'fail';
		$this->error 	= 'error';
	}

	/**
	 * Success!
	 *
	 * @param 	mixed $data
	 * 
	 * @return 	string
	 */
	public function success($data = [])
	{
		return $this->respond($this->success, $data);
	}

	/**
	 * Something went wrong because of a user dependent error!
	 *
	 * @param mixed $data
	 *
	 * @return string
	 */
	public function fail($data = [])
	{
		return $this->respond($this->fail, $data);
	}

	/**
	 * Something went wrong because of a server generated error
	 *
	 * @param 	string 	$message
	 * @param 	mixed 	$data
	 * @param 	string 	$code Error code
	 *
	 * @return string
	 */
	public function error($message, $data = [], $code = null)
	{
		return $this->respond($this->error, $data, $message, $code);
	}

	/**
	 * Send a JSend standardized API response
	 *
	 * @param 	string 			$status 	Response status (success, fail = user error, error = server side error)
	 * @param 	array|object 	$data  		Additional response data
	 * @param 	string 			$message 	Response message
	 * @param 	string 			$code 		Error code
	 *
	 * @return 	string 	JSend response
	 */
	private function respond($status, $data = [], $message = '', $code = '')
	{
		$data = (object) $data;

		return $this->responder->json([
			'status'	=> $status,
			'data'		=> $data,
			'message'	=> $message,
			'code'		=> $code
		]);
	}
}