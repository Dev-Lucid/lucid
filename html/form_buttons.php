<?php

namespace DevLucid;

class lucid_form_buttons extends base_tag
{
    public $tag = 'div';

    public function init()
    {
        parent::init();
        $this->add_class('btn-group');
        $this->add_class('pull-right');
        $this->attributes['role'] = 'group';

        $this->add(html::button(_('button:cancel'), 'secondary', 'history.go(-1);'));
        $this->add(html::submit(_('button:save')));
    }
}