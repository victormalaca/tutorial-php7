<?php
require 'vendor/autoload.php';
// Create and configure Slim app
$app = new \Slim\App();

// Define app routes
$app->get('/hello/{name}', function ($request, $response, $args) {
	return $response->write ( "Hello " . ucfirst($args['name']) . "!" );
} );

// Run app
$app->run();