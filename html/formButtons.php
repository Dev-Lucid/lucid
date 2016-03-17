<?php

namespace DevLucid\Tag;

class LucidFormButtons extends BaseTag
{
    public $tag = 'div';

    public function init()
    {
        parent::init();
        $this->addClass('btn-group');
        $this->addClass('pull-right');
        $this->attributes['role'] = 'group';

        $this->add(\DevLucid\html::button(\DevLucid\_('button:cancel'), 'secondary', 'history.go(-1);'));
        $this->add(\DevLucid\html::submit(\DevLucid\_('button:save')));
    }
}