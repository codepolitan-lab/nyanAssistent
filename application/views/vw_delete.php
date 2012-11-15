<div class="row-fluid">
	<div class="well span5">
	<p>Apakah kamu yakin akan menghapus password dengan data berikut:</p>
	<hr>
	<?php
	$attributes = array('id' => 'form_delete');
	echo form_open('dashboard/proses_delete', $attributes);
	?>
		<?php
		foreach ($query as $row)
		{
			//dekripsi username
			$username_dek = $this->encrypt->decode($row->username);
			
			//dekripsi password	
			$password_dek = $this->encrypt->decode($row->password);	
		?>
		<input type="hidden" name="id_password" value="<?php echo $row->id_password; ?>">
		<input type="hidden" name="nama" value="<?php echo $row->nama; ?>">
		<input type="hidden" name="username" value="<?php echo $username_dek; ?>">
		<input type="hidden" name="password" value="<?php echo $password_dek; ?>">
		<input type="hidden" name="keterangan" value="<?php echo $row->keterangan; ?>">
		
		<table cellpadding="8" style="margin-left:10px;">
			<tr><td>Nama Password</td><td><?php echo $row->nama; ?></td></tr>
			<tr><td>Username</td><td><?php echo $username_dek; ?></td></tr>
			<tr><td>Password</td><td><?php echo $password_dek; ?></td></tr>
			<tr><td>Keterangan</td><td><?php echo $row->keterangan; ?></td></tr>
		</table>
		<?php } ?>
		<hr>
		<button type="submit" class="btn btn-danger">Hapus</button>
		<input type="button" class="btn" onClick="history.go(-1);" value="Batal">
	</form>
	</div>
</div>