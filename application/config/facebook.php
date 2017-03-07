<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Facebook App details
| -------------------------------------------------------------------
|
| To get an facebook app details you have to be a registered developer
| at http://developer.facebook.com and create an app for your project.
|
|  facebook_app_id               string  Your facebook app ID.
|  facebook_app_secret           string  Your facebook app secret.
|  facebook_login_type           string  Set login type. (web, js, canvas)
|  facebook_login_redirect_url   string  URL tor redirect back to after login. Do not include domain.
|  facebook_logout_redirect_url  string  URL tor redirect back to after login. Do not include domain.
|  facebook_permissions          array   The permissions you need.
|  facebook_graph_version        string  Set Facebook Graph version to be used. Eg v2.5
|  facebook_auth_on_load         boolean  Set to TRUE to have the library to check for valid access token on every page load.
*/



switch(ENVIRONMENT_) {

	case 'local-rakesh':
	case 'development':

		//Rakesh Test App (Nirmalyam Test1)
		$config['facebook_app_id']              = '1253793467994827';
		$config['facebook_app_secret']          = '2cc82869f7822cf363d4a0ae2d680c84';
		$config['facebook_login_type']          = 'web';
		$config['facebook_login_redirect_url']  = 'user/handle_fb_login';
		$config['facebook_logout_redirect_url'] = 'logout';
		$config['facebook_permissions']         = array('public_profile', 'publish_actions', 'email');
		$config['facebook_graph_version']       = 'v2.0';
		$config['facebook_auth_on_load']        = TRUE;
		break;

	case 'local':

		//Rahul Test App
		$config['facebook_app_id']              = '584139655082303';
		$config['facebook_app_secret']          = '9465bcfb056b3a054c3c40247e0aba65';
		$config['facebook_login_type']          = 'web';
		$config['facebook_login_redirect_url']  = 'user/handle_fb_login';
		$config['facebook_logout_redirect_url'] = 'logout';
		$config['facebook_permissions']         = array('public_profile', 'publish_actions', 'email');
		$config['facebook_graph_version']       = 'v2.5';
		$config['facebook_auth_on_load']        = TRUE;
		break;
}
