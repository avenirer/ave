<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
	  <?php
	  echo anchor(site_url(),'<img src="'.site_url('img/logo.png').'" style="margin-top:-10px" />','class="navbar-brand"');
	  ?>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Link</a></li>
      <li><a href="#">Link</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li><a href="#">Separated link</a></li>
          <li><a href="#">One more separated link</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <?php echo anchor('#','Administer users <b class="caret"></b>','class="dropdown-toggle" data-toggle="dropdown"');?>
            <ul class="dropdown-menu">
                <li><?php echo anchor('auth/get_users','View/Edit users');?></li>
                <li><?php echo anchor('auth/get_groups','View/Edit groups');?></li>
            </ul>
        </li>
        <li><?php echo anchor('auth/logout','<span class="glyphicon glyphicon-log-out"></span> Logout');?></li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>