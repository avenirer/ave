<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('head_view');?>
</head>
<body>

<div class="container">
	<?php $this->load->view('top_menu_view');?>
	<div class="row">
		<div class="col-lg-9">
			<h1>Articles</h1>
			<?php
			echo '<p>'.anchor('articles/add_article','<i class="fa fa-file-text"></i> Add article','class="btn btn-primary btn-sm"').'&nbsp;';
			echo anchor('articles/categories/add_category','<i class="fa fa-folder-open-o"></i> Add category','class="btn btn-primary btn-sm"').'&nbsp;';
			echo anchor('articles/authors/add_author','<i class="fa fa-user"></i> Add author','class="btn btn-primary btn-sm"');
			//.'&nbsp;'.anchor('users/get_users/','<i class="fa fa-group"></i> All users','class="btn btn-success btn-sm"').'&nbsp;'.anchor('users/get_users/nogroup','<i class="fa fa-group"></i> Users without group ('.$nogroup.')','class="btn btn-danger btn-sm"');
			echo '</p>';?>
			<table class="table table-condensed table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Title</th>
						<th scope="col">Author</th>
						<th scope="col">Main photo</th>
						<th scope="col">Created at</th>
						<th scope="col">Status</th>
					</tr>
				</thead>
				<?php
				if(!empty($articles))
				{
					echo '<tbody>';
					foreach($articles as $article)
					{
						echo '<tr';
						if($article->status=='0')
						{
							echo ' class="danger"';
						}
						echo '>';
						echo '<td>'.$article->article_id.'</td>';
						echo '<td>';
						echo anchor('articles/edit_article/'.$article->article_id,'<i class="fa fa-pencil fa-fw"></i>').' ';
						echo $article->article_title.'</td>';
						echo '<td>';
						if(!empty($article->author_display))
						{
							$author = $article->author_display;
						}
						else
						{
							$author = $article->author_first_name.' '.$article->author_last_name;
						}
						echo $author;
						echo '</td>';
						echo '<td>';
						if(!empty($article->photo))
						{
							echo anchor('photos/'.$article->photo.$article->photo_extension,'<i class="fa fa-picture-o"></i>','target="_blank"').' ';
							echo anchor('photos/delete_main_photo/articles/id/'.$article->article_id,'<i class="fa fa-trash-o"></i>','onclick="return confirm(\'Are you sure you want to delete?\')"');
						}
						else
						{
							echo anchor('photos/upload_main_photo/articles/id/'.$article->article_id,'<i class="fa fa-camera"></i>');
						}
						echo '</td>';
						echo '<td>';
						echo $article->created_at;
						echo '</td>';
						echo '<td>';
						switch ($article->status) {
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
						echo anchor('articles/change_status/'.$article->article_id.'/'.$newstatus,'<i class="fa fa-thumbs-o-'.$statusicon.'"></i>');
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