<?php

class JLLoader {

	private $prefixes = array();
	
	private function registerObject($className, $path) {
		if (class_exists($className)) {
			return true;
		}
		
		$prefixes[] = "JL";
		
		foreach ($prefixes as $prefix) {
			if (strpos($className,$prefix) === false) {
				return;
			}
			$class = strtolower(substr($className,strlen($prefix)));
		}
		
		$fn = $path.$class.'.class.php';
		
		if (!file_exists($path))
		{
			return false;
		}
		include $fn;
	}
	
	static function registerClass($className)
	{
		$path = JPATH_COMPONENT . DS . 'l' . DS . 'objects' . DS;

		$this->registerObject($className, $path);
	}
	
	
	static function registerService($className)
	{
		$path = JPATH_COMPONENT . DS . 'services' . DS;
	
		$this->registerObject($className, $path);
	}

	static function registerUtils($className)
	{
		$path = JPATH_COMPONENT . DS . 'libraries' . DS . 'util' . DS;
	
		$this->registerObject($className, $path);
	}
}

spl_autoload_register(array('JLLoader','registerClass'));
spl_autoload_register(array('JLLoader','registerService'));
spl_autoload_register(array('JLLoader','registerUtils'));
