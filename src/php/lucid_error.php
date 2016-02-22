<?php

class lucid_error
{
    public static function build_error_string($e)
    {
        return $prefix . $e->getMessage().' on line '.$e->getLine().' in '.$e->getFile();
    }

    public static function handle($e, $send_message=true)
    {
        $msg = lucid_error::build_error_string($e);
        lucid::$logger->error($msg);
        if ($send_message === true)
        {
            if (lucid::$stage === 'develfopment')
            {
                lucid::$response->error($msg);
            }
            else
            {
                lucid::$response->error(_(lucid::$error_phrase));
            }
        }
    }
}
