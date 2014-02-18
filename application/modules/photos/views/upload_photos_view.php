<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<h3>Upload photos</h3>
<?php
echo form_open_multipart('photos/upload_photos_article_submit','role="form"');
echo '<div class="form-group">';
echo form_error('file_names');
echo form_label('File name(s):','file_names').'<br/>';
echo form_input('file_names',set_value('file_names'));
echo '</div>';
echo '<div class="form-group">';
echo form_error('photos');
echo form_label('Photos:','photos');
echo '<input type="file" name="photos[]" multiple />';
echo '</div>';
echo form_hidden('id_parent', $id_parent);
echo form_hidden('file_for',$file_for);
echo '<div class="form-group">';
echo form_submit('add', 'Add photos','class="btn btn-primary btn-sm btn-block"');
echo '</div>';
echo form_close();
if(!empty($photos))
{
	foreach($photos as $photo)
	{
		echo '<div class="row" style="margin-bottom:10px;">';
		echo '<div class="col-lg-6">';
		echo '<img src="'.site_url('photos/'.$photo->file_name.'_thumb'.$photo->extension).'" class="img-thumbnail">';
		echo '</div>';
		echo '<div class="col-lg-6">';
		echo '<strong>File:</strong><br />'.$photo->file_name;
		echo anchor(site_url('photos/delete/'.$photo->id),'Delete','class="btn btn-sm btn-danger"');
		echo '</div>';
		echo '</div>';
	}
}
//print_r($photos);
?>