<?php

namespace DevLucid;
class lucid_controller_organizations extends Controller
{
    public function ruleset()
    {
        return new Ruleset([
            ['type'=>'length_range', 'label'=>_('model:organizations:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ],
      ]);
    }

    public function save($org_id, $name, $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        $this->ruleset()->checkParameters(func_get_args());
        $data = lucid::model('organizations', $org_id, false);

        $data->name = $name;
        $data->save();

        if ($do_redirect) lucid::redirect('organizations-table');
    }

    public function delete($org_id, $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::model('organizations')->where('org_id', $org_id)->delete_many();
        if ($do_redirect) lucid::redirect('organizations-table');
    }
}
