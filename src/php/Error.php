<?php

namespace DevLucid;

class Error implements ErrorInterface
{
    public function __construct()
    {
        register_shutdown_function([$this, 'shutdown']);
    }

    private function buildErrorString($e): string
    {
        # transform the exception object into an array if necessary. This lets this code be called from
        # either a catch or a shutdown function
        $error = null;
        if (is_array($e) === false) {
            $arrayError = [];
            $arrayError['type'] = $e->getCode();
            $arrayError['file'] = $e->getFile();
            $arrayError['line'] = $e->getLine();
            $arrayError['message'] = $e->getMessage();
            $error = $arrayError;
        } else {
            $error = $e;
        }
        return $error['message'].' on line '.$error['line'].' in '.$error['file'];
    }

    public function shutdown()
    {
        $error = error_get_last();

        if (is_null($error) === false) {
            try {
                lucid::$error->handle($error);
                lucid::$response->send();
            } catch (Exception $e) {
                exit(print_r($error, true));
            }
        }
    }

    public function handle($e, bool $send_message=true)
    {
        $msg = lucid::$error->buildErrorString($e);
        lucid::$logger->error($msg);
        if ($send_message === true) {
            if (lucid::$stage === 'development') {
                lucid::$response->error($msg);
            } else {
                lucid::$response->error(_(lucid::$error_phrase));
            }
        }
    }

    public function notFound($data, string $replace_selector = '#body')
    {
        if ($data === false) {
            lucid::$mvc->view('error_data_not_found', ['replace_selector'=>$replace_selector]);
            throw new Exception\Silent('Data not found');
        }
    }

    public function permissionDenied(string $replace_selector = '#body')
    {
        lucid::$mvc->view('error_permission_denied', ['replace_selector'=>$replace_selector]);
        throw new Exception\Silent('Permission denied');
    }

    public function loginRequired(string $replace_selector = '#body')
    {
        lucid::$mvc->view('error_login_required', ['replace_selector'=>$replace_selector]);
        throw new Exception\Silent('Login required');
    }
}
