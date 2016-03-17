<?php

namespace DevLucid;

$card = html::card();
$card->add(html::cardHeader(_('navigation:views.login')));
$card->add(html::cardBlock());

$card->lastChild()->add(html::form('authform','#!authentication.process'));
lucid::controller('authentication')->ruleset()->send('authform');
$form = $card->lastChild()->lastChild();

$form->add(html::formGroup(_('model:users:email'), html::input('email', 'email')->preAddon('@')));
$form->add(html::formGroup(_('model:users:password'), html::input('password', 'password')->preAddon(html::icon('lock'))));

$form->add(html::submit(_('button:login'))->pull('right'));
/*
$card->add(html::card_header(_('navigation:login')));
$card->add(html::card_block());

$card->last_child()->add(html::form('authform','#!authentication.process'));
$form = $card->last_child()->last_child();
$form->add(html::form_input('email',_('model:users:email'),'email')->pre_addon('@'));
$form->add(html::form_input('password',_('model:users:password'),'password')->pre_addon(html::icon('lock')));
$form->add(html::submit(_('button:login'))->pull('right'));
*/

return $card;
