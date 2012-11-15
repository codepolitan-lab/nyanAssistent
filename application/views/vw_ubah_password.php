<h2>Pengaturan : Ubah Password</h2>

<div class="row-fluid" style="margin-top:30px;">
<div class="span4 ">
	<?php $this->load->view('vw_menu_setting'); ?>
</div>

<div class="span8">

	<?php
	if (!empty($pesan)) {
	echo $pesan; 
	}
	?>
	
	<?php
	if($error == '1'){
	$attributes = array('id' => 'form_setting', 'class' => 'form-horizontal');
	echo form_open('setting/proses_ubahpassword', $attributes);
	?>
	<fieldset>
		<div class="control-group">
			<label class="control-label" for="input01">Password Lama</label>
			<div class="controls">
				<input type="password" class="input-xlarge" name="password_lama" value="<?php echo set_value('password_lama'); ?>">
				<?php echo form_error('password_lama', '<span class="help-block merah">', '</span>'); ?>
			</div>
		</div>
		
		<div class="control-group" id="pass">
			<label class="control-label" for="input01">Password</label>
			<div class="controls">
				<input type="password" class="input-xlarge" id="password" name="password_baru" value="<?php echo set_value('password_baru'); ?>">
				<?php echo form_error('password_baru', '<span class="help-block merah">', '</span>'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="input01">Konfirmasi Password</label>
			<div class="controls">
				<input type="password" class="input-xlarge" name="password_konf" value="<?php echo set_value('password_konf'); ?>">
				<?php echo form_error('password_konf', '<span class="help-block merah">', '</span>'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-primary btn-large" style="padding-left:30px; padding-right:30px;">Simpan Password</button>
			</div>
		</div>
       </fieldset>
	</form>
	<?php } ?>
</div>

</div>