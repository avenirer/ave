<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Articles <b class="caret"></b></a>
	<ul class="dropdown-menu">
		<li><a href="<?php echo site_url('articles');?>">List articles</a></li>
		<li><a href="<?php echo site_url('articles/add_article');?>">Add article</a></li>
		<li class="divider"></li>
		<li><a href="<?php echo site_url('articles/categories');?>">List categories</a></li>
		<li><a href="<?php echo site_url('articles/categories/add_category');?>">Add category</a></li>
		<li class="divider"></li>
		<li><a href="<?php echo site_url('articles/authors');?>">List authors</a></li>
		<li><a href="<?php echo site_url('articles/authors/add_author');?>">Add author</a></li>
	</ul>
</li>