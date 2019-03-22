<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Useraccount extends CI_Model {

    protected $table = "useraccounts";

    public function check_account($data){
    	$sql = "SELECT * FROM ".$this->table." WHERE username = '".$data['username']."' AND password = '".$data['password']."'";

    	return $this->db->query($sql)->result();
    }

	public function create($data){

		$sql = "INSERT INTO ".$this->table." (username, password) VALUES ('".$data['username']."','".$data['password']."')";

		return $this->db->query($sql);

		// return $this->db->insert($data);

	}

	public function read($id = null){
		if($id != null){
			$sql = "SELECT * FROM ".$this->table." WHERE userid = ".$id;

			return $this->db->query($sql)->result();
		}

		$sql = "SELECT * FROM ".$this->table." WHERE status = '1' ";

		return $this->db->query($sql)->result();

		// return $this->db->get($this->table);

	}

	public function update($data, $id){
		$sql = "UPDATE ".$this->table." SET username = '".$data['username']."', password = '".$data['password']."' WHERE userid = '".$userid."'";

		return $this->db->query($sql);

		// return $this->db->where('userid', $userid)->update($this->table, $data);

	}

	public function disable($id){
		$sql = "UPDATE ".$this->table." SET status = '0' WHERE userid = '".$id."'";

		return $this->db->query($sql);
	}

}
