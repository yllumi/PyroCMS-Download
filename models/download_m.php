<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a download module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	download Module
 */
class Download_m extends MY_Model {

	public function __construct()
	{		
		parent::__construct();
		
		/**
		 * If the download module's table was named "downloads"
		 * then MY_Model would find it automatically. Since
		 * I named it "download" then we just set the name here.
		 */
		$this->_table = 'download';
		$this->load->helper('string');
	}
	
	//create a new item
	public function create($input)
	{
		$to_insert = array(
			'title' => $input['title'],
			'slug' => $this->_check_slug($input['slug']),
			'url' => $input['url'],
			//'source' => $input['source'],
			'status' => $input['status'],
			'memberonly' => $input['memberonly'],
			'encrypted' => random_string('alnum', 16)
		);

		return $this->db->insert('download', $to_insert);
	}

	//make sure the slug is valid
	public function _check_slug($slug)
	{
		$slug = strtolower($slug);
		$slug = preg_replace('/\s+/', '-', $slug);

		return $slug;
	}
	
}
