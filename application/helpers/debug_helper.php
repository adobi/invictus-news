<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if(!function_exists('dump')) {
	
		//function dump($var, $label = null, $echo = true) {
        function dump() {
            $args = func_get_args();
            
            if (!$args) return false;
            
            $count = count($args);
            
            //$label = $args[$count-2];
            //$echo = $args[$count-1];
            
			//$label = ($label === null) ? '' : rtrim($label) . ' ';
			$label = ''; $echo = true;
            foreach ($args as $var) {
                
    			ob_start();
    
    			var_dump($var);
    
    			$output = ob_get_clean();
    
    			$output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
    
    			$output = '<pre>' . $label . $output . '</pre>';
    
    			if($echo) echo $output;
    
            }
            
			return $output;
		}	
	}

?>