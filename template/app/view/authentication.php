<?php
namespace App\View;
use App\App, Lucid\Lucid, Lucid\Html\html;

class Authentication extends \App\View
{
    public function login()
    {
        $row = html::row();
        list($left, $right) = $row->grid([12,12,7,7,8], [12,12,5,5,4]);

        $left->add($this->_registrationForm());
        $right->add($this->_loginForm());

        lucid::factory()->view('navigation')->render('authentication.view.login');
        lucid::response()->replace('#main-fullwidth', $row);
    }

    public function _registrationForm()
    {
        $card = html::card();
        $card->header(lucid::i18n()->translate('navigation:authentication.view.registration'));

        $card->block()->add(html::form('regform','#!authentication.controller.process'));

        $form = $card->lastChild()->lastChild();
        $form->add(html::row());
        list($left, $right) = $form->lastChild()->grid([12,12,6],[12,12,6]);

        $left->add(html::formGroup(lucid::i18n()->translate('model:users:email'), html::input('email', 'email')->preAddon('@')));
        $left->add(html::formGroup(lucid::i18n()->translate('model:users:password'), html::input('password', 'password')->preAddon(html::icon('lock'))));

        $right->add(html::formGroup(lucid::i18n()->translate('model:users:first_name'), html::input('text', 'first_name')));
        $right->add(html::formGroup(lucid::i18n()->translate('model:users:last_name'), html::input('text', 'last_name')));

        $form->add(html::submit(lucid::i18n()->translate('button:register'))->pull('right'));

        $this->ruleset('register')->send($form->name);

        return $card;
    }

    public function _loginForm()
    {
        $card = html::card();
        $card->add(html::cardHeader(lucid::i18n()->translate('navigation:authentication.view.login')));
        $card->add(html::cardBlock());

        $card->lastChild()->add(html::form('authform','#!authentication.controller.process'));
        $form = $card->lastChild()->lastChild();

        $form->add(html::formGroup(lucid::i18n()->translate('model:users:email'), html::input('email', 'email')->preAddon('@')));
        $form->add(html::formGroup(lucid::i18n()->translate('model:users:password'), html::input('password', 'password')->preAddon(html::icon('lock'))));

        $form->add(html::submit(lucid::i18n()->translate('button:login'))->pull('right'));

        $this->ruleset('login')->send($form->name);
        return $card;
    }
}