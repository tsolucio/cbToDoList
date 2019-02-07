<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
require_once 'data/CRMEntity.php';
require_once 'data/Tracker.php';
require_once 'include/utils/utils.php';
include_once 'vtlib/Vtiger/Module.php';

class cbToDoList extends CRMEntity {

	public $db;
	public $log;
	public $table_name = 'vtiger_cbtodolist';
	public $table_index= 'cbtodolistid';
	public $column_fields = array();
	public $IsCustomModule = true;
	public $HasDirectImageField = false;
	public $customFieldTable = array('vtiger_cbtodolistcf', 'cbtodolistid');
	public $tab_name = array('vtiger_crmentity', 'vtiger_cbtodolist', 'vtiger_cbtodolistcf');
	public $tab_name_index = array(
		'vtiger_crmentity' => 'crmid',
		'vtiger_cbtodolist'   => 'cbtodolistid',
		'vtiger_cbtodolistcf' => 'cbtodolistid',
	);

	public $list_fields = array(
		'To Do No'=> array('cbtodolist' => 'cbtodolistno'),
		'To Do Event' => array('cbtodolist' => 'todo'),
		'URL' => array('cbtodolist' => 'url'),
		'Type' => array('cbtodolist' => 'todotype'),
		'Collection' => array('cbtodolist' => 'collection'),
		'Assigned To' => array('crmentity' => 'smownerid')
	);
	public $list_fields_name = array(
		'To Do No' => 'cbtodolistno',
		'To Do Event' => 'todo',
		'URL' => 'url',
		'Type' => 'todotype',
		'Collection' => 'collection',
		'Assigned To' => 'assigned_user_id'
	);

	public $list_link_field = 'cbtodolistno';

	public $search_fields = array(
		'To Do No'=> array('cbtodolist' => 'cbtodolistno'),
		'To Do Event'=> array('cbtodolist' => 'todo'),
		'URL'=> array('cbtodolist' => 'url'),
		'Type'=> array('cbtodolist' => 'todotype'),
		'Collection'=> array('cbtodolist' => 'collection'),
		'Assigned To'=> array('crmentity' => 'smownerid'),
	);
	public $search_fields_name = array(
		'To Do No'=> 'cbtodolistno',
		'To Do Event'=> 'todo',
		'URL' => 'url',
		'Type'=> 'todotype',
		'Collection'=> 'collection',
		'Assigned To'=> 'smownerid'
	);

	public $popup_fields = array('cbtodolistno', 'todo', 'url', 'todotype', 'collection', 'assigned_user_id');
	public $sortby_fields = array();
	public $def_basicsearch_col;

	public $def_detailview_recname;
	public $required_fields = array();
	public $special_functions = array('set_import_assigned_user');

	public $default_order_by = 'cbtodolistno';
	public $default_sort_order='ASC';
	public $mandatory_fields = array('createdtime', 'modifiedtime', 'cbtodolistno');

	public function save_module($module) {
		global $adb, $current_user;
		if ($this->HasDirectImageField) {
			$this->insertIntoAttachment($this->id, $module);
		}
	}
	/**
	 * Invoked when special actions are performed on the module.
	 * @param String Module name
	 * @param String Event Type (module.postinstall, module.disabled, module.enabled, module.preuninstall)
	 */
	public function vtlib_handler($modulename, $event_type) {
		if ($event_type == 'module.postinstall') {
			// TODO Handle post installation actions
			require_once 'include/utils/utils.php';
				global $adb;
				$this->setModuleSeqNumber('configure', $modulename, 'TODO-', '00000001');
				include_once 'vtlib/Vtiger/Module.php';
				// Mark the module as Standard module
				$adb->pquery('UPDATE vtiger_tab SET customized=0 WHERE name=?', array($modulename));
				//adds sharing accsess
		} elseif ($event_type == 'module.disabled') {
			// TODO Handle actions when this module is disabled.
		} elseif ($event_type == 'module.enabled') {
			// TODO Handle actions when this module is enabled.
		} elseif ($event_type == 'module.preuninstall') {
			// TODO Handle actions when this module is about to be deleted.
		} elseif ($event_type == 'module.preupdate') {
			// TODO Handle actions before this module is updated.
		} elseif ($event_type == 'module.postupdate') {
			// TODO Handle actions after this module is updated.
		}
	}
}
?>
