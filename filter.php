<?php

class filter_glowscript extends moodle_text_filter
{
    public function filter($text, array $options = array())
    {
        $initJS = file_get_contents(__DIR__.'/init.js');
        $scripts = "
        <script type=\"text/javascript\" src=\"https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML\"></script>
        <script type=\"text/javascript\" src=\"http://www.glowscript.org/lib/jquery/2.1/jquery.min.js\"></script>
        <script type=\"text/javascript\" src=\"http://www.glowscript.org/lib/jquery/2.1/jquery-ui.custom.min.js\"></script>
        <script type=\"text/javascript\" src=\"http://www.glowscript.org/package/glow.2.1.min.js\"></script>
        <script type=\"text/javascript\" src=\"http://www.glowscript.org/package/RSrun.2.1.min.js\"></script>
	";
        echo '<script id="initJS" type="text/javascript">' . $initJS . '</script>';
        $addedScript = false;
        while (strpos($text, "[GS") !== false and strpos($text, "GS]") !== false) {
            if (!$addedScript) {
                $addedScript = true;
                echo $scripts;
            }
            $id = uniqid();
            $partScript = "
        <script type='text/javascript'>
            runJavaScript('#{$id}');
        </script>
        ";
            $replaceOpen = "<glowscript id='{$id}'><textarea style='display: none;'>";
            $replaceClose = "</textarea><div class='GS_figure'></div><div class='GS_errors'></div></glowscript>";
            $text = preg_replace("/[[]GS/", $replaceOpen, $text, 1);
            $text = preg_replace("/GS[]]/", $replaceClose . $partScript, $text, 1);
        }
        return $text;
    }
}
?>
