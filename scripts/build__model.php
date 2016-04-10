<?php

function modelBuildKeys($keys, $config)
{
    return $keys;
}

function modelBuildFiles($keys, $config)
{
    buildFromTemplate('model', $keys, $config['path'].'/app/model/'.$config['table'].'.php');
}
