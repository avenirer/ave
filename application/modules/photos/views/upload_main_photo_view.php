<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('head_view');?>
</head>
<body>

<div class="container">
	<?php $this->load->view('top_menu_view');?>
	<div class="row">
		<div class="col-lg-9">
			<h1>Upload main photo</h1>
<h3>Upload photos</h3>
<?php
echo form_open_multipart('photos/upload_main_photo_submit','class="form-horizontal"');
echo '<div class="form-group">';
echo form_error('file_title');
echo form_label('Title:','file_title',array('class'=>'col-lg-2 control-label'));
echo '<div class="col-lg-10">';
echo form_input('file_title',set_value('file_title'),'placeholder="SEO title" class="form-control"');
echo '</div>';
echo '</div>';
echo '<div class="form-group">';
echo form_error('file_name');
echo form_label('File name:','file_name',array('class'=>'col-lg-2 control-label'));
echo '<div class="col-lg-10">';
echo form_input('file_name',set_value('file_name'),'placeholder="Leave blank if you don\'t want file name changed" class="form-control"');
echo '</div>';
echo '</div>';
echo '<div class="form-group">';
echo form_error('photo');
echo form_label('Photo:','photo',array('class'=>'col-lg-2 control-label'));
echo '<div class="col-lg-10">';
if(!empty($error))
{
	echo $error;
}
echo form_upload('photo',set_value('photo'),'class="form-control"');
echo '</div>';
echo '</div>';
echo form_hidden('table', $table);
echo form_hidden('id_field',$id_field);
echo form_hidden('id',$id);
echo form_hidden('from',$from);
echo '<div class="form-group">';
echo form_submit('add', 'Add photo','class="btn btn-primary btn-sm btn-block"');
echo '</div>';
echo form_close();
?>
</div>
		<div class="col-lg-3">
			test
		</div>
	</div>
<?php $this->load->view('footer_view');?>