<h2>Pencarian Password</h2>

<?php
	$attributes = array('style' => 'margin-top:30px; margin-bottom:30px;', 'class' => 'well form-search');
	echo form_open('search/proses_cari', $attributes);
?>
	<label class="control-label" for="textarea">Pencarian : </label>
	<input type="text" class="input-xlarge search-query" placeholder="Masukan sebuah kata kunci pencarian..." name="key" value="<?php echo $key; ?>">
	<button type="submit" class="btn btn-primary">Search</button>
</form>

<?php
if ($jumlah == 0)
{
?>

<div class="alert">
Tidak ditemukan sebuah password kata kunci <strong>'<?php echo $key; ?>'</strong>
</div>

<?php
}
else
{
?>

<div class="alert">
Ditemukan <strong><?php echo $jumlah; ?></strong> buah password dengan kata kunci <strong>'<?php echo $key; ?>'</strong>
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
		foreach ($query as $row)
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

<?php } ?>