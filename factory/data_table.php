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
    public $_rows       = null;

    public function send_refresh()
    {
        if(isset(\lucid::$request['refresh']) == 'please')
        {
            $this->run_query();
            $html = $this->build_tbody();
            \lucid::$response->replace('#'.$this->id.' > tbody',$html);
            \lucid::$response->send();
        }
    }

    public function run_query()
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

        # determine the total number of rows returned and page count
        $this->_row_count = $this->_data->count();
        $this->_page_count = ceil($this->_row_count / $this->_limit);

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
        $this->attribute('data-page-count', $this->_page_count);

        # apply sorts/ limits/offsets, and run the final query
        $sort_func = ($this->_sort_dir == 'asc')?'order_by_asc':'order_by_desc';
        $this->_data->$sort_func( $this->_children[$this->_sort_col]->_name );

        $this->_data->limit($this->_limit);
        $this->_data->offset($this->_page * $this->_limit);

        $this->_rows = $this->_data->find_many();
    }

    public function pre_render()
    {
        $this->run_query();

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
        $this->build_footer();

        $html = '';
        foreach($this->_rows as $row)
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
        $group = \html::button_group();
        $group->pull('right');

        $group->add(\html::button(\html::icon('step-backward'))->onclick('lucid.dataTable.changePage(\''.$this->id.'\',\'first\');'));
        $group->add(\html::button(\html::icon('backward'     ))->onclick('lucid.dataTable.changePage(\''.$this->id.'\',\'previous\');'));
        $group->add(\html::button(\html::icon('forward'      ))->onclick('lucid.dataTable.changePage(\''.$this->id.'\',\'next\');'));
        $group->add(\html::button(\html::icon('step-forward' ))->onclick('lucid.dataTable.changePage(\''.$this->id.'\',\'last\');'));

        $group->add(\html::button('Page '.($this->_page + 1).' of '.($this->_page_count))->add_class('dropdown-toggle')->attribute('data-toggle','dropdown'));
        $dropdown = \html::dropdown();
        for($i=0; $i< $this->_page_count; $i++)
        {
            $dropdown->add(\html::anchor('javascript:lucid.dataTable.changePage(\''.$this->id.'\','.$i.');','Page '.($i + 1).' of '.($this->_page_count)));
        }
        $group->add($dropdown);

        $this->_footer->add($group);
        #$this->_footer->add(\html::h3()->add($this->_page_count.'/'.$this->_row_count));

        # add a search input box
    }
}
