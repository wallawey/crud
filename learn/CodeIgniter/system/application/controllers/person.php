<?php
class Person extends Controller {

	// num of records per page
	private $limit = 10;
	
	function Person(){
		parent::Controller();
		
		// load library
		$this->load->library(array('table','validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('personModel','',TRUE);
	}
	
	function index($offset = 0){
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$persons = $this->personModel->get_paged_list($this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('person/index/');
 		$config['total_rows'] = $this->personModel->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Name', 'Gender', 'Date of Birth (dd-mm-yyyy)', 'Actions');
		$i = 0 + $offset;
		foreach ($persons as $person){
			$this->table->add_row(++$i, $person->name, strtoupper($person->gender)=='M'? 'Male':'Female', date('d-m-Y',strtotime($person->dob)), 
				anchor('person/view/'.$person->id,'view',array('class'=>'view')).' '.
				anchor('person/update/'.$person->id,'update',array('class'=>'update')).' '.
				anchor('person/delete/'.$person->id,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this person?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view
		$this->load->view('personList', $data);
	}
	
	function add(){
		// set validation properties
		$this->_set_fields();
		
		// set common properties
		$data['title'] = 'Add new person';
		$data['message'] = '';
		$data['action'] = site_url('person/addPerson');
		$data['link_back'] = anchor('person/index/','Back to list of persons',array('class'=>'back'));
	
		// load view
		$this->load->view('personEdit', $data);
	}
	
	function addPerson(){
		// set common properties
		$data['title'] = 'Add new person';
		$data['action'] = site_url('person/addPerson');
		$data['link_back'] = anchor('person/index/','Back to list of persons',array('class'=>'back'));
		
		// set validation properties
		$this->_set_fields();
		$this->_set_rules();
		
		// run validation
		if ($this->validation->run() == FALSE){
			$data['message'] = '';
		}else{
			// save data
			$person = array('name' => $this->input->post('name'),
							'gender' => $this->input->post('gender'),
							'dob' => date('Y-m-d', strtotime($this->input->post('dob'))));
			$id = $this->personModel->save($person);
			
			// set form input name="id"
			$this->validation->id = $id;
			
			// set user message
			$data['message'] = '<div class="success">add new person success</div>';
		}
		
		// load view
		$this->load->view('personEdit', $data);
	}
	
	function view($id){
		// set common properties
		$data['title'] = 'Person Details';
		$data['link_back'] = anchor('person/index/','Back to list of persons',array('class'=>'back'));
		
		// get person details
		$data['person'] = $this->personModel->get_by_id($id)->row();
		
		// load view
		$this->load->view('personView', $data);
	}
	
	function update($id){
		// set validation properties
		$this->_set_fields();
		
		// prefill form values
		$person = $this->personModel->get_by_id($id)->row();
		$this->validation->id = $id;
		$this->validation->name = $person->name;
		$_POST['gender'] = strtoupper($person->gender);
		$this->validation->dob = date('d-m-Y',strtotime($person->dob));
		
		// set common properties
		$data['title'] = 'Update person';
		$data['message'] = '';
		$data['action'] = site_url('person/updatePerson');
		$data['link_back'] = anchor('person/index/','Back to list of persons',array('class'=>'back'));
	
		// load view
		$this->load->view('personEdit', $data);
	}
	
	function updatePerson(){
		// set common properties
		$data['title'] = 'Update person';
		$data['action'] = site_url('person/updatePerson');
		$data['link_back'] = anchor('person/index/','Back to list of persons',array('class'=>'back'));
		
		// set validation properties
		$this->_set_fields();
		$this->_set_rules();
		
		// run validation
		if ($this->validation->run() == FALSE){
			$data['message'] = '';
		}else{
			// save data
			$id = $this->input->post('id');
			$person = array('name' => $this->input->post('name'),
							'gender' => $this->input->post('gender'),
							'dob' => date('Y-m-d', strtotime($this->input->post('dob'))));
			$this->personModel->update($id,$person);
			
			// set user message
			$data['message'] = '<div class="success">update person success</div>';
		}
		
		// load view
		$this->load->view('personEdit', $data);
	}
	
	function delete($id){
		// delete person
		$this->personModel->delete($id);
		
		// redirect to person list page
		redirect('person/index/','refresh');
	}
	
	// validation fields
	function _set_fields(){
		$fields['id'] = 'id';
		$fields['name'] = 'name';
		$fields['gender'] = 'gender';
		$fields['dob'] = 'dob';
		
		$this->validation->set_fields($fields);
	}
	
	// validation rules
	function _set_rules(){
		$rules['name'] = 'trim|required';
		$rules['gender'] = 'trim|required';
		$rules['dob'] = 'trim|required|callback_valid_date';
		
		$this->validation->set_rules($rules);
		
		$this->validation->set_message('required', '* required');
		$this->validation->set_message('isset', '* required');
		$this->validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
	// date_validation callback
	function valid_date($str)
	{
		if(!ereg("^(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-([0-9]{4})$", $str))
		{
			$this->validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
			return false;
		}
		else
		{
			return true;
		}
	}
}
?>