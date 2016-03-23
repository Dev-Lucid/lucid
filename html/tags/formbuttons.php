<?php
namespace DevLucid\Lucid\Tags;

\DevLucid\lucid::log('FormButtons lib loaded');
class FormButtons extends \DevLucid\Tag
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