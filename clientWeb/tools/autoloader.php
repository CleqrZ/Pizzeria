<?php

// fonction de chargement automatique des fichiers
function includeFileWithClassName($class_name)
{
	// répertoires contenant les classes
	$directorys = array(
		'DAO/',
		'DTO/',
		'tools/'
	);
   
	// pour chaque répertoire
	foreach($directorys as $directory) {
		// si le fichier existe
		if(file_exists($directory.$class_name . '.php')) {
			require_once($directory.$class_name . '.php');
			return;
		}   
		else if(file_exists('../' . $directory.$class_name . '.php')) {
			require_once('../' . $directory.$class_name . '.php');
			return;				
		}			
	}
}

// enregistrement de la fonction de chargement automatique des fichiers
spl_autoload_register('includeFileWithClassName');

?>