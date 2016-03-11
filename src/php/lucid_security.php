<?php

interface i_lucid_security
{
    public function is_logged_in();
    public function require_login();

    public function has_permission($names);
    public function require_permission($names);

    public function has_any_permission($names);
    public function require_any_permission($names);

    public function grant($names);
    public function revoke($names);

    public function get_permissions_list();
    public function set_permissions_list($names);

    public function __call($name, $parameters);
}

class lucid_security implements i_lucid_security
{
    public static $id_field = 'user_id';

    public function is_logged_in()
    {
        $class = get_class($this);
        $id = intval(lucid::$session->get($class::$id_field));
        return ($id > 0);
    }

    public function require_login()
    {
        if($this->is_logged_in() === false)
        {
            lucid::$error->permission_denied();
        }
        return $this;
    }

    public function __call($name, $parameters)
    {
        if(strpos($name, 'require_') === 0)
        {
            $name = substr($name, 8);
            $value = lucid::$session->get($name);
            if($parameters[0]  != $value)
            {
                lucid::$error->permission_denied();
            }
            return $this;
        }
        else
        {
            throw new Exception('Unknown security function call: '.$name.'.');
        }
    }

    public function require_session($name, $req_value)
    {
        $sess_value = lucid::$session->get($name);
        if($req_value != $sess_value)
        {
            lucid::$error->permission_denied();
        }
        return $this;
    }

    public function require_role($value)
    {
        return lucid::$security->require_session('role_name', $value);
    }

    public function has_permission($names)
    {
        if(is_array($names) === false)
        {
            $names = [$names];
        }
        $perms = $this->get_permissions_list();
        $all_good = true;
        foreach($names as $name)
        {
            if(in_array($name, $perms) === false)
            {
                $all_good = false;
            }
        }
        return $all_good;
    }

    public function require_permission($names)
    {
        if($this->has_permission($names) == false)
        {
            lucid::$error->permission_denied();
        }
        return $this;
    }

    public function has_any_permission($names)
    {
        if(is_array($names) === false)
        {
            $names = [$names];
        }
        $perms = $this->get_permissions_list();
        $all_good = false;
        foreach($names as $name)
        {
            if(in_array($name, $perms) === true)
            {
                $all_good = true;
            }
        }
        return $all_good;
    }

    public function require_any_permission($names)
    {
        if($this->has_any_permission($names) == false)
        {
            lucid::$error->permission_denied();
        }
        return $this;
    }

    public function get_permissions_list()
    {
        if(isset(lucid::$session->permissions) === false || is_array(lucid::$session->permissions) === false)
        {
            lucid::$session->permissions = [];
        }
        return lucid::$session->permissions;
    }

    public function set_permissions_list($names=[])
    {
        if(isset(lucid::$session->permissions) === false || is_array(lucid::$session->permissions) === false)
        {
            lucid::$session->permissions = [];
        }
        if (is_array($names) === false)
        {
            $names = [];
        }
        lucid::$session->permissions = $names;
    }

    public function grant($names)
    {
        $current = $this->get_permissions_list();
        if (is_array($names) === false)
        {
            array_push($current,$names);
        }
        else
        {
            foreach($names as $name)
            {
                array_push($current,$name);
            }
        }
        $this->set_permissions_list($current);
    }

    public function revoke($names)
    {
        if (is_array($names) === false)
        {
            $names = [$names];
        }

        $new_perms = [];
        $old_perms = $this->get_permissions_list();
        foreach($old_perms as $old_perm)
        {
            if(in_array($old_perm, $new_perms) === false)
            {
                $new_perms[] = $old_perm;
            }
        }
        $this->set_permissions_list($new_perms);
    }
}
