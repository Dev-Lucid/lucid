<?php

namespace DevLucid;
class lucid_controller_regions extends Controller
{
    public function ruleset()
    {
        return new Ruleset([
            ['type'=>'length_range', 'label'=>_('model:regions:country_id'), 'field'=>'country_id', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:regions:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ],
      ]);
    }

    public function save($region_id, $country_id, $name, $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        $this->ruleset()->checkParameters(func_get_args());
        $data = lucid::model('regions', $region_id, false);

        $data->country_id = $country_id;
        $data->name       = $name;
        $data->save();

        if ($do_redirect) lucid::redirect('regions-table');
    }

    public function delete($region_id, $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::model('regions')->where('region_id', $region_id)->delete_many();
        if ($do_redirect) lucid::redirect('regions-table');
    }
}
