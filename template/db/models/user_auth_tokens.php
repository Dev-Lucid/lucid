<?php

use DevLucid\lucid;

class ModelUser_auth_tokens extends \DevLucid\Model implements \DevLucid\ModelInterface
{
    public static $_table     = 'user_auth_tokens';
	public static $_id_column = 'token_id';

    # Use this property to mark columns as read-only. Any attempt to set the value of the columns in this array
    # will throw an error
    public $readOnlyColumns   = ['token_id',];

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
