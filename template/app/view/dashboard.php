<?php
namespace App\View;
use App\App, Lucid\Lucid, Lucid\Html\html;

class Dashboard extends \App\View
{
    public function admin()
    {
        lucid::$app->factory()->view('navigation')->render('dashboard.view.admin', 'dashboard.view.admin');
        lucid::$app->response()->replace('#main-rightcol', html::h1('Admin dashboard'));
    }

    public function user()
    {
        lucid::$app->factory()->view('navigation')->render('dashboard.view.user', 'dashboard.view.user');
        lucid::$app->response()->replace('#main-fullwidth', html::h1('User dashboard'));
    }
}