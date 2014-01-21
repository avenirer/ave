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
				echo form_open('articles/add_article_submit','class="form-horizontal"');
				echo validation_errors();
				echo '<div class="form-group">';
				echo form_label('Title:','title',array('class'=>'col-lg-2 control-label'));
				echo '<div class="col-lg-10">';
				echo form_input('title',set_value('title'),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
				echo form_label('URL:','url',array('class'=>'col-lg-2 control-label'));
				echo '<div class="col-lg-10">';
				echo form_input('url',set_value('url'),'class="form-control" placeholder="Leave blank if you feel tired"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
				echo form_label('Page title:','page_title',array('class'=>'col-lg-2 control-label'));
				echo '<div class="col-lg-10">';
				echo form_input('page_title',set_value('page_title'),'class="form-control" placeholder="Leave blank if you feel tired"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
				echo form_label('Parent category:','category',array('class'=>'col-lg-2 control-label'));
				echo '<div class="col-lg-10">';
				$options = array();
				if(!empty($categories))
				{
					foreach($categories as $category)
					{
						$options[$category->id] = $category->category;
					}
				}
				if(empty($parent))
				{
					$parent = '0';
				}
				echo form_dropdown('category',$options,set_value('parent',$parent),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
				echo form_label('Teaser:','teaser',array('class'=>'col-lg-2 control-label'));
				echo '<div class="col-lg-10">';
				echo form_textarea('teaser',set_value('teaser'),'class="form-control" style="height: 150px;"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
				echo form_label('Description:','description',array('class'=>'col-lg-2 control-label'));
				echo '<div class="col-lg-10">';
				echo form_textarea('description',set_value('description'),'class="form-control" placeholder="Leave blank if you feel tired" style="height: 50px;"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
				echo form_label('Body:','body',array('class'=>'col-lg-2 control-label'));
				echo '<div class="col-lg-10">';
				echo form_textarea('body',set_value('body'),'class="form-control tinymce"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
				echo form_label('Keywords:','keywords',array('class'=>'col-lg-2 control-label'));
				echo '<div class="col-lg-10">';
				echo form_input('keywords',set_value('keywords'),'class="form-control"');
				echo '</div>';
				echo '</div>';

				echo form_submit('add','Add article','class="col-lg-4 col-lg-offset-2 btn btn-primary"');
				echo form_close();
			?>
		</div>
		<div class="col-lg-3">
			test
		</div>
	</div>

<?php $this->load->view('footer_view');?>