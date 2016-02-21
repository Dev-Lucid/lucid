<?php

class lucid_controller_compiler extends lucid_controller
{
    function javascript()
    {
        ob_clean();
        header('Content-Type: text/javascript');
        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
        include(lucid::$paths['config'].'/js.php');

    }
}
