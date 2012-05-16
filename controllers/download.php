<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a download module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	download Module
 */
class Download extends Public_Controller
{

	public function __construct()
	{
		parent::__construct();

		// Load the required classes
		$this->load->model('download_m');
		$this->load->model('download_history_m');
		$this->lang->load('download');
		
		//$this->template->append_css('module::download.css')->append_js('module::download.js');
	}
	
	function index($slug = null, $encrypted = null){
		//if(is_null($slug) || is_null($encrypted)) 
			//show_404();
			
		echo "sdghjskl";
	}
	
	public function file($slug = null, $encrypted = null)
	{
		$file = $this->download_m->get_by(array('slug' => $slug, 'encrypted' => $encrypted)) OR show_404();
		
		// get useragent
		$this->load->library('user_agent');
		if ($this->agent->is_browser()){
			$agent = $this->agent->browser().' '.$this->agent->version().' '.$this->agent->platform();
		} elseif ($this->agent->is_robot()) {
			$agent = $this->agent->robot().' '.$this->agent->platform();
		} elseif ($this->agent->is_mobile()) {
			$agent = $this->agent->mobile().' '.$this->agent->platform();
		} else {
			$agent = $this->agent->agent_string().' '.$this->agent->platform().' unidentified';
		}
		// insert useragent record
		$available = $this->download_history_m->check_downloaded($file->id, $agent, $this->input->ip_address());
		
		//echo time().' - '.$available->datetime; echo ' = '.(time() - $available->datetime);
		//if difference between download time 
		if(! $available || ( $available && ((time() - $available->datetime) > 2 * 60) )){ // is 2 ours
			$this->download_history_m->create($file->id, $agent, $this->input->ip_address());
			// increment the counter
			$this->download_m->update($file->id, array('count' => $file->count + 1));
		};
		redirect($file->url);
	}

}