<?php
namespace App\View;
use Lucid\Lucid, Lucid\Html\html, App\App;

class Navigation extends \App\View
{
    public $structure = [];

    public function __construct()
    {
        $this->structure['root'] = [
            'selector'=>'#nav1',
            'links'=>[
                'dashboard.view.admin'=>(lucid::$app->session()->int('user_id') > 0 && lucid::$app->session()->int('role_id') == 1),
                'dashboard.view.user'=>(lucid::$app->session()->int('user_id') > 0 && lucid::$app->session()->int('role_id') == 2),
                'organizations.view.table'=>(lucid::$app->session()->get('user_id',0) > 0),
                'users.view.table'=>(lucid::$app->session()->get('user_id',0) > 0),
                'authentication.controller.logout'=>(lucid::$app->session()->int('user_id',0) > 0),
                'authentication.view.login'=>(lucid::$app->session()->int('user_id', 0) == 0),
            ]
        ];

        $this->structure['root/dashboard.view.admin'] = [
            'selector'=>'ul.nav2',
            'links'=>[
                'dashboard.view.admin'=>(lucid::$app->session()->int('user_id') > 0 && lucid::$app->session()->int('role_id') == 1),
                'regions.view.table'=>true,
                'countries.view.table'=>true,
                'roles.view.table'=>true,
            ]
        ];
    }

    public function render(...$paths)
    {
        array_unshift($paths, 'root');

        $allNavs = [];
        foreach ($this->structure as $key=>$values) {
            $allNavs[$values['selector']] = true;
        }
        foreach (array_keys($allNavs) as $selector) {
            lucid::$app->response()->replace($selector, '');
        }
        for ($i=0; $i<count($paths); $i++) {
            $func = 'renderStructure'.$i;
            $this->func($i, $paths);
        }
    }

    public function __call($name, $parameters)
    {
        $index = array_shift($parameters);
        $paths = array_shift($parameters);
        $page = null;
        if (isset($paths[$index + 1]) === true) {
            $page = $paths[$index + 1];
        };
        $structure_index = implode('/', array_splice($paths, 0, $index + 1));

        $structure = (isset($this->structure[$structure_index]) === true)?$this->structure[$structure_index]:false;

        if ($structure === false) {
            return;
        }

        $html = '';
        foreach ($structure['links'] as $url=>$allowed) {
            if ($allowed === true) {
                $link = html::navAnchor('#!'.$url, lucid::$app->i18n()->translate('navigation:'.$url));
                #lucid::$app->log($url.'=='.$page);
                if ($url == $page) {
                    #lucid::$app->log($url.' is the active link');
                    $link->setactive(true);
                }
                $html .= html::navItem()->add($link)->render();
            }
        }
        lucid::$app->response()->replace($structure['selector'], $html);
    }
}
