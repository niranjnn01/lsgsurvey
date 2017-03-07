<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


	<?php if( $bShowOpenGraphMetaDataInPage && isset($og_meta_data) && !empty($og_meta_data)):?>

			<meta property="og:app_id" content="<?php echo $og_meta_data['og_app_id']?>" />
			<meta property="og:og_url" 	content="<?php echo $og_meta_data['og_url']?>"/>
			<meta property="og:og_image" content="<?php echo $og_meta_data['og_image']?>"/>
			<meta property="og:og_site_name" content="<?php echo $og_meta_data['og_site_name']?>"/>
			<meta property="og:og_title" content="<?php echo $og_meta_data['og_title']?>"/>
			<meta property="og:og_description" content="<?php echo $og_meta_data['og_description']?>"/>

	<?php endif;?>

	<title><?php echo isset($page_title)? $page_title : getTitle();?></title>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />

<?php /*?>
<link rel="stylesheet" href="<?php echo $this->config->item('css_template_cdn_url');?>">
<?php */?>
<link rel="stylesheet" href="http://localhost/johnson/lsg_survey/asset/bootstrap/3.3.5/css/bootstrap.min.css">

<?php echo load_files('css');?>




</head>


<body style="margin-top:40px;">

<div id="wrapper">
	<!-- start header -->
	<header></header>


	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
