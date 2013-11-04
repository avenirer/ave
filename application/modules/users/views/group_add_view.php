<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('head_view');?>
</head>
<body>

<div class="container">
	<?php $this->load->view('top_menu_view');?>
	<div class="row">
		<div class="col-lg-9">
			<h1>Add group</h1>
			<?php
				echo form_open('users/add_group_submit','class="form-horizontal"');
				echo validation_errors();
				echo '<div class="form-group">';
				echo form_label('Group name:','name',array('class'=>'col-lg-4 control-label'));
				echo '<div class="col-lg-4">';
				echo form_input('name',set_value('name'),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
				echo form_label('Group description:','description',array('class'=>'col-lg-4 control-label'));
				echo '<div class="col-lg-4">';
				echo form_input('description',set_value('description'),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo form_submit('add','Add group','class="col-lg-4 col-lg-offset-2 btn btn-primary"');
				echo form_close();
			?>
		</div>
		<div class="col-lg-3">
			test
		</div>
	</div>

<?php $this->load->view('footer_view');?>