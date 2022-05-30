<?php
	use \Core\Route;
	//Массив путей, по которым будет определятся контроллер и его метод.
	//Наппример обьект Route('/list', 'list', 'show') определяет что
	//если пользователь перешел по ссылке ввида "https:yourhost/list",
	//значит надо вызывать метод show контроллера ListController.
	return [
		new Route('', 'list', 'show'),
		new Route('/list', 'list', 'show'),
		new Route('/conf/create', 'conf', 'create'),
		new Route('/conf/delete', 'conf', 'delete'),
		new Route('/conf/show/:id', 'conf', 'show'),
		new Route('/conf/show', 'conf', 'show'),
		new Route('/conf/change/:id', 'conf', 'change'),
		new Route('/conf/change', 'conf', 'change'),
	];
	
