<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a download module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	download Module
 */
class Admin extends Admin_Controller
{
	protected $section = 'items';

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('download_m');
		$this->load->library('form_validation');
		$this->lang->load('download');

		// Set the validation rules
		$this->item_validation_rules = array(
			array(
				'field' => 'title',
				'label' => lang('download:title'),
				'rules' => 'trim|max_length[100]|required'
			),
			array(
				'field' => 'slug',
				'label' => lang('download:slug'),
				'rules' => 'trim|max_length[100]|required'
			),
			array(
				'field' => 'url',
				'label' => lang('download:url'),
				'rules' => 'trim|max_length[250]|required'
			),
			//array(
			//	'field' => 'source',
			//	'label' => lang('download:source'),
			//	'rules' => 'trim'
			//),
			array(
				'field' => 'status',
				'label' => lang('download:status'),
				'rules' => 'trim|required'
			),
			array(
				'field' => 'memberonly',
				'label' => lang('download:memberonly'),
				'rules' => 'trim|required'
			)
		);

		// We'll set the partials and metadata here since they're used everywhere
		$this->template->append_js('module::admin.js')->append_css('module::admin.css');
	}

	/**
	 * List all items
	 */
	public function index()
	{
		// here we use MY_Model's get_all() method to fetch everything
		$items = $this->download_m->get_all();

		// Build the view with download/views/admin/items.php
		$data['items'] = $items;
		$this->template->title($this->module_details['name'])
						->build('admin/items', $data);
	}

	public function add()
	{
		// Set the validation rules from the array above
		$this->form_validation->set_rules($this->item_validation_rules);
		

		// check if the form validation passed
		if($this->form_validation->run())
		{
			// See if the model can create the record
			if($this->download_m->create($this->input->post()))
			{
				// All good...
				$this->session->set_flashdata('success', lang('download.success'));
				redirect('admin/download');
			}
			// Something went wrong. Show them an error
			else
			{
				$this->session->set_flashdata('error', lang('download.error'));
				redirect('admin/download/create');
			}
		}
		
		foreach ($this->item_validation_rules AS $rule)
		{
			$data->{$rule['field']} = $this->input->post($rule['field']);
		}

		// Build the view using download/views/admin/form.php
		$this->template->title($this->module_details['name'], lang('download.new_item'))
						->build('admin/form', $data);
	}
	
	public function edit($id = 0)
	{
		$data = $this->download_m->get($id);

		// Set the validation rules from the array above
		$this->form_validation->set_rules($this->item_validation_rules);

		// check if the form validation passed
		if($this->form_validation->run())
		{
			// get rid of the btnAction item that tells us which button was clicked.
			// If we don't unset it MY_Model will try to insert it
			unset($_POST['btnAction']);
			
			// See if the model can create the record
			if($this->download_m->update($id, $this->input->post()))
			{
				// All good...
				$this->session->set_flashdata('success', lang('download.success'));
				redirect('admin/download');
			}
			// Something went wrong. Show them an error
			else
			{
				$this->session->set_flashdata('error', lang('download.error'));
				redirect('admin/download/create');
			}
		}

		// Build the view using download/views/admin/form.php
		$this->template->title($this->module_details['name'], lang('download.edit'))
						->build('admin/form', $data);
	}
	
	public function delete($id = 0)
	{
		// make sure the button was clicked and that there is an array of ids
		if (isset($_POST['btnAction']) AND is_array($_POST['action_to']))
		{
			// pass the ids and let MY_Model delete the items
			$this->download_m->delete_many($this->input->post('action_to'));
		}
		elseif (is_numeric($id))
		{
			// they just clicked the link so we'll delete that one
			$this->download_m->delete($id);
		}
		redirect('admin/download');
	}
	
}
