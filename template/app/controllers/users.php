<?php

namespace DevLucid;

class ControllerUsers extends Controller
{
    public function ruleset(): Ruleset
    {
        return new Ruleset([
            ['type'=>'length_range', 'label'=>_('model:users:email'), 'field'=>'email', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:users:password'), 'field'=>'password', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:users:first_name'), 'field'=>'first_name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:users:last_name'), 'field'=>'last_name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:users:register_key'), 'field'=>'register_key', 'min'=>'2', 'max'=>'255', ],
        ]);
    }

    public function save(int $user_id, int $org_id, string $email, string $password, string $first_name, string $last_name, bool $is_enabled, int $last_login, int $created_on, bool $force_password_change, string $register_key, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        $this->ruleset()->checkParameters(func_get_args());
        $data = lucid::model('users', $user_id, false);

        $data->org_id                = $org_id;
        $data->email                 = $email;
        $data->password              = $password;
        $data->first_name            = $first_name;
        $data->last_name             = $last_name;
        $data->is_enabled            = $is_enabled;
        $data->last_login            = $last_login;
        $data->created_on            = $created_on;
        $data->force_password_change = $force_password_change;
        $data->register_key          = $register_key;
        $data->save();

        if ($do_redirect) lucid::redirect('users-table');
    }

    public function delete(int $user_id, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::model('users')->where('user_id', $user_id)->delete_many();
        if ($do_redirect) lucid::redirect('users-table');
    }
}
