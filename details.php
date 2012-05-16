<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Download extends Module {

	public $version = '1.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Download',
				'id' => 'Unduhan'
			),
			'description' => array(
				'en' => 'Let you count and record download history of any file inside or external links',
				'id' => 'Memungkinkan Anda untuk mencatat setiap riwayat unduhan dari file atau file external'
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => 'utilities',
			'shortcuts' => array(
				'create' => array(
					'name' 	=> 'download:add',
					'uri' 	=> 'admin/download/add',
					'class' => 'add'
				)
			)
		);
	}

	public function install()
	{
		// this data is very important records, so keep it in database
		//$this->dbforge->drop_table('download');
		//$this->dbforge->drop_table('download_history');

		$tables = array(
			'download' => array(
                    'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'primary' => true),
					'title' => array('type' => 'VARCHAR', 'constraint' => 100, 'null' => false, 'unique' => true),
					'slug' => array('type' => 'VARCHAR', 'constraint' => 100, 'null' => false, 'unique' => true),
					'url' => array('type' => 'VARCHAR', 'constraint' => 250, 'null' => false, 'unique' => true),
					'source' => array('type' => 'ENUM', 'constraint' => array('internal', 'external'), 'default' => 'external'),
					'status' => array('type' => 'ENUM', 'constraint' => array('active', 'inactive'), 'default' => 'active'),
					'count' => array('type' => 'INT', 'constraint' => 11, 'default' => 0),
					'memberonly' => array('type' => 'ENUM', 'constraint' => array(1, 0), 'default' => 0),
					'encrypted' => array('type' => 'VARCHAR', 'constraint' => 16)
					
			),
			'download_history' => array(
					'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'primary' => true),
					'download_id' => array('type' => 'INT', 'constraint' => 11, 'key' => true, 'null' => false),
					'useragent' => array('type' => 'VARCHAR', 'constraint' => 250, 'null' => false),
					'ip_address' => array('type' => 'VARCHAR', 'constraint' => 15, 'null' => false),
					'datetime' => array('type' => 'INT', 'constraint' => 10)
			)
		);

		if ( ! $this->install_tables($tables))
		{
			return false;
		}
		
		return true;
	}

	public function uninstall()
	{
		// this data is very important, so if you uninstall it, all data will be lost
		if($this->dbforge->drop_table('download') && $this->dbforge->drop_table('download_history'))
			return TRUE;
			
		return FALSE;
	}


	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}
}
/* End of file details.php */
