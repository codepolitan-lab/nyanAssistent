<?php 

/**
* Setting Class
* Digunakan untuk melakukan perubahan data user
*
* nyanAssistent - Password Management
* Author : Kresna Galuh D. Herlangga (@KresnaGaluh)
*/

class Setting extends CI_Controller 
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
	}
	
	
	/**
	* Menampilkan halaman setting
	*/
	function index()
	{
		// cek status login user
		if ($this->session->userdata('login_active_now') == '71')
		{	
			// bila user dalam keadaan login
			// tentukan halaman yang akan ditampilkan
			$data['content'] = 'vw_setting';
			
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
	* Menampilkan halaman edit profil
	*/
	function ubah_profil()
	{
		// cek status login user
		if ($this->session->userdata('login_active_now') == '71')
		{
			// bila user dalam keadaan login
			// ambil data user
			$query = $this->user_model->get_user($this->session->userdata('id_user_nyan_active_now'));
			
			// inisialisasi data user
			foreach ($query as $row)
			{
				$data['nama'] = $row->nama;
				$data['username'] = $row->username;
			}
			
			// tentukan halaman yang akan digunakan
			$data['content'] = 'vw_ubah_profil';
			
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
	* Proses edit profil
	*/
	function proses_ubahprofil()
	{
		// cek status login user
		if ($this->session->userdata('login_active_now') == '71')
		{	
			// bila user dalam keadaan login
			// ambil data dari fomr yang diisi
			$data['nama'] = $this->input->post('nama');
			$data['username'] = $this->input->post('username');
			
			// set aturan validasi
			$this->form_validation->set_rules('nama', 'Nama', 'required|min_length[3]');
			$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]');
			
			// cek form berdasarkan validasi yang telah ditentukan
			if ($this->form_validation->run() == TRUE)
			{
				// apabila data telah valid
				// masukan inputan ke dalam array untuk persiapan update data
				$user_data = array(
					'nama' => $data['nama'],
					'username' => $data['username']
				);
				
				// update data
				$this->user_model->update($user_data);
				
				// set sessi berdasarkan data yang telah diupdate
				$data = array('id_user_nyan_active_now' => $data['username']);
				$this->session->set_userdata($data);
				
				// set pesan konfirmasi
				$data['pesan'] = 'Data profile berhasil diperbaharui!';
				
				// tentukan halaman yang akan ditampilkan
				$data['content'] = 'vw_ubah_profil';
				
				// load template
				$this->load->view('template_dashboard', $data);
			}
			else
			{
				// apabila ada data yang tidak valid
				// tampilkan halaman yang sama dengan pesan error
				$data['content'] = 'vw_ubah_profil';
				
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
	
	
	/**
	* Tampilkan halaman ubah password
	*/
	function ubah_password()
	{
		// cek status login user
		if ($this->session->userdata('login_active_now') == '71')
		{		
			// bila user dalam keadaan login
			// tentukan halaman yang akan ditampilkan
			$data['content'] = 'vw_ubah_password';
			
			// set nilai error = 1
			$data['error'] = '1';
			
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
	* Proses ubah password
	*/
	function proses_ubahpassword()
	{
		// cek status login user
		if ($this->session->userdata('login_active_now') == '71')
		{		
			// bila user dalam keadaan login
			// ambil data dari form yang diisi
			$data['password_lama'] = $this->input->post('password_lama');
			$data['password_baru'] = $this->input->post('password_baru');
			$data['password_konf'] = $this->input->post('password_konf');
			
			// tentukan aturan validasi
			$this->form_validation->set_rules('password_lama', 'Password Lama', 'required|min_length[3]');
			$this->form_validation->set_rules('password_baru', 'Password Baru', 'required|min_length[4]');
			$this->form_validation->set_rules('password_konf', 'Konfirmasi Password', 'required|matches[password_baru]');
			
			// cek data masukan berdasarkan aturan validasi yang dibuat
			if ($this->form_validation->run() == TRUE)
			{
				// apabila data valid
				// enkripsi data password lama user
				$encr = "aplikasi~nyankod~nyankodMagz~edisi~12";
				$passwordx = $data['password_lama'] . $encr;
				$passwordx = strtoupper($passwordx);
				$passwordx = md5($passwordx);
				$passwordx = strrev($passwordx);
				
				// cek apakah password lama sesuai
				if ($this->user_model->login_user($this->session->userdata('id_user_nyan_active_now'), $passwordx) == TRUE)
				{
					// apabila password lama benar
					// buat enkripsi dari password baru
					$encr2 = "aplikasi~nyankod~nyankodMagz~edisi~12";
					$passwordx2 = $data['password_baru'] . $encr2;
					$passwordx2 = strtoupper($passwordx2);
					$passwordx2 = md5($passwordx2);
					$passwordx2 = strrev($passwordx2);
				
					// masukan data password baru ke dalam array
					$user_data = array(
						'password' => $passwordx2
					);
					
					// proses ubah password di database
					$this->user_model->update($user_data);
					
					// konfirmasi pesan sukses
					$data['pesan'] = '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>';
					$data['pesan'] .= 'Password berhasil diperbaharui!</div>';
					
					// tentukan halaman yang akan dibuka
					$data['content'] = 'vw_ubah_password';
					
					// set error = 0
					$data['error'] = '0';
					
					// load template
					$this->load->view('template_dashboard', $data);
				}
				else
				{
					// apabila password lama salah
					// setting pesan error
					$data['pesan'] = '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>';
					$data['pesan'] .= 'Password lama salah!</div>';
					
					// tentukan halaman yang akan digunakan
					$data['content'] = 'vw_ubah_password';
					
					// set error = 1
					$data['error'] = '1';
			
					// load template
					$this->load->view('template_dashboard', $data);
				}
			}
			else
			{
				// apabila ada data yang tidak valid
				// tampilkan halaman yang sama dengan pesan error
				$data['content'] = 'vw_ubah_password';
				
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

// END Setting Class

/* End of file setting.php */
/* Location: ./application/controllers/setting.php */