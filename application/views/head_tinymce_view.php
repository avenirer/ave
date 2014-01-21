<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>
        <?php echo isset($title) ? $title.' - Ave' :  'Ave'; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo site_url('css/bootstrap.min.css');?>" rel="stylesheet" media="screen">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo site_url('assets/js/html5shiv.js');?>"></script>
      <script src="<?php echo site_url('assets/js/respond.min.js');?>"></script>
    <![endif]-->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo site_url('js/tinymce/tinymce.min.js');?>"></script>
	<script type="text/javascript">
tinymce.init({
    selector: "textarea.tinymce"
 });
</script>
