<?php
class eventModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	public function geteventPosts( $eventID )
    {
	       $this->db->select('*');
		   $this->db->from('events');
		   $this->db->where('eventID', $eventID);
		   $query = $this->db->get();
	       return $query->row_array();
	}
    public function listeventPosts($params=array())
    {
		
		$this->db->select('*');
		$this->db->from('events');
		if(!empty($params)){
			$displayFromDate	=	$params['displayFromDate'];
			$displayToDate		=	$params['displayToDate'];
			$eventStatus		=	$params['eventStatus'];
			$this->db->where('eventStatus', $eventStatus);
		 	$this->db->where('displayFromDate <=', $displayFromDate);
			$this->db->where('displayToDate >=', $displayToDate);
		}
		$this->db->where_not_in('eventStatus', 'Deleted');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	 public function insert($data , $eventID='' )
    { 
	  	  if( $eventID != '' )
		   {
			$this->db->where( 'eventID',$eventID );
			$this->db->set('modifiedDate', 'NOW()', FALSE);
			return $this->db->update('events', $data);	
		   }
		   else
		   {
			 $str  =  $this->db->insert('events', $data);	
		   }
	}
	 public function changeStatus( $eventID )
    {
	   $data = array(
                      'eventStatus' => 'Deleted'
			         ); 
		$this->db->where( 'eventID',$eventID );			 
        return $this->db->update('events', $data);						 
	}
	
	 public function getParentsmails( $instituteID )
    {
	    $this->db->select('guardianEmailID');
		$this->db->from('students');
		$this->db->where('instituteID', $instituteID);
		$query = $this->db->get();
		return $query->result_array();
	}
	
}	