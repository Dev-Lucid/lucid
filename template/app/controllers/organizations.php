<?php

namespace DevLucid;

class ControllerOrganizations extends Controller
{
    public function ruleset(): Ruleset
    {
        return new Ruleset([
            ['type'=>'length_range', 'label'=>_('model:organizations:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ],
        ]);
    }

    public function save(int $org_id, int $role_id, string $name, bool $is_enabled, int $created_on, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        $this->ruleset()->checkParameters(func_get_args());
        $data = lucid::model('organizations', $org_id, false);

        $data->role_id    = $role_id;
        $data->name       = $name;
        $data->is_enabled = $is_enabled;
        $data->created_on = $created_on;
        $data->save();

        if ($do_redirect) lucid::redirect('organizations-table');
    }

    public function delete(int $org_id, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::model('organizations')->where('org_id', $org_id)->delete_many();
        if ($do_redirect) lucid::redirect('organizations-table');
    }
}
