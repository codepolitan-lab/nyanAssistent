<?php 

/**
* Search Class
* Digunakan untuk melakukan pencarian password
*
* nyanAssistent - Password Management
* Author : Kresna Galuh D. Herlangga (@KresnaGaluh)
*/

class Search extends CI_Controller 
{
	
	/**
	* Constructor
	*/
	public function __construct()
	{
		// supaya nggak manggil disemua fungsi
		// so... model yang dipake hampir disemua fungsi akan diload disini
		parent::__construct();
		$this->load->model('user_model');	// load user_model
		$this->load->model('password_model');	// load password_model
	}
	
	
	/**
	* Menampilkan halaman pencarian
	*/
	function index()
	{
		// cek status login user
		if ($this->session->userdata('login_active_now') == '71')
		{
			// bila user dalam keadaan login
			// tentukan halaman yang akan ditampilkan
			$data['content'] = 'vw_search';
			
			// load template
			$this->load->view('template_dashboard', $data);
		}
		else
		{
			// bila user dalam keadaan tidak login
			// tampilkan pesan harus login
			redirect('login/mustlogon');
		}
	}
	
	
	/**
	* Proses pencarian
	*/
	function proses_cari()
	{
		// cek status login user
		if ($this->session->userdata('login_active_now') == '71')
		{	
			// bila user dalam keadaan login
			// ambil data kata kunci pencarian dari form pencarian
			$key = $this->input->post('key');
			
			// arahkan ke halaman pencarian dengan parameter key
			$url_pencarian = 'search/key/'.$key;	// tentukan url redirect
			redirect($url_pencarian); // redirect
		}
		else
		{
			// bila user dalam keadaan tidak login
			// tampilkan pesan harus login
			redirect('login/mustlogon');
		}
	}
	
	
	/**
	* Proses pencarian dengan parameter key sehingga data bisa dinamis sesuai dengan url
	*/
	function key($key)
	{
		// cek status login user
		if ($this->session->userdata('login_active_now') == '71')
		{		
			// bila user dalam keadaan login
			// cek ada atau tidaknya kata kunci pencarian yang menjadi parameter
			if(empty($key))
			{
				// jika kata kunci tidak ditemukan dalam url
				// arahkan ke halaman pencarian
				redirect('search');
			}
			else
			{
				// apabila ada kata kunci tertentu dalam url
				// load library enkripsi
				$this->load->library('encrypt');
			
				// ambil data berdasarkan kata kunci pencarian
				$data['query'] = $this->password_model->search($key);
				
				// inisialiasasi data yang akan ditampilkan
				$data['key'] = $key;
				$data['jumlah'] = $this->password_model->num_rows_search($key);
				$data['content'] = 'vw_cari';
				
				// load template
				$this->load->view('template_dashboard', $data);
			}
		}
		else
		{
			// bila user dalam keadaan tidak login
			// tampilkan pesan harus login
			redirect('login/mustlogon');
		}
	}
	
}

// END Search Class

/* End of file search.php */
/* Location: ./application/controllers/search.php */