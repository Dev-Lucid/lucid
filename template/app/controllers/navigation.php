<?php

namespace DevLucid;

class NavigationController extends Controller
{
    public function render($nav1_href = '', $nav2_href = '', $nav3_href = '')
    {
        $this->render_nav1($nav1_href);
        $this->render_nav2($nav1_href, $nav2_href);
        $this->render_nav3($nav1_href, $nav2_href, $nav3_href);
    }

    private function render_nav1($nav1_href = '')
    {
        # Determine navigation for navbar
        $nav1_links = [];
        if (lucid::$session->get('user_id',0) == 0)
        {
            $nav1_links[] = html::nav_anchor('#!view.login',_('navigation:login'));
        }
        else
        {
            $nav1_links[] = html::nav_anchor('#!view.dashboard',_('navigation:dashboard'));
            $nav1_links[] = html::nav_anchor('#!view.users-table',_('navigation:users'));
            $nav1_links[] = html::nav_anchor('#!view.organizations-table',_('navigation:organizations'));
            $nav1_links[] = html::nav_anchor('#!view.roles-table',_('navigation:configuration'));
            $nav1_links[] = html::nav_anchor('#!authentication.logout',_('navigation:logout'));
        }

        $html = '';
        foreach($nav1_links as $link)
        {
            $link->active(($link->href == '#!'.$nav1_href));
            $html .= html::nav_item()->add($link)->render();
        }
        lucid::$response->replace('#nav1',$html);
    }

    private function render_nav2($nav1_href = '', $nav2_href = '')
    {
        # Determine navigation for secondary list
        $nav2_links = [];
        switch($nav1_href)
        {
            case 'view.roles-table':
                $nav2_links[] = html::nav_anchor('#!view.roles-table', _('navigation:roles'));
                $nav2_links[] = html::nav_anchor('#!view.countries-table', _('navigation:countries'));
                $nav2_links[] = html::nav_anchor('#!view.regions-table', _('navigation:regions'));
                break;
            default:
                break;
        }
        $html = '';
        foreach($nav2_links as $link)
        {
            $link->active(($link->href == '#!'.$nav2_href));
            $html .= html::nav_item()->add($link)->render();
        }
        lucid::$response->replace('ul.nav2',$html);
    }

    private function render_nav3($nav1_href = '', $nav2_href = '', $nav3_href = '')
    {
        # Determine navigation for secondary list
        switch($nav2_href)
        {
            case 'view.dashboard':
                break;
            default:
                break;
        }
    }
}
