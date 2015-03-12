<?php

namespace Middleware;

class AuthMiddleware extends \Slim\Middleware {
	public function call() {
		$app = $this->app;
		$requireAuth = function() use($app) {
			// Get current route.
           	$route = $app->router->getCurrentRoute();
           	// Redirect to login screen.
           	if(!in_array($route->getName(), array('loginForm') )) {
				if(empty($_SESSION['user_id'])) {
					$app->redirect($app->urlFor('loginForm'));
				}
           	}
		};
        $app->hook('slim.before.dispatch', $requireAuth);
		$this->next->call();
	}
}

?>

