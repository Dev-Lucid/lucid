<?php

namespace DevLucid;

class Model extends \Model
{
    public function set_orm($orm)
    {
        $return = parent::set_orm($orm);
        $this->requirePermissions('select');
        return $return;
    }

    public function save()
    {
        $this->requirePermissions(($this->is_new() === true)?'insert':'update');
        return parent::save();
    }

    public function delete() {
        $this->requirePermissions('delete');
        return parent::delete();
    }

    public function hasPermissionSelect(): bool
	{
		return true;
	}

	public function hasPermissionInsert(): bool
	{
		return true;
	}

	public function hasPermissionUpdate(): bool
	{
		return true;
	}

	public function hasPermissionDelete(): bool
	{
		return true;
	}

	public function hasPermissions(string ...$actions): bool
	{
		$result = true;
		foreach ($actions as $action) {
			if (method_exists($this, 'hasPermission'.$action) === true) {
				if (call_user_func([$this, 'hasPermission'.$action]) === false) {
					$result = false;
				}
			}
		}
		return $result;
	}

	public function requirePermissions(string ...$actions)
	{
		foreach ($actions as $action) {
			if (method_exists($this, 'hasPermission'.$action) === true) {
				$result = call_user_func([$this, 'hasPermission'.$action]);
				if ($result === false) {
					throw new \Exception('Permission denied. Current user is not allowed to perform action \''.$action.'\' on '.get_class($this));
				}
			}
		}
	}
}
