<?php

namespace DevLucid;

interface SecurityInterface
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
