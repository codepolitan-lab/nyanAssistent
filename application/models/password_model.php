<?php

/**
* Password_model Class
* Digunakan untuk memproses segala sesuatu terkait database password
*
* nyanAssistent - Password Management
* Author : Kresna Galuh D. Herlangga (@KresnaGaluh)
*/

class Password_model extends CI_Model
{

	/**
	* Constructor
	*/
	function __construct()
	{
		parent::__construct();
	}
	
	
	// Inisialisasi nama tabel yang digunakan
	var $table = 'password';
	
	
	/**
	* Menghitung jumlah record yang ada pada tabel
	*/
	function get_num_rows()
	{
		return $this->db->count_all($this->table);
	}
	
	
	/**
	* Mendapatkan list password
	*/
	function get_list_password($num, $pg)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->limit($num, $pg);
		$this->db->order_by('id_password', 'desc');
		return $this->db->get()->result();
	}
	
	
	/**
	* insert data password
	*/
	function insert_password($user_data)
	{
		$this->db->insert($this->table, $user_data);
	}
	
	
	/**
	* Mendapatkan data password berdasarkan id_password
	*/
	function get_password($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_password', $id);
		return $this->db->get()->result();
	}
	
	
	/**
	* Menghapus password berdasarkan id_password
	*/
	function delete($id)
	{
		$this->db->where('id_password', $id);
		$this->db->delete($this->table); 
	}
	
	
	/**
	* Mengupdate data password berdasarkan id_password
	*/
	function update($id, $user_data)
	{
		$this->db->where('id_password', $id);
		$this->db->update($this->table, $user_data);
	}
	
	
	/**
	* Melakukan pencarian berdasarkan nama
	*/
	function search($cari)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->like('nama', $cari);
		$this->db->order_by('id_password', 'desc');
		return $this->db->get()->result();
	}
	
	
	/**
	* Menghitung jumlah record yang ditemukan saat pencarian
	*/
	function num_rows_search($cari)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->like('nama', $cari);
		return $this->db->count_all_results();
	}
	
}

// END Password_model Class

/* End of file password_model.php */
/* Location: ./application/models/password_model.php */