<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<li class="dropdown">
	<?php echo anchor('#', $user->first_name.' '.$user->last_name.' <b class="caret"></b>','class="dropdown-toggle" data-toggle="dropdown"');?>
	<ul class="dropdown-menu">
		<li><?php echo anchor('users/profile','<i class="fa fa-user"></i> Profile');?></li>
		<?php
		if(!empty($groups_menu))
		{
			foreach($groups_menu as $menu)
			{
				$this->load->view($menu);
			}
		}
		?>
		<li class="divider"></li>
		<li><?php echo anchor('users/logout','<span class="glyphicon glyphicon-log-out"></span> Logout');?></li>
	</ul>
</li>