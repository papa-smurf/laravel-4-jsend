# Standardized JSON response with JSend

According to OmniTI Labs @ http://labs.omniti.com/jsend:

JSend is a specification that lays down some rules for how JSON responses from web servers should be formatted. JSend focuses on application-level (as opposed to protocol- or transport-level) messaging which makes it ideal for use in REST-style applications and APIs.

## Installation

## Laravel 4.1+

Install this package through Composer by editing your `composer.json` file to require `papasmurf/jsend`.

	"papasmurf/laravel-4-jsend": "dev-master"

Update Composer from the Terminal / Command-line:

    composer update

Once done add the service provider to `app/config/app.php`

    'Papasmurf\JSend\JSendServiceProvider',

After that you are free to add the facade to your list of aliases in `app/config/app.php`

	'JSend' => 'Papasmurf\JSend\Facades\JSend',

All set and done! You can now respond with consistent JSON messages without
having to think of the ideal JSON format..ever!

## Usage

```php

function doStuff()
{
	return JSend::success([
			'redirect' => URL::action('VaultController@index')
		]);
}

function validateStuff()
{
	return JSend::fail([
		'failed' => $validation->failedFields(),
		'message' => $message
	]);
}

try {
	stuff();
} catch (Exception $e) {
	JSend::error('whoops!');	
}

```

## Configuration

The configuration file allows you to change the status type naming of the success,
fail and error responses. Keep in mind though that these are specified in the JSend
specification which means it wouldn't make a lot of sense if yo actually changed those.