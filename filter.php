<?php
class filter_glowscript extends moodle_text_filter {
    public function filter($text, array $options = array()) {
		
	// Required scripts from official GlowScript website
	$scripts = '
	 <script type="text/javascript"
     src="http://www.glowscript.org/lib/jquery/2.1/jquery.min.js">
     </script>
     <script type="text/javascript"
     src="http://www.glowscript.org/lib/jquery/2.1/jquery-ui.custom.min.js">
     </script>
     <script type="text/javascript"
     src="http://www.glowscript.org/package/glow.2.1.min.js">
     </script>
	';
		
	$addedScript = false;
	// Creating unique value to use it as id attribute for <div> tag which we will use as a container for script results
    $id = uniqid();
	// Put container declaration as a string in var	
    $target = "window.__context = {glowscript_container: $('#" . $id . "').removeAttr('id')};";
		
	// Checking if we have open and close GS filter 	
	while(strpos($text,"[GS") !== false and strpos($text,"GS]") !== false){
		// If we didn't add required scripts	
		if (!$addedScript)
		{
			$addedScript = true;
			echo $scripts;	
		}
		// Replacing text
		$replace = "<div id='" . $id . "'></div><script type='text/javascript'>" . $target;
		$text = preg_replace("/[[]GS/", $replace, $text, 1);
		$text = preg_replace("/GS[]]/", "</script>", $text, 1);
		}

    return $text;
    }
}
?>