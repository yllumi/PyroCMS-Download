<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a download module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	download Module
 */
class Download_history_m extends MY_Model {

	public function __construct()
	{		
		parent::__construct();
		
		/**
		 * If the download module's table was named "downloads"
		 * then MY_Model would find it automatically. Since
		 * I named it "download" then we just set the name here.
		 */
		$this->_table = 'download_history';
	}
	
	//create a new item
	public function create($id, $useragent, $ip_address)
	{
		$to_insert = array(
			'download_id' => $id,
			'useragent' => $useragent,
			'ip_address' => $ip_address,
			'datetime' => time()
		);

		return $this->insert($to_insert);
	}

	//make sure the slug is valid
	public function check_downloaded($id, $useragent, $ip_address)
	{
		$has_download = $this->order_by('datetime', 'desc')
							->get_by(
			array(
				'download_id' => $id,
				'useragent' => $useragent,
				'ip_address' => $ip_address
			)
		);

		return $has_download;
	}
	
}
