<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('head_view');?>
</head>
<body>

<div class="container">
	<?php $this->load->view('top_menu_view');?>
	<div class="row">
		<div class="col-lg-9">
			<h1>Add category</h1>
			<?php
				echo form_open('articles/categories/add_category_submit','class="form-horizontal"');
				echo validation_errors();
				echo '<div class="form-group">';
				echo form_label('Category:','category',array('class'=>'col-lg-4 control-label'));
				echo '<div class="col-lg-4">';
				echo form_input('category',set_value('category'),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo '<div class="form-group">';
				echo form_label('Parent category:','parent',array('class'=>'col-lg-4 control-label'));
				echo '<div class="col-lg-4">';
				$options = array('0'=>'No parent');
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
				echo form_dropdown('parent',$options,set_value('parent',$parent),'class="form-control"');
				echo '</div>';
				echo '</div>';
				echo form_submit('add','Add category','class="col-lg-4 col-lg-offset-2 btn btn-primary"');
				echo form_close();
			?>
		</div>
		<div class="col-lg-3">
			test
		</div>
	</div>

<?php $this->load->view('footer_view');?>