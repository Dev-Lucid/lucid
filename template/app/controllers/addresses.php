<?php
class lucid_controller_addresses extends lucid_controller
{
    public function ruleset()
    {
        return new lucid_ruleset([
            ['type'=>'length_range', 'label'=>_('model:addresses:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:addresses:street_1'), 'field'=>'street_1', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:addresses:street_2'), 'field'=>'street_2', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:addresses:city'), 'field'=>'city', 'min'=>'2', 'max'=>'255', ],
      ]);
    }

    public function save($address_id, $name, $street_1, $street_2, $city, $do_redirect=true)
    {
        lucid::$security->require_login();
        # lucid::$security->require_permission([]); # add required permissions to this array

        $this->ruleset()->check_parameters(func_get_args());
        $data = lucid::model('addresses', $address_id, false);

        $data->name     = $name;
        $data->street_1 = $street_1;
        $data->street_2 = $street_2;
        $data->city     = $city;
        $data->save();

        if ($do_redirect) lucid::redirect('addresses-table');
    }

    public function delete($address_id, $do_redirect=true)
    {
        lucid::$security->require_login();
        # lucid::$security->require_permission([]); # add required permissions to this array

        lucid::model('addresses')->where('address_id', $address_id)->delete_many();
        if ($do_redirect) lucid::redirect('addresses-table');
    }
}
