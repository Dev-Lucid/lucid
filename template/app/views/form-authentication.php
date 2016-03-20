<?php

namespace DevLucid;

$card = html::card();
$card->add(html::cardHeader(_('navigation:views.login')));
$card->add(html::cardBlock());

$card->lastChild()->add(html::form('authform','#!authentication.process'));
lucid::$mvc->controller('authentication')->ruleset()->send('authform');
$form = $card->lastChild()->lastChild();

$form->add(html::formGroup(_('model:users:email'), html::input('email', 'email')->preAddon('@')));
$form->add(html::formGroup(_('model:users:password'), html::input('password', 'password')->preAddon(html::icon('lock'))));

$form->add(html::submit(_('button:login'))->pull('right'));

return $card;
