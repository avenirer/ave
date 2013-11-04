<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('head_view');?>
</head>
<body>

<div class="container">
	<?php $this->load->view('top_menu_view');?>
	<div class="row">
		<div class="col-lg-9">
			<h1>Edit group <?php echo $group->name;?></h1>
			<?php
				echo form_open('users/edit_group_submit','class="form-horizontal"');
				echo '<div class="form-group">';
				echo validation_errors();
				echo form_label('Group description:','description',array('class'=>'col-lg-4 control-label'));
				echo '<div class="col-lg-4">';
				echo form_input('description',set_value('description',$group->description),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo form_hidden('id_group',$group->idgroups);
				echo form_submit('edit','Edit','class="col-lg-4 col-lg-offset-2 btn btn-primary"');
				echo form_close();
			?>
		</div>
		<div class="col-lg-3">
			test
		</div>
	</div>

<?php $this->load->view('footer_view');?>