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
        return str_replace(lucid::$paths['base'], '', $error['file']).'#'.$error['line'].': '.$error['message'];
    }

    public function throwError($message)
    {
        $backtrace = debug_backtrace()[0];
        lucid::$logger->error(str_replace(lucid::$paths['base'], '', $backtrace['file']).'#'.$backtrace['line'].': '.$message);
        throw new Exception\Silent();
    }

    public function shutdown()
    {
        $error = error_get_last();

        if (is_null($error) === false) {
            try {
                lucid::$error->handle($error);

            } catch (Exception $e) {
                exit(print_r($error, true));
            }
        }
    }

    public function handle($e, bool $sendMessage=true)
    {
        $msg = lucid::$error->buildErrorString($e);
        lucid::$logger->error($msg);
        if (lucid::$stage === 'development') {
            lucid::$response->error($msg);
        } else {
            lucid::$response->error(_(lucid::$error_phrase));
        }
        if ($sendMessage === true) {
            lucid::$response->send();
        }
    }

    public function notFound($data, string $replaceSelector = '#body')
    {
        if ($data === false) {
            lucid::$mvc->view('error_data_not_found', ['replaceSelector'=>$replaceSelector]);
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
