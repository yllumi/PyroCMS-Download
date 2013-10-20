<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Plugin_Download extends Plugin
{
	/**
	 * download link
	 * Usage:
	 * 
	 * {{ download:link slug="slug" class="your_class" }}
	 * 
	 * @return	anchor tag
	 */
	function link()
	{
		$slug = $this->attribute('slug');
		$class = $this->attribute('class');
		$id = $this->attribute('id');
		$target = $this->attribute('target');
		
		$data = $this->db->where('slug', $slug)
						->get('download')
						->row_array();
		if($data)
			if($data['memberonly'] == 0 || is_logged_in())
				return '<a href="'.site_url('download/file/'.$slug.'/'.$data['encrypted']).'" '. (($class)? 'class="'.$class.'"' : '') . (($id)? 'id="'.$id.'"' : '') . (($target)? 'target="'.$target.'"' : '') .'>'.$data['title'].'</a>';
		
		return false;
	}
	
	/**
	 * download advance link
	 * Usage: for mor customize download link
	 * 
	 * {{ download:link slug="slug" class="your_class" }}
	 * 
	 * @return	anchor tag
	 */
	function advance_link()
	{
		$slug = $this->attribute('slug');
		
		$data = $this->db->where('slug', $slug)
						->get('download')
						->row_array();
		if($data){
			if($data['memberonly'] == 0 || is_logged_in()){	
				$data['href'] = site_url('download/file/'.$slug.'/'.$data['encrypted']);
				return array($data);
			}		
		}
		
		return false;
	}
	
	/**
	 * download count
	 * Usage:
	 * 
	 * {{ download:count slug="slug" class="your_class" }}
	 * 
	 * @return	integer 	download count result
	 */
	function count()
	{
		$slug = $this->attribute('slug');
		
		$data = $this->db->where('slug', $slug)
						->get('download')
						->row_array();
		if($data)
			return $data['count'];
		
		return "0";
	}
}

/* End of file plugin.php */