<?php

namespace DevLucid;

class lucid_controller_roles extends lucid_controller
{
    public function ruleset()
    {
        return new lucid_ruleset([
            ['type'=>'length_range', 'label'=>_('model:roles:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ],
      ]);
    }

    public function save($role_id, $name, $do_redirect=true)
    {
        lucid::$security->require_login();
        # lucid::$security->require_permission([]); # add required permissions to this array

        $this->ruleset()->check_parameters(func_get_args());
        $data = lucid::model('roles', $role_id, false);

        $data->name = $name;
        $data->save();

        if ($do_redirect) lucid::redirect('roles-table');
    }

    public function delete($role_id, $do_redirect=true)
    {
        lucid::$security->require_login();
        # lucid::$security->require_permission([]); # add required permissions to this array

        lucid::model('roles')->where('role_id', $role_id)->delete_many();
        if ($do_redirect) lucid::redirect('roles-table');
    }
}
