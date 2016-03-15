<?php

namespace DevLucid;

class ControllerAddresses extends Controller
{
    public function ruleset(): Ruleset
    {
        return new Ruleset([
            ['type'=>'length_range', 'label'=>_('model:addresses:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:addresses:street_1'), 'field'=>'street_1', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:addresses:street_2'), 'field'=>'street_2', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:addresses:city'), 'field'=>'city', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:addresses:region_id'), 'field'=>'region_id', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:addresses:postal_code'), 'field'=>'postal_code', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:addresses:country_id'), 'field'=>'country_id', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:addresses:phone_number_1'), 'field'=>'phone_number_1', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:addresses:phone_number_2'), 'field'=>'phone_number_2', 'min'=>'2', 'max'=>'255', ],
        ]);
    }

    public function save(int $address_id, int $org_id, string $name, string $street_1, string $street_2, string $city, string $region_id, string $postal_code, string $country_id, string $phone_number_1, string $phone_number_2, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        $this->ruleset()->checkParameters(func_get_args());
        $data = lucid::model('addresses', $address_id, false);

        $data->org_id         = $org_id;
        $data->name           = $name;
        $data->street_1       = $street_1;
        $data->street_2       = $street_2;
        $data->city           = $city;
        $data->region_id      = $region_id;
        $data->postal_code    = $postal_code;
        $data->country_id     = $country_id;
        $data->phone_number_1 = $phone_number_1;
        $data->phone_number_2 = $phone_number_2;
        $data->save();

        if ($do_redirect) lucid::redirect('addresses-table');
    }

    public function delete(int $address_id, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::model('addresses')->where('address_id', $address_id)->delete_many();
        if ($do_redirect) lucid::redirect('addresses-table');
    }
}
