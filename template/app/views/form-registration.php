<?php

namespace DevLucid;

#lucid::controller('authentication')->ruleset()->send();

$card = html::card();
$card->header(_('navigation:views.registration'));

$card->block()->add(html::form('regform','#!registration.process'));

$form = $card->lastChild()->lastChild();
$form->add(html::row());
list($left, $right) = $form->lastChild()->grid([[12,12,6],[12,12,6]]);

$left->add(html::formGroup(_('model:users:email'), html::input('email', 'email')->preAddon('@')));
$left->add(html::formGroup(_('model:users:password'), html::input('password', 'password')->preAddon(html::icon('lock'))));

$right->add(html::formGroup(_('model:users:first_name'), html::input('text', 'first_name')));
$right->add(html::formGroup(_('model:users:last_name'), html::input('text', 'last_name')));

$form->add(html::submit(_('button:register'))->pull('right'));

return $card;
