<?php
use Lucid\Lucid;
include(__DIR__.'/../bootstrap.php');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="author" content="" />
        <link rel="icon" href="../../favicon.ico" />

        <title>Jumbotron Template for Bootstrap</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link href="css/<?=((lucid::error()->isDebugStage())?'debug':'production')?>.css?_time_=<?=time()?>" rel="stylesheet" />
    </head>
    <body onload="lucid.init();app.init();">
        <nav class="navbar navbar-static-top navbar-dark bg-inverse">
            <a class="navbar-brand"><?=lucid::i18n()->translate('branding:app_name')?></a>
            <ul class="nav navbar-nav pull-right" id="nav1"></ul>
        </nav>
        <div class="container-fluid" style="margin:5px 0px 50px 0px;">
            <div class="row" id="layout-leftcol">
                <div class="hidden-lg-up col-xs-12">
                    <ul class="nav nav-pills nav2"></ul>
                    <br />
                </div>
                <div class="col-xs-12 col-lg-8 col-xl-9" id="main-leftcol"></div>
                <div class="col-lg-4 col-xl-3">
                    <ul class="nav nav-pills nav-stacked nav2"></ul>
                </div>
            </div>
            <div class="container" id="layout-rightcol">
                <div class="hidden-lg-up col-xs-12">
                    <ul class="nav nav-pills nav2"></ul>
                    <br />
                </div>

                <div class="hidden-md-down col-lg-4 col-xl-3"><ul class="nav nav-pills nav-stacked nav2"></ul></div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-9" id="main-rightcol"></div>
            </div>
            <div class="row" id="layout-fullwidth">
                <div class="col-xs-12" id="main-fullwidth"></div>
            </div>
        </div>
        <nav class="navbar navbar-fixed-bottom navbar-light bg-faded">
            <footer>
                <p>&copy; <?=lucid::i18n()->translate('branding:app_name')?> 2016</p>
            </footer>
        </nav>
        <script language="Javascript" src="javascript/<?=((lucid::error()->isDebugStage())?'debug':'production')?>.js?_time_=<?=time()?>"></script>
        <script language="Javascript">

        lucid.setDefaultRequest('#!authentication.view.login');
        var layouts = {
            'layout-leftcol':['#main-leftcol'],
            'layout-rightcol':['#main-rightcol'],
            'layout-fullwidth':['#main-fullwidth']
        };
        lucid.addHandler('pre-handleResponse', function(parameters){
            var data = parameters.jqxhr.responseJSON.data;
            for (var layoutId in layouts) {
                var useThisLayout = false;
                for (var i=0; i < layouts[layoutId].length; i++) {
                    if(typeof(data.replace[layouts[layoutId][i]]) != 'undefined') {
                        useThisLayout = true;
                        console.log('using layout: '+layoutId);
                    }
                }
                if (useThisLayout === true) {
                    jQuery('#'+layoutId).show();
                } else {
                    jQuery('#'+layoutId).hide();
                }
            }
        });
        </script>
    </body>
</html>
