<?php

namespace DevLucid;

lucid::controller('navigation')->render('view.dashboard');

lucid::$security->require_role_name('admin');

$card_tabs = html::card_tabs();

$card_tabs->add_tab('Tab 1')->paragraph('this is paragraph1')->paragraph('this is paragraph 2');
$card_tabs->add_tab('Tab 2')->add('hiya from tab 2');
$card_tabs->add_tab('Tab 3')->add('hiya from tab 3');
$card_tabs->add_tab('Tab 4')->add('hiya from tab 4');
$card_tabs->footer('testing');


lucid::$response->replace('#body', $card_tabs);
