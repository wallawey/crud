<?php
class PersonModel extends CI_Model {
	
	private $tbl_person= 'tbl_person';
	
	function Person(){
		parent::Model();
	}
	
	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($tbl_person);
	}
	
	function count_all(){
		return $this->db->count_all($this->tbl_person);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
	   
	   if($offset == ''){$offset = 0;}
	   $sql = "SELECT * FROM tbl_person limit ".$limit." offset ".$offset." ;";

       return $this->db->query($sql); 
	
		//$this->db->order_by('id','asc');
		//return $this->db->get($this->tbl_person, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->tbl_person);
	}
	
	function save($person){
		$this->db->insert($this->tbl_person, $person);
		return $this->db->insert_id();
	}
	
	function update($id, $person){
		$this->db->where('id', $id);
		$this->db->update($this->tbl_person, $person);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_person);
	}
}
?>
