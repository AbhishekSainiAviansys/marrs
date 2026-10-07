<?php
class blogModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	public function getblogPosts($postID,$status="")
    {
	       $this->db->select('*');
		   $this->db->from('blogs');
		   $this->db->where('postID', $postID);
		   if($status == "yes")
		   	$this->db->where('postStatus','Publish');		
		   $query = $this->db->get();		//echo $this->db->last_query();exit;
	       return $query->row_array();
	}
    public function listblogPosts($status="",$instituteID="")
    {
		   $this->db->select('*');
		   $this->db->from('blogs');
		   if($status == "yes")
		   	$this->db->where('postStatus','Publish');
			
		   if($instituteID != "")	
		    $this->db->where('instituteID',$instituteID);
			
		   $query = $this->db->get();	
	       return $query->result_array();
	}
	
	 public function insert($data , $postID='' )
    { 
	  	  if( $postID != '' )
		   {
			$this->db->where( 'postID',$postID );
			$this->db->set('modifiedDate', 'NOW()', FALSE);
			return $this->db->update('blogs', $data);	
		   }
		   else
		   {
			 $str  =  $this->db->insert('blogs', $data);	
		   }
	}
	 public function changeStatus( $postID )
    {
	   $data = array(
                      'postStatus' => 'Deleted'
			         ); 
		$this->db->where( 'postID',$postID );			 
        return $this->db->update('blogs', $data);						 
	}
	
}	