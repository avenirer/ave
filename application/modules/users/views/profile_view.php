<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('head_view');?>
</head>
<body>

<div class="container">
	<?php $this->load->view('top_menu_view');?>
	<div class="row">
		<div class="col-lg-9">
			<h1>Profile page</h1>
			<?php
			if(!empty($user))
			{
				echo '<strong>First name:</strong> '.$user->first_name.'<br />';
				echo '<strong>Last name:</strong> '.$user->last_name.'<br />';
				echo '<strong>Email:</strong> '.$user->email.'<br />';
			}
			if(!empty($usergroups))
			{
				echo '<strong>Groups you\'re in:</strong> ';
				echo '<ul>';
				foreach($usergroups as $group)
				{
					echo '<li>'.$group['name'].'</li>';
				}
				echo '</ul>';
			}
			?>
		</div>
		<div class="col-lg-3">
			test
		</div>
	</div>
<?php $this->load->view('footer_view');?>