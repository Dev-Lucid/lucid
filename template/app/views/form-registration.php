<?php

#lucid::controller('authentication')->ruleset()->send();

$card = html::card();
$card->add(html::card_header(_('navigation:registration')));
$card->add(html::card_block());
$card->last_child()->add(html::form('regform','#!registration.process'));

$form = $card->last_child()->last_child();
$form->add(html::row());
list($left, $right) = $form->last_child()->grid([[12,12,6],[12,12,6]]);

$left->add(html::form_group(_('model:users:email'), html::input('email', 'email')->pre_addon('@')));
$left->add(html::form_group(_('model:users:password'), html::input('password', 'password')->pre_addon(html::icon('lock'))));

$right->add(html::form_group(_('model:users:first_name'), html::input('text', 'first_name')));
$right->add(html::form_group(_('model:users:last_name'), html::input('text', 'last_name')));

$form->add(html::submit(_('button:register'))->pull('right'));
/*



$card->last_child()->add(html::form('regform','#!registration.process'));
$form = $card->last_child()->last_child();
$form->add(html::row());

list($left, $right) = $form->last_child()->grid([[12,12,6],[12,12,6]]);

$left->add(html::form_input('email',_('model:users:email'),'email')->pre_addon('@'));
$left->add(html::form_input('password',_('model:users:password'),'password')->pre_addon(html::icon('lock')));

$right->add(html::form_input('text',_('model:users:first_name'),'first_name'));
$right->add(html::form_input('text',_('model:users:last_name'),'last_name'));

$form->add(html::submit(_('button:register'))->pull('right'));
*/
return $card;
