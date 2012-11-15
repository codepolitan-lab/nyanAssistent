<h2>Pengaturan : Ubah Profil</h2>

<div class="row-fluid" style="margin-top:30px;">
<div class="span4 ">
	<?php $this->load->view('vw_menu_setting'); ?>
</div>

<div class="span8">
	<?php
	if (!empty($pesan)) {
	?>
	<div class="alert alert-success">
		<button class="close" data-dismiss="alert">&times;</button>
		<?php echo $pesan; ?>
	</div>
	<?php
	}
	else
	{
	?>


	<?php
	$attributes = array('id' => 'form_setting', 'class' => 'form-horizontal');
	echo form_open('setting/proses_ubahprofil', $attributes);
	?>
	<fieldset>
		<div class="control-group">
			<label class="control-label" for="input01">Nama</label>
			<div class="controls">
				<input type="text" class="input-xlarge" value="<?php echo $nama; ?>" name="nama">
				<?php echo form_error('nama', '<span class="help-block merah">', '</span>'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="input01">Username</label>
			<div class="controls">
				<input type="text" class="input-xlarge" value="<?php echo $username; ?>" name="username">
				<?php echo form_error('username', '<span class="help-block merah">', '</span>'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-primary btn-large" style="padding-left:30px; padding-right:30px;">Simpan Profil</button>
			</div>
		</div>
       </fieldset>
	</form>
	<?php
	}
	?>
</div>

</div>