<div class="alert">
	<p><strong>nyanAssistent ~Password Management</strong> adalah apikasi sederhana untuk memengolah daftar password yang dimiliki user.
	Data password yang ada di nyanAssistent telah dienkripsi dan dijamin kerahasiaannya. nyanAssistent dibangun untuk memfasilitasi Anda yang 
	memiliki banyak akun sehingga dikhawatirkan lupa akun. Enjoy!!</p>
</div>


<table class="table table-striped" width="100%">
	<thead>
		<tr>
			<th>Nama Password</th>
			<th>Username</th>
			<th>Password</th>
			<th>Keterangan</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($pg_query as $row)
		{
			//dekripsi username
			$username_dek = $this->encrypt->decode($row->username);	
			
			//dekripsi password
			$password_dek = $this->encrypt->decode($row->password);	
			
			//membuat link untuk edit
			$edit_url = 'dashboard/edit/'.$row->id_password;
			$link_edit = site_url($edit_url);
			
			//membuat link untuk delete
			$delete_url = 'dashboard/delete/'.$row->id_password;
			$link_delete = site_url($delete_url);
			
			echo '<tr>';
			echo '<td width="20%">'.$row->nama.'</td>';
			echo '<td width="15%">'.$username_dek.'</td>';
			echo '<td width="15%">'.$password_dek.'</td>';
			echo '<td width="30%">'.$row->keterangan .'</td>';
			echo '<td width="20%"><a href="'.$link_edit.'" class="btn">Update</a> <a href="'.$link_delete.'" class="btn btn-danger">Delete</a></td>';
			echo '</tr>';
		}
		?>
	</tbody>
</table>

<?php if($paginasi){ ?>
	<div class="pagination">
	<?php echo $paginasi; ?>
	</div>
<?php } ?>