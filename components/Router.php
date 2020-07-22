<?php 

include(ROOT . '/controllers/SiteController.php');

class Router {

	private $routes;

	public function __construct() {
		$routesPath = ROOT. '/components/routes.php';
		$this->routes = include($routesPath);
	}

	private function getURI() {
		if(!empty($_SERVER['REQUEST_URI'])) {
			$url = $_SERVER['REQUEST_URI'];
			$url = trim($url, '/');
			return $url;
		}
		else { 
			return false; 
		}
	}

	public function run() {
		
		if($this->getURI() == true) {
			$uri = $this->getURI();

			foreach($this->routes as $uriPattern => $path) {

            	// Сравниваем $uriPattern и $uri
				if (preg_match("~$uriPattern~", $uri)) {
                // Получаем внутренний путь из внешнего согласно правилу.
					$internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                // Определить контроллер, action, параметры

					$segments = explode('/', $internalRoute);

					$controllerName = array_shift($segments) . 'Controller';
					$controllerName = ucfirst($controllerName);

					$actionName = 'action' . ucfirst(array_shift($segments));

					$parameters = $segments;

                // Подключить файл класса-контроллера
					$controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

					if (file_exists($controllerFile)) {
						include_once($controllerFile);
					}

                // Создать объект, вызвать метод (т.е. action)
					$controllerObject = new $controllerName;
					$result = call_user_func_array(array($controllerObject, $actionName), $parameters);

					if ($result != null) {
						break;
					}
				} 
			} 
		} 
		else {

			$controllerFile = ROOT . '/controllers/SiteController.php';
			include_once($controllerFile);

			$siteControl = new SiteController();
			$siteControl->actionIndex();
		}
	}
}
?>
