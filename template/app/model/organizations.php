<?php
namespace App\Model;
use App\App, Lucid\Lucid, Lucid\Html\html;

class Organizations extends \App\Model
{
    public static $_table     = 'organizations';
	public static $_id_column = 'org_id';

    # Use this property to mark columns as read-only. Any attempt to set the value of the columns in this array
    # will throw an error
    public $readOnlyColumns   = ['org_id',];

    # Use this property to mark columns as write-once only. This allows a column to be set as long as its value is null.
    public $writeOnceColumns  = [];

    public function hasPermissionSelect(array $rowData): bool
    {
        # By default, admins can select anything
        if (lucid::$app->permission()->isAdmin() === true) {
            return true;
        }

        # add your rules here. Ex: return ($rowData['org_id'] == lucid::$app->session()->int('org_id'));
        return true;
    }

    public function hasPermissionInsert(array $rowData): bool
    {
        # By default, admins can insert anything
        if (lucid::$app->permission()->isAdmin() === true) {
            return true;
        }

        # add your rules here. Ex: return ($rowData['org_id'] == lucid::$app->session()->int('org_id'));
        return true;
    }

    public function hasPermissionUpdate(array $rowData): bool
    {
        # By default, admins can update anything
        if (lucid::$app->permission()->isAdmin() === true) {
            return true;
        }

        # add your rules here. Ex: return ($rowData['org_id'] == lucid::$app->session()->int('org_id'));
        return true;
    }

    public function hasPermissionDelete(array $rowData): bool
    {
        # By default, admins can delete anything
        if (lucid::$app->permission()->isAdmin() === true) {
            return true;
        }

        # add your rules here. Ex: return ($rowData['org_id'] == lucid::$app->session()->int('org_id'));
        return true;
    }
}
