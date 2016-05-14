<?php
include(__DIR__.'/../vendor/autoload.php');

global $file;
$file = $_REQUEST['file'] ?? 'index';
$todo     = $_REQUEST['todo'] ?? 'view';

$lucidPath = '/../vendor/dev-lucid/lucid/docs/';
$fixedFile = str_replace('lucid/', $lucidPath, $file);
$filePath = __DIR__.'/'.$fixedFile.'.md';

if ($todo == 'save') {
    file_put_contents($filePath, $_REQUEST['content']);
    header('Location: '.basename(__FILE__).'?file='.$file);
    exit();
}

$content = '';
$Parsedown = new Parsedown();
if (file_exists($filePath)) {
    $markdown = file_get_contents($filePath);
    $content = $Parsedown->text($markdown);
} else {
    $markdown = "# Error\nCould not locate page: ".__DIR__.$fixedFile.".md\n";
    $content  = $Parsedown->text($markdown);
    $markdown = '';
}

function renderNav($links)
{
    global $file;
    $html = '';
    foreach ($links as $link) {
        $title = $link['title'];
        if ($link['file'] == $file) {
            $title = '<strong>'.$title.'</strong>';
        }
        $html .= '<li><a href="'.basename(__FILE__).'?file='.$link['file'].'">'.$title.'</a>';
        if (isset($link['children']) === true && count($link['children']) > 0) {
            $html .= '<ul>' . renderNav($link['children']) . '</ul>';
        }
        $html .= '</li>';
    }
    return $html;
}

$navStructure = include(__DIR__.'/navigation.php');
$nav = '<ul>';
$nav .= renderNav($navStructure);
$nav .= '</ul>';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>My Documentation</title>
        <style type="text/css">
        <?=file_get_contents(__DIR__.'/../vendor/twbs/bootstrap/dist/css/bootstrap.min.css')?>
        </style>
    </head>
    <body style="margin-top:10px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-4 col-xl-3">
                    <div class="card">
                        <div class="card-header">
                            Navigation
                        </div>
                        <div class="card-block">
                            <?=$nav?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-8 col-xl-9">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs pull-xs-left" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#view" role="tab">view</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#edit" role="tab">Edit</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-block tab-content">
                            <div class="tab-pane active" id="view" role="tabpanel">
                                <p class="card-text" style="padding-top: 0px; margin-top: 0px;">
                                    <?=$content?>
                                </p>
                            </div>
                            <div class="tab-pane" id="edit" role="tabpanel">
                                <form name="editForm" method="post" action="<?=basename(__FILE__)?>">
                                    Note: Use <a href="https://help.github.com/articles/basic-writing-and-formatting-syntax/" target="_blank">Github markdown syntax</a> for documentation, as <a href="http://parsedown.org" target="_blank">Parsedown</a> is used for rendering.
                                    <textarea class="form-control" rows="20" name="content"><?=$markdown?></textarea>
                                    <input type="submit" class="btn btn-primary pull-right" value="Save" />
                                    <input type="hidden" name="file" value="<?=$file?>" />
                                    <input type="hidden" name="todo" value="save" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script language="Javascript">
        <?=file_get_contents(__DIR__.'/../vendor/twbs/bootstrap/docs/assets/js/vendor/jquery.min.js')?>
        <?=file_get_contents(__DIR__.'/../vendor/twbs/bootstrap/docs/assets/js/vendor/tether.min.js')?>
        <?=file_get_contents(__DIR__.'/../vendor/twbs/bootstrap/dist/js/bootstrap.min.js')?>
        </script>
    </body>
</html>

