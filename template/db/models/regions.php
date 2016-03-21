<?php

use DevLucid\lucid;

class ModelRegions extends \DevLucid\Model implements \DevLucid\ModelInterface
{
    public static $_table     = 'regions';
	public static $_id_column = 'region_id';

    # Use this property to mark columns as read-only. Any attempt to set the value of the columns in this array
    # will throw an error
    public $readOnlyColumns   = ['region_id',];

    # Use this property to mark columns as write-once only. This allows a column to be set as long as its value is null.
    public $writeOnceColumns  = [];

    public function hasPermissionSelect(array $rowData): bool
    {
        return true;
    }

    public function hasPermissionInsert(array $rowData): bool
    {
        return true;
    }

    public function hasPermissionUpdate(array $rowData): bool
    {
        return true;
    }

    public function hasPermissionDelete(array $rowData): bool
    {
        return true;
    }
}
