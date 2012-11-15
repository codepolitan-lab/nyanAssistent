<?php 

/**
* Login Class
* Digunakan untuk memproses segala sesuatu terkait Login
*
* nyanAssistent - Password Management
* Author : Kresna Galuh D. Herlangga (@KresnaGaluh)
*/

class Login extends CI_Controller 
{
	
	/**
	* Constructor
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');	//meload user_model
	}
	
	
	/**
	* Menampilkan halaman login
	*/
	function index()
	{
		// cek status login user
		if ($this->session->userdata('login_active_now') == '71')
		{	
			// arahkan ke halaman dashboard
			redirect('dashboard'); 
		}
		else
		{
			// bila user dalam keadaan tidak login
			// tampilkan halaman login
			$data['pesan_error'] = '';
			$data['username'] = '';
			$data['password'] = '';
			
			$this->load->view('template_login', $data);
		}
	}
	
	
	/**
	* Memproses login
	*/
	function process_login()
	{	
		// tangkap data login
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		
		// Set aturan untuk validasi
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		// enkripsi password masuk
		$encr = "aplikasi~nyankod~nyankodMagz~edisi~12";
		$passwordx = $data['password'] . $encr;
		$passwordx = strtoupper($passwordx);
		$passwordx = md5($passwordx);
		$passwordx = strrev($passwordx);
	
		// mengecek kevalidan data berdasarkan aturan yang telah diset sebelumnya
		if ($this->form_validation->run() == TRUE)
		{
			// bila data telah sesuai dengan aturan validasi
			// memeriksa username
			if ($this->user_model->cek_akun($data['username']) == TRUE)
			{
				// bila username benar
				// memeriksa password
				if ($this->user_model->login_user($data['username'], $passwordx) == TRUE)
				{
					// bila password bener
					$data = array('id_user_nyan_active_now' => $data['username'], 'login_active_now' => '71');
					$this->session->set_userdata($data);
					redirect('dashboard'); 
				}
				else
				{
					// bila password salah
					// tampilkan pesan error
					$data['pesan_error'] = '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>Password yang dimasukan salah!</div>';
					$this->load->view('template_login', $data);
				}
			}
			else
			{
				// bila username salah
				// tampilkan pesan error
				$data['pesan_error'] = '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>Username yang dimasukan salah!</div>';
				$this->load->view('template_login', $data);
			}
		}
		else
		{
			// bila ada data yang tidak sesuai dengan aturan validasi
			// tampilkan pesan error
			$data['pesan_error'] = '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>Username dan atau password tidak terisi dengan benar!</div>';
			$this->load->view('template_login', $data);
		}
	}
	
	
	/**
	* Memproses logout
	*/
	function logout()
	{
		// hapus semua sessi
		$this->session->sess_destroy();
		
		// tampilkan halaman logout
		$this->load->view('vw_logout');
	}
	
	
	/**
	* Menampilkan pesan harus login
	*/
	function mustlogon()
	{
		// tampilkan pesan harus login
		$this->load->view('vw_must_login');
	}

	
}

// END Login Class

/* End of file login.php */
/* Location: ./application/controllers/login.php */