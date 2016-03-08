<?php
class lucid_controller_users extends lucid_controller
{
    public function ruleset()
    {
        return new lucid_ruleset([
            ['type'=>'length_range', 'label'=>_('model:users:first_name'), 'field'=>'first_name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:users:last_name'), 'field'=>'last_name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:users:email'), 'field'=>'email', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:users:password'), 'field'=>'password', 'min'=>'2', 'max'=>'255', ],
      ]);
    }

    public function save($user_id, $first_name, $last_name, $email, $password, $do_redirect=true)
    {
        lucid::$security->require_login();
        # lucid::$security->require_permission([]); # add required permissions to this array

        $this->ruleset()->check_parameters(func_get_args());
        $data = lucid::model('users', $user_id, false);

        $data->first_name = $first_name;
        $data->last_name  = $last_name;
        $data->email      = $email;
        $data->password   = $password;
        $data->save();

        if ($do_redirect) lucid::redirect('users-table');
    }

    public function delete($user_id, $do_redirect=true)
    {
        lucid::$security->require_login();
        # lucid::$security->require_permission([]); # add required permissions to this array

        lucid::model('users')->where('user_id', $user_id)->delete_many();
        if ($do_redirect) lucid::redirect('users-table');
    }
}
