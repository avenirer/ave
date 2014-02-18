<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('head_view');?>
</head>
<body>

<div class="container">
	<?php $this->load->view('top_menu_view');?>
	<div class="row">
		<div class="col-lg-9">
			<h1>Authors</h1>
			<?php echo '<p>'.anchor('articles/authors/add_author','<i class="fa fa-user"></i> Add author','class="btn btn-primary btn-sm"');
			//.'&nbsp;'.anchor('users/get_users/','<i class="fa fa-group"></i> All users','class="btn btn-success btn-sm"').'&nbsp;'.anchor('users/get_users/nogroup','<i class="fa fa-group"></i> Users without group ('.$nogroup.')','class="btn btn-danger btn-sm"');
			echo '</p>';?>
			<table class="table table-condensed table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Name</th>
						<th scope="col">Display as</th>
						<th scope="col">Status</th>
					</tr>
				</thead>
				<?php
				if(!empty($authors))
				{
					echo '<tbody>';
					foreach($authors as $author)
					{
						echo '<tr';
						if($author->status=='0')
						{
							echo ' class="danger"';
						}
						echo '>';
						echo '<td>'.$author->id.'</td>';
						echo '<td>';
						echo anchor('articles/authors/edit_author/'.$author->id,'<i class="fa fa-pencil fa-fw"></i>');
						echo ' '.$author->first_name.' '.$author->last_name.'</td>';
						echo '<td>'.$author->display_as.'</td>';
						echo '<td>';
						switch ($author->status) {
							case '0':
								$newstatus = '1';
								$statusicon = 'down';
							break;
							case '1':
								$newstatus = '0';
								$statusicon = 'up';
							break;
							default :
								$newstatus = '0';
								$statusicon = 'up';
							break;
						}
						echo anchor('articles/authors/change_status/'.$author->id.'/'.$newstatus,'<i class="fa fa-thumbs-o-'.$statusicon.'"></i>');
						echo '</td>';
						echo '</tr>';
					}
					echo '</tbody>';
				}
				?>
			</table>
		</div>
		<div class="col-lg-3">
			test
		</div>
	</div>
<?php $this->load->view('footer_view');?>