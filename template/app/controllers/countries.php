<?php

namespace DevLucid;

class CountriesController extends Controller
{
    public function ruleset(): Ruleset
    {
        return new Ruleset([
            ['type'=>'length_range', 'label'=>_('model:countries:alpha_3'), 'field'=>'alpha_3', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:countries:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:countries:common_name'), 'field'=>'common_name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:countries:official_name'), 'field'=>'official_name', 'min'=>'2', 'max'=>'255', ],
        ]);
    }

    public function save(string $country_id, string $alpha_3, string $name, string $common_name, string $official_name, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        $this->ruleset()->checkParameters(func_get_args());
        $data = lucid::model('countries', $country_id, false);

        $data->alpha_3       = $alpha_3;
        $data->name          = $name;
        $data->common_name   = $common_name;
        $data->official_name = $official_name;
        $data->save();

        if ($do_redirect) lucid::redirect('countries-table');
    }

    public function delete(int $country_id, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::model('countries')->where('country_id', $country_id)->delete_many();
        if ($do_redirect) lucid::redirect('countries-table');
    }
}
