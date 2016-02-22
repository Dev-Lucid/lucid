<?php

interface i_lucid_error
{
    public static function shutdown();
    public static function handle($e, $send_message);
}

class lucid_error implements i_lucid_error
{
    private static function build_error_string($e)
    {
        # transform the exception object into an array if necessary. This lets this code be called from
        # either a catch or a shutdown function
        $error = null;
        if (!is_array($e))
        {
            $array_error = [];
            $array_error['type'] = $e->getCode();
            $array_error['file'] = $e->getFile();
            $array_error['line'] = $e->getLine();
            $array_error['message'] = $e->getMessage();
            $error = $array_error;
        }
        else
        {
            $error = $e;
        }
        return $error['message'].' on line '.$error['line'].' in '.$error['file'];
    }

    public static function shutdown()
    {
        $error = error_get_last();

        if (!is_null($error))
        {
            try
            {
                lucid::$error->handle($error);
                lucid::$response->send();
            }
            catch(Exception $e)
            {
                exit(print_r($error,true));
            }
        }
    }

    public static function handle($e, $send_message=true)
    {
        $msg = lucid_error::build_error_string($e);
        lucid::$logger->error($msg);
        if ($send_message === true)
        {
            if (lucid::$stage === 'development')
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
