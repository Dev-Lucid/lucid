<?php

namespace DevLucid;
class lucid_controller_roles extends Controller
{
    public function ruleset()
    {
        return new Ruleset([
            ['type'=>'length_range', 'label'=>_('model:roles:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ],
      ]);
    }

    public function save($role_id, $name, $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        $this->ruleset()->checkParameters(func_get_args());
        $data = lucid::model('roles', $role_id, false);

        $data->name = $name;
        $data->save();

        if ($do_redirect) lucid::redirect('roles-table');
    }

    public function delete($role_id, $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::model('roles')->where('role_id', $role_id)->delete_many();
        if ($do_redirect) lucid::redirect('roles-table');
    }
}
