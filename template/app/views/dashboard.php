<?php
lucid::controller('navigation')->render('view.dashboard');

/*
$card = html::card();
$card->header('testing header');
$card->block()->add('hi 1');
$card->block()->add('hi 2');
$card->footer('testing footer');

$nav = html::nav()->tabs(true);

$nav->add(html::nav_anchor('tab1', 'Tab 1'));
$nav->add_pane(html::tab_pane('tab1'));
$nav->last_pane()->add('hiya from tab 1');

$nav->add(html::nav_anchor('tab2', 'Tab 2'));
$nav->add_pane(html::tab_pane('tab2'));
$nav->last_pane()->add('hiya from tab 2');

$nav->add(html::nav_anchor('tab3', 'Tab 3'));
$nav->add_pane(html::tab_pane('tab3'));
$nav->last_pane()->add('hiya from tab 3');
*/

$card_tabs = html::card_tabs();

$card_tabs->add_tab('Tab 1')->paragraph('this is paragraph1')->paragraph('this is paragraph 2');
$card_tabs->add_tab('Tab 2')->add('hiya from tab 2');
$card_tabs->add_tab('Tab 3')->add('hiya from tab 3');
$card_tabs->add_tab('Tab 4')->add('hiya from tab 4');
$card_tabs->footer('testing');


lucid::$response->replace('#body', $card_tabs);
