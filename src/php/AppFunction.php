<?php

function app(string $index=null, ...$parameters)
{
    if (is_null($index) === true) {
        return Lucid\Lucid::$app;
    }

    $value = Lucid\Lucid::$app->get($index);

    return $value;
}
