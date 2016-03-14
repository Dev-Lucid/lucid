<?php

namespace DevLucid;

class Security implements SecurityInterface
{
    public static $id_field = 'user_id';

    public function isLoggedIn(): bool
    {
        $class = get_class($this);
        $id = intval(lucid::$session->get($class::$id_field));
        return ($id > 0);
    }

    public function requireLogin()
    {
        if ($this->isLoggedIn() === false) {
            lucid::$error->permissionDenied();
        }
        return $this;
    }

    public function __call($name, $parameters)
    {
        if (strpos($name, 'require_') === 0 && isset($parameters[0]) === true) {
            $name = substr($name, 8);
            $value = lucid::$session->get($name);
            if ($parameters[0]  != $value) {
                lucid::$error->permissionDenied();
            }
            return $this;
        }
        else
        {
            throw new \Exception('Unknown security function call: '.$name.'. The DevLucid\Security class does allow calls to undefined methods if the follow the pattern ->require_$variable($value); (ex: ->require_role_id(5)). When the security object is used in this way, it looks for an offset named $variable in lucid::$session, and throws an error if its value does not equal $value. Calling the security object in this manner requires that the function name you\'re accessing start with require_, and be passed 1 argument (the value to check against).');
        }
    }

    public function hasSession($name, $value): bool
    {
        $sess_value = $this->get($name, null);
        return ($value == $sess_value);
    }

    public function requireSession($name, $reqValue)
    {
        if ($this->hasSession($name, $reqValue) === false) {
            lucid::$error->permissionDenied();
        }
    }

    public function requireRole($value)
    {
        return lucid::$security->requireSession('role_name', $value);
    }

    public function hasPermission(string ...$names): bool
    {
        $perms = $this->getPermissionsList();
        $all_good = true;
        foreach ($names as $name) {
            if (in_array($name, $perms) === false) {
                $all_good = false;
            }
        }
        return $all_good;
    }

    public function requirePermission(string ...$names)
    {
        if ($this->hasPermission($names) === false) {
            lucid::$error->permissionDenied();
        }
        return $this;
    }

    public function hasAnyPermission(string ...$names): bool
    {
        $perms = $this->getPermissionsList();
        $allGood = false;

        foreach ($names as $name) {
            if (in_array($name, $perms) === true) {
                $allGood = true;
            }
        }
        return $allGood;
    }

    public function requireAnyPermission(string ...$names)
    {
        if ($this->hasAnyPermission($names) === false) {
            lucid::$error->permissionDenied();
        }
        return $this;
    }

    public function getPermissionsList(): array
    {
        if (isset(lucid::$session->permissions) === false || is_array(lucid::$session->permissions) === false) {
            lucid::$session->permissions = [];
        }
        return lucid::$session->permissions;
    }

    public function setPermissionsList(array $names=[])
    {
        if (isset(lucid::$session->permissions) === false || is_array(lucid::$session->permissions) === false) {
            lucid::$session->permissions = [];
        }

        lucid::$session->permissions = $names;
    }

    public function grant(string ...$names)
    {
        $current = $this->get_permissions_list();
        foreach ($names as $name) {
            array_push($current, $name);
        }
        $this->set_permissions_list($current);
    }

    public function revoke(string ...$names)
    {
        $newPerms = [];
        $oldPerms = $this->get_permissions_list();
        foreach ($oldPerms as $oldPerm) {
            if (in_array($oldPerm, $names) === false) {
                $newPerms[] = $oldPerm;
            }
        }
        $this->setPermissionsList($newPerms);
    }
}
