<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('head_view');?>
</head>
<body>

<div class="container">
	<?php $this->load->view('top_menu_view');?>
	<div class="row">
		<div class="col-lg-9">
			<h1>Users</h1>
			<?php
			echo '<p>'.anchor('users/add_user','<i class="fa fa-user"></i> Add user','class="btn btn-primary btn-sm"').'&nbsp;'.anchor('users/get_users/nogroup','<i class="fa fa-group"></i> Users without group ('.$nogroup.')','class="btn btn-danger btn-sm"').'</p>';
			if(!empty($users))
			{
				echo '<table class="table table-condensed table-bordered table-striped table-hover">';
				echo '<thead>';
				echo '<tr>';
				echo '<th scope="col">ID</th>';
				echo '<th scope="col">Name</th>';
				echo '<th scope="col">Email</th>';
				echo '<th scope="col">Groups</th>';
				echo '<th scope="col">Last login</th>';
				echo '<th scope="col">Status</th>';
				echo '<th scope="col">Actions</th>';
				echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
				foreach($users as $user)
				{
					echo '<tr>';
					echo '<td>'.$user['idusers'].'</td>';
					echo '<td>'.$user['name'].'</td>';
					echo '<td>'.$user['email'].'</td>';
					echo '<td>'.implode(', ', $user['groups']);
					echo '<td>'.$user['last_login'].'</td>';
					echo '<td>';
					switch ($user['status'])
					{
						case '1':
							echo anchor('users/change_status/'.$user['idusers'].'/0','<i class="fa fa-thumbs-o-up"></i>');
							break;

						case '0':
							echo anchor('users/change_status/'.$user['idusers'].'/1','<i class="fa fa-thumbs-o-down"></i>');
							break;
					}
					'</td>';
					echo '<td>';
					echo anchor('users/edit_user/'.$user['idusers'],'<i class="fa fa-pencil fa-fw"></i>');
					if($user['status'] == '0')
					{
						echo anchor('users/delete_user/'.$user['idusers'],'<i class="fa fa-trash-o"></i>');
					}
					echo '</td>';
					echo '</tr>';
				}
				echo '</tbody>';
				echo '</table>';
			}
			?>
		</div>
		<div class="col-lg-3">
			test
		</div>
	</div>

<?php $this->load->view('footer_view');?>