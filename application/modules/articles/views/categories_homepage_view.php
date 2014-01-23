<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('head_view');?>
</head>
<body>

<div class="container">
	<?php $this->load->view('top_menu_view');?>
	<div class="row">
		<div class="col-lg-9">
			<h1>Categories</h1>
			<?php echo '<p>'.anchor('articles/categories/add_category','<i class="fa fa-folder-open-o"></i> Add category','class="btn btn-primary btn-sm"');
			//.'&nbsp;'.anchor('users/get_users/','<i class="fa fa-group"></i> All users','class="btn btn-success btn-sm"').'&nbsp;'.anchor('users/get_users/nogroup','<i class="fa fa-group"></i> Users without group ('.$nogroup.')','class="btn btn-danger btn-sm"').'</p>';?>
			<table class="table table-condensed table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Parent ID</th>
						<th scope="col">Category</th>
						<th scope="col">Status</th>
					</tr>
				</thead>
				<?php
				if(!empty($categories))
				{
					echo '<tbody>';
					foreach($categories as $category)
					{
						echo '<tr';
						if($category->status=='0')
						{
							echo ' class="danger"';
						}
						echo '>';
						echo '<td>'.$category->id.'</td>';
						echo '<td>'.$category->id_parent.'</td>';
						echo '<td>';
						echo anchor('articles/categories/edit_category/'.$category->id,'<i class="fa fa-pencil fa-fw"></i>');
						echo $category->category.'</td>';
						echo '<td>';
						switch ($category->status) {
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
						echo anchor('articles/categories/change_status/'.$category->id.'/'.$newstatus,'<i class="fa fa-thumbs-o-'.$statusicon.'"></i>');
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