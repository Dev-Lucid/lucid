<?php

function helperBuildKeys($keys, $config)
{
    return $keys;
}

function helperBuildFiles($keys, $config)
{
    buildFromTemplate('helper', $keys, $config['path'].'/app/helper/'.$config['table'].'.php');
}
