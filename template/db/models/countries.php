<?php

use DevLucid\lucid;

class ModelCountries extends \DevLucid\Model implements \DevLucid\ModelInterface
{
    public static $_table     = 'countries';
	public static $_id_column = 'country_id';

    # Use this property to mark columns as read-only. Any attempt to set the value of the columns in this array
    # will throw an error
    public $readOnlyColumns   = ['country_id',];

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
