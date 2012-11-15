<h2>Pencarian Password</h2>

<?php
	$attributes = array('style' => 'margin-top:30px; margin-bottom:30px;', 'class' => 'well form-search');
	echo form_open('search/proses_cari', $attributes);
?>
	<label class="control-label" for="textarea">Pencarian : </label>
	<input type="text" class="input-xlarge search-query" placeholder="Masukan sebuah kata kunci pencarian..." name="key">
	<button type="submit" class="btn btn-primary">Search</button>
</form>