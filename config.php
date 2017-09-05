<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*$config['base_url'] = 'http://admin.mmdili.com';

$config['controllers_path'] = 'controllers';
$config['helpers_path'] = 'helpers';
$config['logs_path'] = 'logs';
$config['libraries_path'] = 'libraries';

$config['default_controller'] = 'test';
$config['default_method'] = 'phpinfo';

$db['hostname'] = 'localhost';
$db['username'] = 'root';
$db['password'] = '';
$db['database'] = 'mmdili';*/


	$config = array();
	$config['base_url'] = 'http://admin.mmdili.com';
	$config['controllers_path'] = 'controllers';
	$config['models_path'] = 'models';
	$config['views_path'] = 'views';
	$config['libraries_path'] = 'libraries';
	$config['helpers_path'] = 'helpers';
	$config['logs_path'] = 'logs';
	$config['default_controller'] = 'test';
	$config['default_method'] = 'phpinfo';
	$db['hostname'] = 'localhost';
	$db['username'] = 'root';
	$db['password'] = '';
	$db['database'] = 'mmdili';

	//$autoload['helper'] = array('function_helper');
	//$autoload['library'] = array(array('User_agent', 'agent'));
	//$autoload['model'] = array(array('Home_model'));