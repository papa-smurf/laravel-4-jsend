# Standardized JSON response with JSend

According to OmniTI Labs @ http://labs.omniti.com/jsend:

JSend is a specification that lays down some rules for how JSON responses from web servers should be formatted. JSend focuses on application-level (as opposed to protocol- or transport-level) messaging which makes it ideal for use in REST-style applications and APIs.

## Laravel (4.2)

### Installation

Install this package through Composer by editing your `composer.json` file to require `papasmurf/laravel-4-jsend`.

	"papasmurf/laravel-4-jsend": "dev-master"

Update Composer from the Terminal / Command-line:

    composer update

Once done add the service provider to `app/config/app.php`

    'Papasmurf\JSend\JSendServiceProvider',

After that you are free to add the facade to your list of aliases in `app/config/app.php`

	'JSend' => 'Papasmurf\JSend\Facades\JSend',

All set and done! You can now respond with consistent JSON messages without
having to think of the ideal JSON format..ever!

### Usage

```php

function doStuff()
{
	return JSend::success([
		'redirect' => URL::action('UsersController@index')
	]);
}

function validateStuff()
{
	return JSend::fail([
		'failed' => $validation->failedFields(),
		'message' => $message
	]);
}

function tryStuff()
{
	try {
		stuff();
	} catch (Exception $e) {
		return JSend::error('whoops!');
	}

	return JSend::success();
}

```

## Standalone

Standalone usage is possible as well and requires a Response object with a json method:

```php

require __DIR__ . '/src/JSend.php';

class Response
{
	public function json($data)
	{
		return json_encode($data);
	}
}

$responder = new Response;
$JSend = new Papasmurf\JSend\JSend($responder);

echo $JSend->success([
    'redirect' => 'mydomain.com/something'
]);

```