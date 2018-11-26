<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|
| MY CONFIG - Vu Minh Luan
| 20/11/2018 09:33
|
*/
$config['password_minlength'] = 6;
$config['password_maxlength'] = 32;
$config['absolute_path'] = str_replace(basename($_SERVER["SCRIPT_FILENAME"]),"",$_SERVER["SCRIPT_FILENAME"]);