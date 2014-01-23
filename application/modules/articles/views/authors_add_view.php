<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('head_tinymce_view');?>
</head>
<body>

<div class="container">
	<?php $this->load->view('top_menu_view');?>
	<div class="row">
		<div class="col-lg-9">
			<h1>Add article</h1>
			<?php
				echo form_open('articles/authors/add_author_submit','class="form-horizontal"');
				//echo validation_errors();
				echo '<div class="form-group">';
                echo form_error('first_name');
				echo form_label('First name:','first_name',array('class'=>'col-lg-2 control-label'));
				echo '<div class="col-lg-10">';
				echo form_input('first_name',set_value('first_name'),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
                echo form_error('last_name');
				echo form_label('Last name:','last_name',array('class'=>'col-lg-2 control-label'));
				echo '<div class="col-lg-10">';
				echo form_input('last_name',set_value('last_name'),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
                echo form_error('display_as');
				echo form_label('Display as:','display_as',array('class'=>'col-lg-2 control-label'));
				echo '<div class="col-lg-10">';
				echo form_input('display_as',set_value('display_as'),'class="form-control" placeholder="Fill if you want the author to be displayed under another name (pseudonym, pen name, nickname)"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
                echo form_error('personal_page');
				echo form_label('Personal page:','personal_page',array('class'=>'col-lg-2 control-label'));
				echo '<div class="col-lg-10">';
				echo form_input('personal_page',set_value('personal_page'),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
                echo form_error('google_plus');
				echo form_label('Google+ profile:','google_plus',array('class'=>'col-lg-2 control-label'));
				echo '<div class="col-lg-10">';
				echo form_input('google_plus',set_value('google_plus'),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
                echo form_error('facebook');
				echo form_label('Facebook profile:','facebook',array('class'=>'col-lg-2 control-label'));
				echo '<div class="col-lg-10">';
				echo form_input('facebook',set_value('facebook'),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
                echo form_error('twitter');
				echo form_label('Twitter profile:','twitter',array('class'=>'col-lg-2 control-label'));
				echo '<div class="col-lg-10">';
				echo form_input('twitter',set_value('twitter'),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
                echo form_error('linkedin');
				echo form_label('Linkedin profile:','linkedin',array('class'=>'col-lg-2 control-label'));
				echo '<div class="col-lg-10">';
				echo form_input('linkedin',set_value('linkedin'),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
                echo form_error('about');
				echo form_label('About the author:','about',array('class'=>'col-lg-2 control-label'));
				echo '<div class="col-lg-10">';
				echo form_textarea('about',set_value('about'),'class="form-control tinymce"');
				echo '</div>';
				echo '</div>';
				echo form_submit('add','Add author','class="col-lg-4 col-lg-offset-2 btn btn-primary"');
				echo form_close();
			?>
		</div>
		<div class="col-lg-3">
			test
		</div>
	</div>

<?php $this->load->view('footer_view');?>