<?php
class lucid_controller_regions extends lucid_controller
{
    public function ruleset()
    {
        return new lucid_ruleset([
            ['type'=>'length_range', 'label'=>_('model:regions:country_id'), 'field'=>'country_id', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:regions:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:regions:abbreviation'), 'field'=>'abbreviation', 'min'=>'2', 'max'=>'255', ],
      ]);
    }

    public function save($region_id, $country_id, $name, $abbreviation, $do_redirect=true)
    {
        lucid::$security->require_login();
        # lucid::$security->require_permission([]); # add required permissions to this array

        $this->ruleset()->check_parameters(func_get_args());
        $data = lucid::model('regions', $region_id, false);

        $data->country_id   = $country_id;
        $data->name         = $name;
        $data->abbreviation = $abbreviation;
        $data->save();

        if ($do_redirect) lucid::redirect('regions-table');
    }

    public function delete($region_id, $do_redirect=true)
    {
        lucid::$security->require_login();
        # lucid::$security->require_permission([]); # add required permissions to this array

        lucid::model('regions')->where('region_id', $region_id)->delete_many();
        if ($do_redirect) lucid::redirect('regions-table');
    }
}
