<?php

namespace DevLucid;

class lucid_data_column extends lucid_tag
{
    public $_tag = 'td';
    public $_parameters = ['label','name','width','sortable','renderer'];
    public $_label = '';
    public $_name  = '';
    public $_width = '';
    public $_sortable = false;
    public $_index    = null;
    public $_renderer = null;

    public function prepare_for_render()
    {
        $this->_label = $this->attribute_unset_and_get('label');
        $this->_name  = $this->attribute_unset_and_get('name');
        $this->_sortable = $this->attribute_unset_and_get('sortable');
        $this->_renderer = $this->attribute_unset_and_get('renderer');
        for($i = 0; $i< count($this->parent()->_children); $i++ )
        {
            if($this->parent()->_children[$i] == $this)
            {
                $this->_index = $i;
            }
        }
    }

    public function render_col()
    {
        return '<col width="'.$this->attribute_unset_and_get('width').'" />';
    }

    public function render_header()
    {
        if($this->_sortable)
        {
            $this->add_class('lucid-data-column-sortable');
            $this->onclick('lucid.dataTable.sort(\''.$this->parent()->id.'\','.$this->_index.');');
        }

        $this->_tag = 'th';
        $html = '';
        $html .= $this->render_tag_start();


        if($this->_sortable)
        {
            if($this->parent()->_sort_col == $this->_index)
            {
                $direction = ($this->parent()->_sort_dir == 'asc')?'up':'down';
            }
            else
            {
                $direction = 'right';
            }
            $html .= \html::icon('chevron-'.$direction). '&nbsp;';
        }
        $html .= $this->_label;

        $html .= $this->render_tag_end();
        $this->_tag = 'td';
        return $html;

    }

    public function render_data($row)
    {
        $field = $this->_name;
        $this->_html = '';
        $this->_html .= $this->render_tag_start();

        if (is_callable($this->_renderer))
        {
            $func = $this->_renderer;
            $this->_html .= $func($row, $field, 'html');
        }
        else
        {
            $this->_html .= $row->$field;
        }

        $this->_html .= $this->render_tag_end();
        return $this->_html;
    }
}
