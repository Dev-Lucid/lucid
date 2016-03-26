<?php
namespace Lucid\Html\Lucid\Tags;
use Lucid\Lucid;
use Lucid\Html\html;

class FormButtons extends \Lucid\Html\Tag
{
    public $tag = 'div';

    public function init()
    {
        parent::init();
        $this->addClass('btn-group');
        $this->addClass('pull-right');
        $this->attributes['role'] = 'group';

        $this->add(html::button(lucid::i18n()->translate('button:cancel'), 'secondary', 'history.go(-1);'));
        $this->add(html::submit(lucid::i18n()->translate('button:save')));
    }
}