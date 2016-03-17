<?php

namespace DevLucid;

class ControllerNavigation extends Controller
{
    public $structure = [];

    public function __construct()
    {
        $this->structure['root'] = [
            'selector'=>'#nav1',
            'links'=>[
                'view.dashboard'=>(lucid::$session->get('user_id',0) > 0),
                'view.organizations-table'=>(lucid::$session->get('user_id',0) > 0),
                'view.users-table'=>(lucid::$session->get('user_id',0) > 0),
                'authentication.logout'=>(lucid::$session->get('user_id',0) > 0),
                'views.login'=>(lucid::$session->get('user_id',0) == 0),
            ]
        ];

        $this->structure['root/view.dashboard'] = [
            'selector'=>'ul.nav2',
            'links'=>[
                'view.dashboard'=>true,
                'view.regions-table'=>true,
                'view.countries-table'=>true,
                'view.roles-table'=>true,
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
            lucid::$response->replace($selector, '');
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
        $structure_index = implode('/',array_splice($paths, 0, $index + 1));

        $structure = (isset($this->structure[$structure_index]) === true)?$this->structure[$structure_index]:false;

        if ($structure === false) {
            lucid::log()->debug('Navigation controller was unable to find any navigation structure for path '.$structure_index);
            return;
        }

        $html = '';
        foreach ($structure['links'] as $url=>$allowed) {
            if ($allowed === true) {
                $link = html::navAnchor('#!'.$url, _('navigation:'.$url));
                #lucid::log($url.'=='.$page);
                if ($url == $page) {
                    #lucid::log($url.' is the active link');
                    $link->setactive(true);
                }
                $html .= html::navItem()->add($link)->render();
            }
        }
        lucid::$response->replace($structure['selector'], $html);
    }
}
