<?php
namespace DevLucid;

lucid::controller('navigation')->render('view.dashboard', 'view.dashboard');


$card_tabs = html::cardTabs();

$card_tabs->addTab('Tab 1')->paragraph('this is paragraph1')->paragraph('this is paragraph 2');
$card_tabs->addTab('Tab 2')->add('hiya from tab 2');
$card_tabs->addTab('Tab 3')->add('hiya from tab 3');
$card_tabs->addTab('Tab 4')->add('hiya from tab 4');
$card_tabs->footer('testing');


lucid::$response->replace('#right-col', $card_tabs);
