<?php
	include_once "./Database.php";
    Database::connectToDb();

	$name = $_POST["name"];
	$email = $_POST["email"];
	$password = $_POST["password"];

	$name_error = '';
	$email_error = '';
	$password_error = '';

	$success = '';

	if(empty($name))
	{
		$name_error = 'Nome necessário';
	}
	else
	{
		if(!preg_match("/^[a-zA-Z-' ]*$/", $name))
		{
			$name_error = 'Use apenas letras e espaço no nome';
		}
	}

	if(empty($email))
	{
		$email_error = 'Email necessário';
	}
	else
	{
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$email_error = 'Email inválido';
		}
	}

	if(empty($password))
	{
		$password_error = "Senha necessária";
	}

	if($name_error == '' && $email_error == '' && $password_error == '')
	{
        $signupUserSql = "INSERT INTO `users` (`id`, `nome`, `senha`, `email`) VALUES (NULL, '$name', '$password', '$email')";
        $preparedTemplateForSignup = Database::$dbConnection->prepare($signupUserSql);
		$preparedTemplateForSignup->execute();

		$success = 'Cadastro realizado';
	}

	$output = array(
		'success'		=>	$success,
		'name_error'	=>	$name_error,
		'email_error'	=>	$email_error,
		'password_error'	=>	$password_error
	);
	
	echo json_encode($output);
