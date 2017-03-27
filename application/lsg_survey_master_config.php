<?php

$master_config = array();


/**
 *
 *
 * DATABASE CREDENTIALS
 *
 *
 */


$master_config['database']['local']['hostname'] = 'localhost';
$master_config['database']['local']['username'] = 'root';
$master_config['database']['local']['password'] = '';
$master_config['database']['local']['database'] = 'lsg_survey';
$master_config['database']['local']['dbdriver'] = 'mysqli';
$master_config['database']['local']['dbprefix'] = '';
$master_config['database']['local']['pconnect'] = false;
$master_config['database']['local']['db_debug'] = true;
$master_config['database']['local']['cache_on'] = FALSE;
$master_config['database']['local']['cachedir'] = '';
$master_config['database']['local']['char_set'] = 'utf8';
$master_config['database']['local']['dbcollat'] = 'utf8_unicode_ci';
$master_config['database']['local']['swap_pre'] = '';
$master_config['database']['local']['autoinit'] = TRUE;
$master_config['database']['local']['stricton'] = FALSE;

$master_config['database']['local-rakesh']['hostname'] = 'localhost';
$master_config['database']['local-rakesh']['username'] = 'root';
$master_config['database']['local-rakesh']['password'] = '';
$master_config['database']['local-rakesh']['database'] = 'jeevanam';
$master_config['database']['local-rakesh']['dbdriver'] = 'mysqli';
$master_config['database']['local-rakesh']['dbprefix'] = '';
$master_config['database']['local-rakesh']['pconnect'] = false;
$master_config['database']['local-rakesh']['db_debug'] = true;
$master_config['database']['local-rakesh']['cache_on'] = FALSE;
$master_config['database']['local-rakesh']['cachedir'] = '';
$master_config['database']['local-rakesh']['char_set'] = 'utf8';
$master_config['database']['local-rakesh']['dbcollat'] = 'utf8_unicode_ci';
$master_config['database']['local-rakesh']['swap_pre'] = '';
$master_config['database']['local-rakesh']['autoinit'] = TRUE;
$master_config['database']['local-rakesh']['stricton'] = FALSE;





$master_config['database']['development']['hostname'] = 'localhost';
$master_config['database']['development']['username'] = 'lsgsurvey_dbuser';
$master_config['database']['development']['password'] = 'aA6JN)Ma?#Cn';
$master_config['database']['development']['database'] = 'lsg_survey';
$master_config['database']['development']['dbdriver'] = 'mysqli';
$master_config['database']['development']['dbprefix'] = '';
$master_config['database']['development']['pconnect'] = false;
$master_config['database']['development']['db_debug'] = true;
$master_config['database']['development']['cache_on'] = FALSE;
$master_config['database']['development']['cachedir'] = '';
$master_config['database']['development']['char_set'] = 'utf8';
$master_config['database']['development']['dbcollat'] = 'utf8_unicode_ci';
$master_config['database']['development']['swap_pre'] = '';
$master_config['database']['development']['autoinit'] = TRUE;
$master_config['database']['development']['stricton'] = FALSE;



$master_config['database']['testing']['hostname'] = 'testinghost';
$master_config['database']['testing']['username'] = 'root';
$master_config['database']['testing']['password'] = '';
$master_config['database']['testing']['database'] = 'lsg';
$master_config['database']['testing']['dbdriver'] = 'mysqli';
$master_config['database']['testing']['dbprefix'] = '';
$master_config['database']['testing']['pconnect'] = false;
$master_config['database']['testing']['db_debug'] = true;
$master_config['database']['testing']['cache_on'] = FALSE;
$master_config['database']['testing']['cachedir'] = '';
$master_config['database']['testing']['char_set'] = 'utf8';
$master_config['database']['testing']['dbcollat'] = 'utf8_unicode_ci';
$master_config['database']['testing']['swap_pre'] = '';
$master_config['database']['testing']['autoinit'] = TRUE;
$master_config['database']['testing']['stricton'] = FALSE;



$master_config['database']['production']['hostname'] = 'localhost';
$master_config['database']['production']['username'] = 'lsgsurvey_dbuser';
$master_config['database']['production']['password'] = '';
$master_config['database']['production']['database'] = 'lsgsurvey';
$master_config['database']['production']['dbdriver'] = 'mysqli';
$master_config['database']['production']['dbprefix'] = '';
$master_config['database']['production']['pconnect'] = false;
$master_config['database']['production']['db_debug'] = true;
$master_config['database']['production']['cache_on'] = FALSE;
$master_config['database']['production']['cachedir'] = '';
$master_config['database']['production']['char_set'] = 'utf8';
$master_config['database']['production']['dbcollat'] = 'utf8_unicode_ci';
$master_config['database']['production']['swap_pre'] = '';
$master_config['database']['production']['autoinit'] = TRUE;
$master_config['database']['production']['stricton'] = FALSE;



/**
 *
 *
 * SMTP CREDENTIALS
 *
 *
 */

$master_config['email']['local-rakesh']['smtp_host']        =   'smtp.gmail.com';
$master_config['email']['local-rakesh']['smtp_port']        =   '465';
$master_config['email']['local-rakesh']['smtp_username']    =	 'rakesh.various@gmail.com';
$master_config['email']['local-rakesh']['smtp_password']    =   'Thisisanewone!';
$master_config['email']['local-rakesh']['smtp_auth']        =   true;
$master_config['email']['local-rakesh']['smtp_secure']      =   'ssl';

$master_config['email']['local']['smtp_host']        =   'smtp.gmail.com';
$master_config['email']['local']['smtp_port']        =   '465';
$master_config['email']['local']['smtp_username']    =	 'rakesh.various@gmail.com';
$master_config['email']['local']['smtp_password']    =   'Thisisanewone!';
$master_config['email']['local']['smtp_auth']        =   true;
$master_config['email']['local']['smtp_secure']      =   'ssl';

$master_config['email']['development']['smtp_host']        =   'localhost';
$master_config['email']['development']['smtp_port']        =   25;
$master_config['email']['development']['smtp_username']    =	 '';
$master_config['email']['development']['smtp_password']    =   '';
$master_config['email']['development']['smtp_auth']        =   true;
$master_config['email']['development']['smtp_secure']      =   'ssl';

$master_config['email']['testing']['smtp_host']        =   '';
$master_config['email']['testing']['smtp_port']        =   '';
$master_config['email']['testing']['smtp_username']    =	 '';
$master_config['email']['testing']['smtp_password']    =   '';
$master_config['email']['testing']['smtp_auth']        =   true;
$master_config['email']['testing']['smtp_secure']      =   'ssl';

$master_config['email']['production']['smtp_host']        =   '';
$master_config['email']['production']['smtp_port']        =   '';
$master_config['email']['production']['smtp_username']    =	 '';
$master_config['email']['production']['smtp_password']    =   '';
$master_config['email']['production']['smtp_auth']        =   true;
$master_config['email']['production']['smtp_secure']      =   'ssl';
