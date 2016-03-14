<?php

namespace DevLucid;

class Model extends \Model
{
    public function set_orm($orm)
    {
        $return = parent::set_orm($orm);
        $this->require_permissions('select');
        return $return;
    }

    public function save()
    {
        $this->require_permissions(($this->is_new() === true)?'insert':'update');
        return parent::save();
    }

    public function delete() {
        $this->require_permissions('delete');
        return parent::delete();
    }

    public function has_permission_select()
	{
		return true;
	}

	public function has_permission_insert()
	{
		return true;
	}

	public function has_permission_update()
	{
		return true;
	}

	public function has_permission_delete()
	{
		return true;
	}

	public function has_permissions($actions)
	{
		$result = true;
		$actions = func_get_args();
		foreach ($actions as $action) {
			if (method_exists($this, 'has_permission_'.$action)) {
				if (call_user_func([$this, 'has_permission_'.$action]) === false) {
					$result = false;
				}
			}
		}
		return $result;
	}

	public function require_permissions($actions)
	{
		$actions = func_get_args();
		foreach ($actions as $action) {
			if (method_exists($this, 'has_permission_'.$action)) {
				$result = call_user_func([$this, 'has_permission_'.$action]);
				if ($result === false) {
					throw new Exception('Permission denied. Current user is not allowed to perform action \''.$action.'\' on '.get_class($this));
				}
			}
		}
	}
}
