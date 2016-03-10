<?php
# no need to load the database connection or the logger, so define constants that prevent their loading
define('__LOAD_DB__',false);
define('__LOAD_LOGGER__',false);

include(__DIR__.'/../bootstrap.php');

# load the javascript/scss configs to get the paths for the final builds
lucid::config('js');
lucid::config('scss');

?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="icon" href="../../favicon.ico" />
        <title>Jumbotron Template for Bootstrap</title>
        <link href="<?=str_replace(lucid::$paths['app'],'',lucid::$scss_production_build)?>" rel="stylesheet" />
    </head>
    <body onload="app.init();">
        <nav class="navbar navbar-static-top navbar-dark bg-inverse">
            <a class="navbar-brand" href="#"><?=_('branding:app_name')?></a>
            <ul class="nav navbar-nav" id="nav1">
                <li class="nav-item">
                    <a class="nav-link" href="#!view.login"><?=_('navigation:login')?></a>
                </li>
            </ul>
        </nav>

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="container-fluid" style="margin-top: 5px;">
            <div class="hidden-md-down col-lg-4 col-xl-3">
                <ul class="nav nav-pills nav-stacked nav2">
                </ul>
            </div>
            <div class="hidden-lg-up col-xs-12">
                <div class="card">
                    <ul class="nav nav-pills nav2">
                    </ul>
                </div>
                <br />
            </div>
            <div class="col-xs-12 col-lg-8 col-xl-9" id="body">
                <div class="jumbotron">
                    <div class="container">
                        <h1 class="display-3">Hello, world!</h1>
                        <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
                        <p><a class="btn btn-primary btn-lg" href="#!view.login|param1|test2" role="button"><i class="fa fa-bolt"></i> Learn more &raquo;</a></p>
                        <p id="testarea"></p>
                    </div>
                </div>
            </div>
            <footer>
                <p>&copy; Company 2015</p>
            </footer>
        </div>
        <script src="<?=str_replace(lucid::$paths['app'],'',lucid::$js_production_build)?>"></script>
        <script language="Javascript">
        lucid.stage = '<?=lucid::$stage?>';
        lucid.i18n.phrases['data_table:page'] = '<?=_('data_table:page')?>';
        </script>
    </body>
</html>
