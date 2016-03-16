<?php
global $parser, $content;
include(__DIR__.'/../../../../bootstrap.php');

$parser = new Parsedown();
$parser->setBreaksEnabled(false);
$page = (isset($_REQUEST['page']))?$_REQUEST['page']:'start';
$content = [
    'nav1'=>'',
    'nav2'=>'',
    'page'=>'',
];
$content['page'] = build_doc($page);

function build_doc($page)
{
    global $parser, $content;
    $paths = [__DIR__.'/../../../../docs', __DIR__.'/../docs', ];
    $replaces = [
        '{{card-end}}'=>'</div></div>',
        '{{card-list-end}}'=>'</ul></div>',
        '{{navbar-end}}'=>'</ul></nav>',
        'href="!'=>'href="index.php?page=',
    ];

    $final_file_path = null;
    foreach($paths as $path)
    {
        $test_path = $path.'/'.$page.'.md';
        if(file_exists($test_path) && is_null($final_file_path) === true)
        {
            $final_file_path = $test_path;
        }
    }

    if(is_null($final_file_path) === true)
    {
        throw new Exception('Could not find page: '.$page);
    }

    $html = $parser->text(file_get_contents($final_file_path));

    # strip the start/end <p> tags that parsedown puts in >_<;
    #

    foreach($replaces as $key=>$value)
    {
        $html = str_replace($key, $value, $html);
    }

    # first do all includes
    preg_match_all('/{{include (..+)}}/', $html, $matches);
    for($i=0; $i<count($matches[1]); $i++)
    {
        $file = $matches[1][$i];
        $html = str_replace('{{include '.$file.'}}', build_doc($file), $html);
    }

    preg_match_all('/{{([^\\s\\\\]+) (.+?)}}/', $html, $matches);
    for($i=0; $i<count($matches[1]); $i++)
    {
        $action = $matches[1][$i];
        $value  = $matches[2][$i];
        switch($action)
        {
            case 'warning':
            case 'info':
            case 'danger':
                $html = str_replace('{{'.$action.' '.$value.'}}', '<div class="alert alert-'.$action.'"><strong>'.ucwords($action).': </strong> '.$value.'</div>', $html);
                break;
            case 'navbar-start':
                $html = str_replace('{{'.$action.' '.$value.'}}', '<nav class="navbar navbar-light bg-faded navbar-fixed-top"><a class="navbar-brand" href="!start">'.$value.'</a><ul class="nav navbar-nav">', $html);
                $html = str_replace('<a href=', '<li class="nav-item"><a class="nav-link" href=', $html);
                $html = str_replace('</a>', '</a></li>', $html);
                break;
            case 'card-list-start':
                $html = str_replace('{{'.$action.' '.$value.'}}', '<div class="card"><div class="card-header">'.$value.'</div><ul class="list-group list-group-flush">', $html);
                $html = str_replace('<a href=', '<li class="list-group-item"><a href=', $html);
                $html = str_replace('</a>', '</a></li>', $html);
                break;
            case 'card-start':
                $html = str_replace('{{'.$action.' '.$value.'}}', '<div class="card"><div class="card-header">'.$value.'</div><div class="card-block">', $html);
                break;
            case 'nav1':
            case 'nav2':
                $html = str_replace('{{'.$action.' '.$value.'}}', '', $html);
                $content[$action] = build_doc($value);
                break;
        }
    }
    $html = str_replace("<p>\n</p>",'', $html);
    if(strpos($html, '<p>') === 0)
    {
        $html = substr($html, 3, -4);
    }
    return $html;
}

?><!DOCTYPE html>
<html lang="en">
    <head>
        <title>Documentation</title>
        <style type="text/css">
        <?=file_get_contents(__DIR__.'/../../../twbs/bootstrap/dist/css/bootstrap.css')?>

        pre{
            background-color: #f9f9f9;
            border: #ddd 1px solid;
            border-width: 1px 1px 1px 3px;
            border-color: #e1e1e1 #e1e1e1 #e1e1e1 #bbb;
            padding: 6px 8px;
        }

        table {
            border: #ccc 1px solid;
            width: 80%;
            margin-bottom: 40px;
        }
        table > tbody > tr > td, table > thead > tr > th {
            border: #ccc 1px solid;
            padding: 2px 5px;
        }
        table > thead > tr > th {
            font-weight: bold;
            background-color: #eee;
        }
        table > thead > tr > th:first-child {
            width: 20%;
        }
        </style>
    </head>
    <body style="padding-top:62px;">
        <?=$content['nav1']?>
        <div class="container-fluid">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-2">
                <?=$content['nav2']?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 col-xl-10">
                <?=$content['page']?>
            </div>
        </div>
    </body>
</html>