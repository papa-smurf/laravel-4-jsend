<?php namespace Papasmurf\JSend;

use Config;
use Response;

/**
 * JSend, simple standard JSON response
 *
 *  JSend is a specification that lays down some rules for how
 *  JSON responses from web servers should be formatted.
 *  
 *  "JSend focuses on application-level (as opposed to protocol- or transport-level)
 *  messaging which makes it ideal for use in REST-style applications and APIs." - by OmniTI Labs
 */
class JSend
{
	private $success = '';
	private $fail = '';
	private $error = '';

	/**
	 * Fetch status string
	 *
	 * @return void
	 */
	public function __construct()
	{
		$statusTypes = Config::get('JSend::status');

		$this->success = $statusTypes['success'];
		$this->fail 	= $statusTypes['fail'];
		$this->error 	= $statusTypes['error'];
	}

	/**
	 * Success!
	 *
	 * @return Jsend
	 */
	public function success($data = [])
	{
		return $this->respond($this->success, $data);
	}

	/**
	 * Something went wrong because of a user dependent error!
	 *
	 * @return Jsend
	 */
	public function fail($data = [])
	{
		return $this->respond($this->fail, $data);
	}

	/**
	 * Something went wrong because of a server generated error
	 *
	 * @return Jsend
	 */
	public function error($message, $data = [], $code = null)
	{
		return $this->respond($this->error, $data, $message, $code);
	}

	/**
	 * Send a JSend standardized API response
	 *
	 * @param 	string $status 		Response status (success, fail = user error, error = server side error)
	 * @param 	array|object $data  Additional response data
	 *
	 * @return 	void
	 */
	private static function respond($status, $data = [], $message = null, $code = null)
	{
		$data = (object) $data;

		return Response::json([
			'status'	=> $status,
			'data'		=> $data ?: '',
			'message'	=> $message ?: '',
			'code'		=> $code ?: ''
		]);
	}
}