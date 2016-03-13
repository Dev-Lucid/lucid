<?php

namespace DevLucid;

interface i_lucid_error
{
    public function build_error_string($e);
    public function shutdown();
    public function handle($e, $send_message);
    public function not_found($data);
    public function permission_denied($replace_selector);
    public function login_required($replace_selector);
}

class lucid_error implements i_lucid_error
{
    public function __construct()
    {
        register_shutdown_function([$this, 'shutdown']);
    }

    public function build_error_string($e)
    {
        # transform the exception object into an array if necessary. This lets this code be called from
        # either a catch or a shutdown function
        $error = null;
        if (is_array($e) === false) {
            $array_error = [];
            $array_error['type'] = $e->getCode();
            $array_error['file'] = $e->getFile();
            $array_error['line'] = $e->getLine();
            $array_error['message'] = $e->getMessage();
            $error = $array_error;
        } else {
            $error = $e;
        }
        return $error['message'].' on line '.$error['line'].' in '.$error['file'];
    }

    public function shutdown()
    {
        $error = error_get_last();

        if (!is_null($error)) {
            try {
                lucid::$error->handle($error);
                lucid::$response->send();
            } catch (Exception $e) {
                exit(print_r($error,true));
            }
        }
    }

    public function handle($e, $send_message=true)
    {
        $msg = lucid::$error->build_error_string($e);
        lucid::$logger->error($msg);
        if ($send_message === true) {
            if (lucid::$stage === 'development') {
                lucid::$response->error($msg);
            } else {
                lucid::$response->error(_(lucid::$error_phrase));
            }
        }
    }

    public function not_found($data, $replace_selector = '#body')
    {
        if ($data === false) {
            lucid::view('error_data_not_found', ['replace_selector'=>$replace_selector]);
            throw new Lucid_Silent_Exception('Data not found');
        }
    }

    public function permission_denied($replace_selector = '#body')
    {
        lucid::view('error_permission_denied', ['replace_selector'=>$replace_selector]);
        throw new Lucid_Silent_Exception('Permission denied');
    }

    public function login_required($replace_selector = '#body')
    {
        lucid::view('error_login_required', ['replace_selector'=>$replace_selector]);
        throw new Lucid_Silent_Exception('Login required');
    }
}

class Lucid_Silent_Exception extends \Exception
{

}
