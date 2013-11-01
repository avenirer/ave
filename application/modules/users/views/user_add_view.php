<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('head_view');?>
</head>
<body>

<div class="container">
	<?php $this->load->view('top_menu_view');?>
	<div class="row">
		<div class="col-lg-9">
			<h1>Add user</h1>
			<?php
				echo form_open('users/add_user_submit','class="form-horizontal"');
				echo '<div class="form-group">';
				echo validation_errors();
				echo form_label('First name:','first_name',array('class'=>'col-lg-4 control-label'));
				echo '<div class="col-lg-4">';
				echo form_input('first_name',set_value('first_name'),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
				echo form_label('Last name:','last_name',array('class'=>'col-lg-4 control-label'));
				echo '<div class="col-lg-4">';
				echo form_input('last_name',set_value('last_name'),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
				echo form_label('Email:','email',array('class'=>'col-lg-4 control-label'));
				echo '<div class="col-lg-4">';
				echo form_input('email',set_value('email'),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
				echo form_label('Password:','password',array('class'=>'col-lg-4 control-label'));
				echo '<div class="col-lg-4">';
				echo form_password('password',set_value('password'),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
				echo form_label('Repeat password:','password_check',array('class'=>'col-lg-4 control-label'));
				echo '<div class="col-lg-4">';
				echo form_password('password_check',set_value('password_check'),'class="form-control"');
				
				if(!empty($groups))
				{
					echo '<div class="form-group">';
					echo form_label('Groups:','groups',array('class'=>'col-lg-4 control-label'));
					echo '<div class="col-lg-4">';
					foreach($groups as $group)
					{
						echo '<div class="col-lg-4 checkbox">';
						echo '<label>';
						echo form_checkbox('groups[]',$group->idgroups,set_value('groups[]')).' '.$group->name;
						echo '</label>';
						echo '</div>';
					}
					echo '</div>';
					echo '</div>';
				}
				echo '</div>';
				echo '</div>';
				echo form_submit('edit','Add user','class="col-lg-4 col-lg-offset-2 btn btn-primary"');
				echo form_close();
			?>
		</div>
		<div class="col-lg-3">
			test
		</div>
	</div>

<?php $this->load->view('footer_view');?>