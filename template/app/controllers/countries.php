<?php

namespace DevLucid;
class lucid_controller_countries extends Controller
{
    public function ruleset()
    {
        return new Ruleset([
            ['type'=>'length_range', 'label'=>_('model:countries:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:countries:common_name'), 'field'=>'common_name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:countries:alpha_3'), 'field'=>'alpha_3', 'min'=>'2', 'max'=>'255', ],
      ]);
    }

    public function save($country_id, $name, $common_name, $alpha_3, $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        $this->ruleset()->checkParameters(func_get_args());
        $data = lucid::model('countries', $country_id, false);

        $data->name        = $name;
        $data->common_name = $common_name;
        $data->alpha_3     = $alpha_3;
        $data->save();

        if ($do_redirect) lucid::redirect('countries-table');
    }

    public function delete($country_id, $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::model('countries')->where('country_id', $country_id)->delete_many();
        if ($do_redirect) lucid::redirect('countries-table');
    }
}
