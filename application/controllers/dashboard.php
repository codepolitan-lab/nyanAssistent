<?php 

/**
* Dashboard Class
* Digunakan untuk memproses penambahan password, edit password dan delete password
*
* nyanAssistent - Password Management
* Author : Kresna Galuh D. Herlangga (@KresnaGaluh)
*/

class Dashboard extends CI_Controller 
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
	* Menampilkan halaman dashboard setelah login
	*/
	function index()
	{
		// cek status login user
		if ($this->session->userdata('login_active_now') == '71')
		{
			// bila user dalam keadaan login
			// load library enkripsi
			$this->load->library('encrypt');
			
			// hitung jumlah password yang tersimpan di database
			$data['jumlah'] = $this->password_model->get_num_rows();
		
			// atur paginasi
			$config['base_url'] = site_url('dashboard/index'); // set base_url paginasi
			$config['total_rows'] = $data['jumlah']; // jumlah rows
			$config['per_page'] = '5'; // jumlah data yang ditampilkan per halaman
			$config['uri_segment'] = 3; // segment yang digunakan
			$this->pagination->initialize($config); // inisialisasi paginasi
			$data['paginasi'] = $this->pagination->create_links();
			
			// ambil data dari database
			$data['pg_query'] = $this->password_model->get_list_password($config['per_page'], $this->uri->segment(3));
			
			// tentukan bagian konten yang akan digunakan
			$data['content'] = 'vw_home';
			
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
	* Menampilkan halaman penambahan password
	*/
	function add()
	{
		// cek status login user
		if ($this->session->userdata('login_active_now') == '71')
		{
			// bila user dalam keadaan login
			// tentukan konten yang ditampilkan
			$data['content'] = 'vw_add';
			
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
	* Proses penambahan password
	*/
	function proses_add()
	{
		// cek status login user
		if ($this->session->userdata('login_active_now') == '71')
		{
			// bila user dalam keadaan login
			// dapatkan data dari form yang diisi
			$data['nama'] = $this->input->post('nama');
			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');
			$data['password_konf'] = $this->input->post('password_konf');
			$data['keterangan'] = $this->input->post('keterangan');
			
			// tentukan aturan validasi
			$this->form_validation->set_rules('nama', 'Nama Password', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password_konf', 'Konfirmasi Password', 'required|matches[password]');
		
			// cek form sesuai dengan aturan validasi yang dibuat
			if ($this->form_validation->run() == TRUE)
			{
				// bila form tervalidasi sempurna
				// load library enkripsi
				$this->load->library('encrypt');
				
				// enkripsi username
				$username_enk = $this->encrypt->encode($data['username']);
				
				// enkripsi password
				$password_enk = $this->encrypt->encode($data['password']);
				
				// persiapkan untuk penginputan data password dengan array
				$user_data = array(
					'nama' => $data['nama'],
					'username' => $username_enk,
					'password' => $password_enk,
					'keterangan' => $data['keterangan']
				);
				
				// insert data dengan fungsi insert_model dari password_model
				$this->password_model->insert_password($user_data);
				
				// tampilkan pesan konfirmasi sukses
				$data['pesan'] = 'Password baru berhasil ditambahkan! ';
				$data['isi'] = '<p>Adapun datanya adalah sebagai berikut:</p><table cellpadding="8" style="margin-left:10px;">';
				$data['isi'] .= '<tr><td>Nama Password</td><td>'.$data['nama'].'</td></tr>';
				$data['isi'] .= '<tr><td>Username</td><td>'.$data['username'].'</td></tr>';
				$data['isi'] .= '<tr><td>Password</td><td>'.$data['password'].'</td></tr>';
				$data['isi'] .= '<tr><td>Keterangan</td><td>'.$data['keterangan'].'</td></tr></table>';
				
				// tentukan konten yang akan ditampilkan yaitu halaman konfirmasi
				$data['content'] = 'vw_konfirmasi';
			
				// load template
				$this->load->view('template_dashboard', $data);
			}
			else
			{
				//bila form tidak tervalidasi dengan sempurna
				// tampilkan masih halaman yang sama
				$data['content'] = 'vw_add';
			
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
	* Tampilkan halaman delete password
	*/
	function delete($id)
	{
		// cek status login user
		if ($this->session->userdata('login_active_now') == '71')
		{	
			// bila user dalam keadaan login
			// load library enkripsi
			$this->load->library('encrypt');
			
			// ambil data password berdasarkan id_password
			$data['query'] = $this->password_model->get_password($id);
		
			// tentukan halaman hapus password
			$data['content'] = 'vw_delete';
			
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
	* Proses delete password
	*/
	function proses_delete()
	{
		// cek status login user
		if ($this->session->userdata('login_active_now') == '71')
		{		
			// bila user dalam keadaan login
			// ambil data dari form
			$id = $this->input->post('id_password');
			$nama = $this->input->post('nama');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$keterangan = $this->input->post('keterangan');
			
			// hapus password berdasarkan id_password
			$data['query'] = $this->password_model->delete($id);
			
			// tampilkan pesan konfirmasi sukses
			$data['pesan'] = 'Password  telah berhasil dihapus! ';
			$data['isi'] = '<p>Berikut data password yang telah berhasil dihapus:</p><table cellpadding="8" style="margin-left:10px;">';
			$data['isi'] .= '<tr><td>Nama Password</td><td>'.$nama.'</td></tr>';
			$data['isi'] .= '<tr><td>Username</td><td>'.$username.'</td></tr>';
			$data['isi'] .= '<tr><td>Password</td><td>'.$password.'</td></tr>';
			$data['isi'] .= '<tr><td>Keterangan</td><td>'.$keterangan.'</td></tr></table>';
		
			// tentukan halaman yang digunakan
			$data['content'] = 'vw_konfirmasi';
			
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
	* Tampilkan halaman edit
	*/
	function edit($id)
	{
		// cek status login user
		if ($this->session->userdata('login_active_now') == '71')
		{
			// bila user dalam keadaan login
			// load library enkripsi
			$this->load->library('encrypt');
			
			// ambil data password
			$query = $this->password_model->get_password($id);
			
			foreach ($query as $row)
			{
				//dekripsi username
				$username_dek = $this->encrypt->decode($row->username);	
				
				//dekripsi password
				$password_dek = $this->encrypt->decode($row->password);	
				
				// siapkan data
				$data['id_password'] = $id;
				$data['nama'] = $row->nama;
				$data['username'] = $username_dek;
				$data['password'] = $password_dek;
				$data['password_konf'] = $password_dek;
				$data['keterangan'] = $row->keterangan;
			}
		
			// tentukan halaman yang akan digunakan
			$data['content'] = 'vw_edit';
			
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
	* Proses edit password
	*/
	function proses_edit()
	{
		// cek status login user
		if ($this->session->userdata('login_active_now') == '71')
		{	
			// bila user dalam keadaan login
			// ambil data dari form yang diisi
			$data['id_password'] = $this->input->post('id_password');
			$data['nama'] = $this->input->post('nama');
			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');
			$data['password_konf'] = $this->input->post('password_konf');
			$data['keterangan'] = $this->input->post('keterangan');
			
			// setting aturan validasi
			$this->form_validation->set_rules('nama', 'Nama Password', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password_konf', 'Konfirmasi Password', 'matches[password]');
		
			// cek validasi berdasarkan aturan
			if ($this->form_validation->run() == TRUE)
			{
				// bila form tervalidasi sempurna
				// load library enkripsi
				$this->load->library('encrypt');
				
				// enkripsi username
				$username_enk = $this->encrypt->encode($data['username']);
				
				// enkripsi password
				$password_enk = $this->encrypt->encode($data['password']);		
					
				// masukan data inputan ke dalam array
				$user_data = array(
					'nama' => $data['nama'],
					'username' => $username_enk,
					'password' => $password_enk,
					'keterangan' => $data['keterangan']
				);
				
				// update data password
				$this->password_model->update($data['id_password'], $user_data);
				
				// tampilkan pesan konfirmasi
				$data['pesan'] = 'Data password berhasil  diperbaharui! ';
				$data['isi'] = '<p>Adapun datanya adalah sebagai berikut:</p><table cellpadding="8" style="margin-left:10px;">';
				$data['isi'] .= '<tr><td>Nama Password</td><td>'.$data['nama'].'</td></tr>';
				$data['isi'] .= '<tr><td>Username</td><td>'.$data['username'] .'</td></tr>';
				$data['isi'] .= '<tr><td>Password</td><td>'.$data['password'].'</td></tr>';
				$data['isi'] .= '<tr><td>Keterangan</td><td>'.$data['keterangan'].'</td></tr></table>';
				
				// tentukan halaman yang digunakan
				$data['content'] = 'vw_konfirmasi';
			
				// load template
				$this->load->view('template_dashboard', $data);
				
			}
			else
			{
				//bila form tidak tervalidasi dengan sempurna
				// tampilkan halaman yang sama dengan pesan error
				$data['content'] = 'vw_edit';
			
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

// END Dashboard Class

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */