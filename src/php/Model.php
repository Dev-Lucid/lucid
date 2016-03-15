<?php

namespace DevLucid;

class Model extends \Model
{
    protected $select_rows = null;

    public function _run()
    {
        $this->select_rows = parent::_run();
        $this->requirePermissionSelect($this->select_rows);
        return $this->select_rows;
    }

    public function save()
    {
        if ($this->is_new() === true) {
            $this->requirePermissionInsert($this->orm->as_array());
        } else {
            $this->requirePermissionUpdate($this->orm->as_array());
        }
        return parent::save();
    }

    public function delete() {
        $this->requirePermissionDelete($this->orm->as_array());
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

    public function requirePermissionSelect($data)
    {
        if ($this->hasPermissionSelect($data) === false) {
            throw new \Exception('You do not have permission to select this row.');
        }
    }

    public function requirePermissionInsert($data)
    {
        if ($this->hasPermissionInsert($data) === false) {
            throw new \Exception('You do not have permission to insert this row.');
        }
    }

    public function requirePermissionUpdate($data)
    {
        if ($this->hasPermissionUpdate($data) === false) {
            throw new \Exception('You do not have permission to update this row.');
        }
    }

    public function requirePermissionDelete($data)
    {
        if ($this->hasPermissionDelete($data) === false) {
            throw new \Exception('You do not have permission to delete this row.');
        }
    }

	public function hasPermissions($data, string ...$actions): bool
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

	public function requirePermissions($data, string ...$actions)
	{
		foreach ($actions as $action) {
			if (method_exists($this, 'requirePermission'.$action) === true) {
				$result = call_user_func([$this, 'requirePermission'.$action], [$data]);
			}
		}
	}
}
