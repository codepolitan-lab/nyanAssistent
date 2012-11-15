<h2>Tambah Password</h2>

<div class="row-fluid">
<div class="span8" style="margin-top:30px;">
<?php
	$attributes = array('id' => 'form_tambah', 'class' => 'form-horizontal');
	echo form_open('dashboard/proses_add', $attributes);
?>

	<fieldset>
		<div class="control-group">
			<label class="control-label" for="input01">Nama Password</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="input01" name="nama" value="<?php echo set_value('nama'); ?>">
				<?php echo form_error('nama', '<span class="help-block merah">', '</span>'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="input01">Username</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="input01" name="username" value="<?php echo set_value('username'); ?>">
				<?php echo form_error('username', '<span class="help-block merah">', '</span>'); ?>
			</div>
		</div>
		
		<div class="control-group" id="pass">
			<label class="control-label" for="input01">Password</label>
			<div class="controls">
				<input type="password" class="input-xlarge" id="password" name="password" value="<?php echo set_value('password'); ?>">
				<?php echo form_error('password', '<span class="help-block merah">', '</span>'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="input01">Konfirmasi Password</label>
			<div class="controls">
				<input type="password" class="input-xlarge" id="input01" name="password_konf" value="<?php echo set_value('password_konf'); ?>">
				<?php echo form_error('password_konf', '<span class="help-block merah">', '</span>'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="textarea">Keterangan</label>
			<div class="controls">
				<textarea class="input-xlarge" id="textarea" rows="3" name="keterangan"><?php if (!empty($keterangan)){ echo $keterangan; } ?></textarea>
			</div>
		</div>
		
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-primary btn-large" style="padding-left:30px; padding-right:30px;">Simpan Password</button>
			</div>
		</div>
       </fieldset>
</form>
</div>

<div class="span4">
	<img src="<?php echo base_url().'img/key.png'; ?>" style="margin-bottom:30px;">
</div>

</div>