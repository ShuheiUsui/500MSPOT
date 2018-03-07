<?php
if(!isset($_POST['name']) && !isset($_POST['password'])){
	header('Location: ./');
	return;
}

$to = '';
$name = $_POST['name'];
$password = hash('sha256', $_POST['password']);

require_once('../../pdo.php');

$login = new AdminLogin;
$result = $login->auth($name, $password);

if(!$result['flg']){
	$to = './?code=1';
}else{
	$to = '../';
	session_start();
	$account = array(
		'id' => $result['id'],
		'auth' => 'admin'
	);
	$_SESSION['account'] = $account;
}

header("Location: ${to}");
