<?php

namespace DevLucid;

class ControllerRegions extends Controller
{
    public function ruleset(): Ruleset
    {
        return new Ruleset([
            ['type'=>'length_range', 'label'=>_('model:regions:country_id'), 'field'=>'country_id', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:regions:abbreviation'), 'field'=>'abbreviation', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:regions:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:regions:type'), 'field'=>'type', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:regions:parent'), 'field'=>'parent', 'min'=>'2', 'max'=>'255', ],
        ]);
    }

    public function save(string $region_id, string $country_id, string $abbreviation, string $name, string $type, string $parent, bool $is_parent, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        $this->ruleset()->checkParameters(func_get_args());
        $data = lucid::model('regions', $region_id, false);

        $data->country_id   = $country_id;
        $data->abbreviation = $abbreviation;
        $data->name         = $name;
        $data->type         = $type;
        $data->parent       = $parent;
        $data->is_parent    = $is_parent;
        $data->save();

        if ($do_redirect) lucid::redirect('regions-table');
    }

    public function delete(int $region_id, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::model('regions')->where('region_id', $region_id)->delete_many();
        if ($do_redirect) lucid::redirect('regions-table');
    }
}
