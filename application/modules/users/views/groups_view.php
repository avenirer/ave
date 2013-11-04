<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('head_view');?>
</head>
<body>

<div class="container">
	<?php $this->load->view('top_menu_view');?>
	<div class="row">
		<div class="col-lg-9">
			<h1>Groups</h1>
			<?php
			echo '<p>'.anchor('users/add_group','<i class="fa fa-group"></i> Add group','class="btn btn-primary btn-sm"').'</p>';
			if(isset($groups))
			{
				echo '<table class="table table-condensed table-bordered table-striped table-hover">';
				echo '<thead>';
				echo '<tr>';
				echo '<th scope="col">ID</th>';
				echo '<th scope="col">Name</th>';
				echo '<th scope="col">Description</th>';
				echo '<th scope="col">Actions</th>';
				echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
				foreach($groups as $group)
				{
					echo '<tr>';
					echo '<td>'.$group->idgroups.'</td><td>'.anchor('users/get_users/'.$group->idgroups,$group->name).'</td><td>'.$group->description.'</td>';
					echo '<td>';
					echo anchor('users/edit_group/'.$group->idgroups,'<i class="fa fa-pencil fa-fw"></i>');
					if($group->name!='admin')
					{
						echo anchor('users/delete_group/'.$group->idgroups,'<i class="fa fa-trash-o"></i>','onclick="return confirm(\'Are you sure you want to delete?\')"');
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