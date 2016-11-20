<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
Email Configuration
*/
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.sendgrid.net';
$config['smtp_user'] = 'wolflimited';
$config['smtp_pass'] = 'D8deb280';
$config['smtp_port'] = '587';
$config['charset'] = 'iso-8859-1';
$config['crlf'] = "\r\n";
$config['newline'] = "\r\n";
$config['wordwrap'] = TRUE;
$config['mailtype'] = 'html';