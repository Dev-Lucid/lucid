<?php

namespace DevLucid;

class lucid_data_table extends table
{
    public $_tag        = 'table';
    public $_class      = ['table'=>true, 'table-striped'=>true, 'table-hover'=>true, 'table-bordered'=>true, 'table-sm'=>true, 'lucid-data-table'=>true,];
    public $_parameters = ['id', 'data', 'data-url', 'sort-col', 'sort-dir', ];
    public $_data       = null;
    public $_sort_col   = null;
    public $_sort_dir   = null;
    public $_page       = 0;
    public $_limit      = 10;
    public $_footer     = null;
    public $_row_count  = null;
    public $_page_count = null;

    public function send_refresh()
    {
        if(isset(\lucid::$request['refresh']) == 'please')
        {
            $this->determine_query_settings();
            $html = $this->build_tbody();
            \lucid::$response->replace('#'.$this->id.' > tbody',$html);
            \lucid::$response->send();
        }
    }

    public function determine_query_settings()
    {
        foreach($this->_children as $child)
        {
            # this is needed for determining the sort column
            $child->prepare_for_render();
        }

        $this->_data     = $this->attribute_unset_and_get('data');
        $this->_sort_col = $this->attribute_unset_and_get('sort-col');
        $this->_sort_dir = $this->attribute_unset_and_get('sort-dir',null,'asc');

        # get new parameters from the request if necessary
        $this->_limit    = (isset(\lucid::$request['limit']))?   \lucid::$request['limit']   :$this->_limit;
        $this->_page     = (isset(\lucid::$request['page']))?    \lucid::$request['page']    :$this->_page;
        $this->_sort_col = (isset(\lucid::$request['sort_col']))?\lucid::$request['sort_col']:$this->_sort_col;
        $this->_sort_dir = (isset(\lucid::$request['sort_dir']))?\lucid::$request['sort_dir']:$this->_sort_dir;
    }

    public function pre_render()
    {
        $this->determine_query_settings();
        if($this->_sort_col == '')
        {
            foreach($this->_children as $child)
            {
                if($child->_sortable == true and $this->_sort_col === '')
                {
                    $this->_sort_col = $child->_index;
                }
            }
        }

        if ($this->_sort_col !== '')
        {
            $this->attribute('data-sort-col',$this->_sort_col);
        }

        $this->attribute('data-sort-dir', $this->_sort_dir);
        $this->attribute('data-limit',    $this->_limit);
        $this->attribute('data-page',     $this->_page);

        foreach($this->_children as $child)
        {
            $this->_pre_children_html .= $child->render_col();
        }

        return parent::pre_render();
    }

    public function render_thead()
    {
        $html = '<thead><tr>';
        foreach($this->_children as $child)
        {
            $html .= $child->render_header();
        }
        $html .= '</tr></thead>';
        return $html;
    }

    public function render_tbody()
    {
        return '<tbody>' . $this->build_tbody(). '</tbody>';
    }

    public function build_tbody()
    {
        # apply filters

        # determine the total number of rows returned and page count
        $this->_row_count = $this->_data->count();
        $this->_page_count = ceil($this->_row_count / $this->_limit);

        # apply sorts/ limits/offsets, and run the final query
        $sort_func = ($this->_sort_dir == 'asc')?'order_by_asc':'order_by_desc';
        $this->_data->$sort_func( $this->_children[$this->_sort_col]->_name );

        $this->_data->limit($this->_limit);
        $this->_data->offset($this->_page * $this->_limit);
        $rows = $this->_data->find_many();

        $this->build_footer();

        $html = '';
        foreach($rows as $row)
        {
            $html .= '<tr>';
            foreach($this->_children as $column)
            {
                $html .= $column->render_data($row);
            }
            $html .= '</tr>';
        }

        return $html;
    }

    public function build_footer()
    {
        # add a td for the footer
        $this->_footer = \html::td()->colspan(count($this->_children));
        $this->add_foot($this->_footer)->last_child();

        # build a pager,
        $this->_footer->add(\html::h3()->add($this->_page_count.'/'.$this->_row_count));

        # add a search input box
    }
}
