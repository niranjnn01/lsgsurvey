<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->

<head>
    <title><?php echo @$page_title? $page_title : getTitle();?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=100%; initial-scale=1; maximum-scale=1; minimum-scale=1; user-scalable=no;"/>
    <link rel="shortcut icon" href="<?php echo $c_static_image_url;?>favicon.ico"/>
    <link rel="apple-touch-glyphicon glyphicon-precomposed" sizes="144x144" href="<?php echo $c_base_url;?>asset/img/apple-touch-glyphicon glyphicon-144-precomposed.png"/>
    <link rel="apple-touch-glyphicon glyphicon-precomposed" sizes="114x114" href="<?php echo $c_base_url;?>asset/img/apple-touch-glyphicon glyphicon-114-precomposed.png"/>
    <link rel="apple-touch-glyphicon glyphicon-precomposed" sizes="72x72" href="<?php echo $c_base_url;?>asset/img/apple-touch-glyphicon glyphicon-72-precomposed.png"/>
    <link rel="apple-touch-glyphicon glyphicon-precomposed" href="<?php echo $c_base_url;?>asset/img/apple-touch-glyphicon glyphicon-57-precomposed.png"/>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <?php echo load_files('css');?>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">



    <!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="<?php echo $c_base_url;?>asset/css/themes/misty/css/font-awesome-ie7.min.css"/>
    <![endif]-->

    <!--[if lt IE 9]>
    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <?php /*?>
    <link rel="stylesheet" type="text/css" href="<?php echo $c_base_url;?>asset/css/themes/misty/css/layerslider.css" >
    <script type="text/javascript" src="<?php echo $c_base_url;?>asset/js/misty/layerslider.kreaturamedia.jquery.js"></script>
    <?php */?>

	<script type="text/javascript">var base_url = '<?php echo c('base_url');?>';</script>
</head>


<body style="padding-top:0px;">




<div class="container-fluid">
<div class="row">
	<div class="col-xs-2">
		<!--<a href="<?php echo c('base_url');?>"  title="<?php echo c('website_name');?>">
			<img src="<?php echo $c_static_image_url, c('logo_image_name');?>" alt="<?php echo $c_website_title;?>"/>
		</a>-->
        <h1><?php echo $c_website_title;?></h1>
		<hr/>

		<?php //echo 'test';?>
		<?php //echo c('admin_menu_tree');?>
		<?php //p($aUserTypes);?>












        <?php

        $aAdminMenuTree = array(


          array(
            'section_title' => 'Home',
                'links' => array(),
                'url' => $c_base_url . 'home',
                'opened' => false,
          ),

	array(
		'section_title' =>'Users',
		'links' => array(
			array(
				'title' => 'Enumerators',
				'uri' => 'user/listing',
                'opened' => false
			),
			array(
				'title' => 'Create Enumerator',
				'uri' => 'user/create',
                'opened' => false
			),
		),
        'opened' => ($sCurrentMainMenu == 'users') ? true : false,
	),

  	array(
  		'section_title' =>'Survey',
  		'links' => array(
  			array(
  				'title' => 'Start New Survey',
  				'uri' => 'survey',
                  'opened' => false
  			),
  			array(
  				'title' => 'Surveys - Completed',
  				'uri' => 'survey_list/completed',
          'opened' => ($sCurrentMainMenuChild == 'surveys-completed') ? true : false,
  			),

  			array(
  				'title' => 'Surveys - In progress',
  				'uri' => 'survey_list/in_progress',
          'opened' => ($sCurrentMainMenuChild == 'surveys-in-progress') ? true : false,
  			),
  		),
      'opened' => ($sCurrentMainMenu == 'survey') ? true : false,
  	),

    array(
  		'section_title' =>'Reports',
  		'links' => array(
  			array(
  				'title' => 'Reports',
  				'uri' => 'report',
                  'opened' => false
  			),
  		),
          'opened' => ($sCurrentMainMenu == 'report') ? true : false,
  	),


	/*
	array(
		'section_title' => 'Sitepages',
		'links' => array(
			array(
				'title' => 'List',
				'uri' => 'page/listing',
                'opened' => false
			),
		),
        'opened' => ($sCurrentMainMenu == 'sitepages') ? true : false,
	),

	array(
		'section_title' => 'Contact Us',
		'links' => array(
            array(
				'title' => 'Add Purpose',
				'uri' => 'contact_us/add_purpose',
                'opened' => false
			),
			array(
				'title' => 'List Purposes',
				'uri' => 'contact_us/purpose_listing',
                'opened' => false
			),
		),
        'opened' => ($sCurrentMainMenu == 'contact_us') ? true : false,
	),
*/



	array(
		'section_title' => 'Logout',
        'links' => array(),
        'url' => $c_base_url . 'logout',
        'opened' => false,
	),

);
?>

		<?php echo getAccordion_vertical_menu( $aAdminMenuTree );?>


	</div>
	<div class="col-md-10">

		<div class="row">
			<?php login_logout();?>
            <?php /*?>

			<div class="col-xs-12 text-right">


						<a href="<?php echo current_url() . '?language=en';?>">
							<?php if( $sLanguage == 'en' ):?>
								<i class="fa fa-check"></i>
							<?php endif?>
							English
						</a>&nbsp;&nbsp;&nbsp;

						<a href="<?php echo current_url() . '?language=ml';?>">
							<?php if( $sLanguage == 'ml' ):?>
								<i class="fa fa-check"></i>
							<?php endif?>
							<?php echo $this->lang->line('common_malayalam');?>
						</a>

			</div>
            <?php */?>
		</div>
		<div class="row">
		<div class="col-md-12">

			<h2><?php echo $page_heading;?></h2>
