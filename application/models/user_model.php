<?php

/**
* User_model Class
* Digunakan untuk memproses segala sesuatu terkait database user
*
* nyanAssistent - Password Management
* Author : Kresna Galuh D. Herlangga (@KresnaGaluh)
*/

class User_model extends CI_Model
{
	
	/**
	* Constructor
	*/
	function __construct()
	{
		parent::__construct();
	}
	
	
	// Inisialisasi nama tabel yang digunakan
	var $table = 'user';
	
	
	/**
	* Melakukan pengecekan username
	*/
	function cek_akun($username)
	{
		$query = $this->db->get_where($this->table, array('username' => $username), 1, 0);
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	
	/**
	* Melakukan pengecekan password
	*/
	function login_user($username, $password)
	{
		$query = $this->db->get_where($this->table, array('username' => $username, 'password' => $password), 1, 0);
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	
	/**
	* Mendapatkan data user
	*/
	function get_user($username)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('username', $username);
		return $this->db->get()->result();
	}
	
	
	/**
	* Update data user
	*/
	function update($user_data)
	{
		$this->db->where('id_user ', '1');
		$this->db->update($this->table, $user_data);
	}
	
}

// END User_model Class

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */