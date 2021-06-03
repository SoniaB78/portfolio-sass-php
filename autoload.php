<?php
class Autoload{
	public static function className($className){
		require __DIR__ . '/' . str_replace('\\', '/', $className . '.php');
		//str_replace : remplace les anti-slashes par des slashes
	}
}
spl_autoload_register(array('Autoload', 'className'));
//s'execute quand il voit passer le mot "new", (fichier,fonction) -> (Controller/Controller)

?>