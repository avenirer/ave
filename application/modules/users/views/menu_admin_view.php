<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<li class="divider"></li>
<li role="presentation" class="dropdown-header">Admin menu</li>
<li><?php echo anchor('users/get_users','<i class="fa fa-user"></i> View/Edit users');?></li>
<li><?php echo anchor('users/get_groups','<i class="fa fa-group"></i> View/Edit groups');?></li>