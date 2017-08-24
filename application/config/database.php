<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

include('./../lsg_survey_master_config.php');


$active_group = ACTIVE_DB_GROUP;

$query_builder = TRUE;

/*
$db['local']        = $master_config['database']['local'];
$db['development']  = $master_config['database']['development'];
$db['testing']      = $master_config['database']['testing'];
$db['production']   = $master_config['database']['production'];
*/
$db[ENVIRONMENT_]['hostname'] = $master_config['database'][ENVIRONMENT_]['hostname'];
$db[ENVIRONMENT_]['username'] = $master_config['database'][ENVIRONMENT_]['username'];
$db[ENVIRONMENT_]['password'] = $master_config['database'][ENVIRONMENT_]['password'];
$db[ENVIRONMENT_]['database'] = 'lsg_survey_overhaul';
$db[ENVIRONMENT_]['dbdriver'] = $master_config['database'][ENVIRONMENT_]['dbdriver'];
$db[ENVIRONMENT_]['dbprefix'] = $master_config['database'][ENVIRONMENT_]['dbprefix'];
$db[ENVIRONMENT_]['pconnect'] = $master_config['database'][ENVIRONMENT_]['pconnect'];
$db[ENVIRONMENT_]['db_debug'] = $master_config['database'][ENVIRONMENT_]['db_debug'];
$db[ENVIRONMENT_]['cache_on'] = $master_config['database'][ENVIRONMENT_]['cache_on'];
$db[ENVIRONMENT_]['cachedir'] = $master_config['database'][ENVIRONMENT_]['cachedir'];
$db[ENVIRONMENT_]['char_set'] = $master_config['database'][ENVIRONMENT_]['char_set'];
$db[ENVIRONMENT_]['dbcollat'] = $master_config['database'][ENVIRONMENT_]['dbcollat'];
$db[ENVIRONMENT_]['swap_pre'] = $master_config['database'][ENVIRONMENT_]['swap_pre'];
$db[ENVIRONMENT_]['autoinit'] = $master_config['database'][ENVIRONMENT_]['autoinit'];
$db[ENVIRONMENT_]['stricton'] = $master_config['database'][ENVIRONMENT_]['stricton'];


/*
$db['development']['hostname'] = 'localhost';
$db['development']['username'] = '';
$db['development']['password'] = '';
$db['development']['database'] = '';
$db['development']['dbdriver'] = 'mysqli';
$db['development']['dbprefix'] = '';
$db['development']['pconnect'] = false;
$db['development']['db_debug'] = TRUE;
$db['development']['cache_on'] = FALSE;
$db['development']['cachedir'] = '';
$db['development']['char_set'] = 'utf8';
$db['development']['dbcollat'] = 'utf8_general_ci';
$db['development']['swap_pre'] = '';
$db['development']['autoinit'] = TRUE;
$db['development']['stricton'] = FALSE;


$db['testing']['hostname'] = '';
$db['testing']['username'] = '';
$db['testing']['password'] = '';
$db['testing']['database'] = '';
$db['testing']['dbdriver'] = 'mysqli';
$db['testing']['dbprefix'] = '';
$db['testing']['pconnect'] = FALSE;
$db['testing']['db_debug'] = true;
$db['testing']['cache_on'] = FALSE;
$db['testing']['cachedir'] = '';
$db['testing']['char_set'] = 'utf8';
$db['testing']['dbcollat'] = 'utf8_general_ci';
$db['testing']['swap_pre'] = '';
$db['testing']['autoinit'] = TRUE;
$db['testing']['stricton'] = FALSE;

$db['production']['hostname'] = '';
$db['production']['username'] = '';
$db['production']['password'] = '';
$db['production']['database'] = '';
$db['production']['dbdriver'] = 'mysqli';
$db['production']['dbprefix'] = '';
$db['production']['pconnect'] = TRUE;
$db['production']['db_debug'] = false;
$db['production']['cache_on'] = FALSE;
$db['production']['cachedir'] = '';
$db['production']['char_set'] = 'utf8';
$db['production']['dbcollat'] = 'utf8_general_ci';
$db['production']['swap_pre'] = '';
$db['production']['autoinit'] = TRUE;
$db['production']['stricton'] = FALSE;
*/




/* End of file database.php */
/* Location: ./application/config/database.php */
