<?php $this->load->view('head_view');?>
<style type="text/css">
      body {
        padding-top: 80px;
        padding-bottom: 40px;
        background: #f5f5f5 url('<?php echo site_url('img/logo-big.png');?>') center 10px no-repeat;
      }

      .form-signin {
        max-width: 450px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }


    </style>
</head>
<body>

<div class="container">

<?php
echo form_open('users/login_submit','class="form-signin"');
//echo '<h1>'.lang('login_heading').'</h1>';
echo '<p>Login below</p>';
//echo '<div id="infoMessage">'.$message.'</div>';
//echo '<div class="form-group">';
//echo lang('login_identity_label', 'identity');
echo validation_errors();
if(!empty($errors))
{
	echo '<div class="alert alert-danger">'.$errors.'</div>';
}
echo '<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>';
echo form_input('email',set_value('email'),'class="form-control input-lg" placeholder="Email"');
echo '</div>';
echo '<br />';
echo '<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>';
echo form_password('password',set_value('password'),'class="form-control input-lg" placeholder="Password"');
echo '</div>';
/*
echo '<div class="checkbox"><label>';
echo form_checkbox('remember', '1', FALSE, 'id="remember"');
echo 'Remember me</label></div>';
 */
echo '<br />';
echo form_submit('submit', 'Login', 'class="btn btn-primary btn-block"');
echo '<br /><p><a href="forgot_password">Forgot password?</a></p>';
echo form_close();?>


<?php $this->load->view('footer_view');?>