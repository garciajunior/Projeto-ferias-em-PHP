<?php
	require_once ( "config.php");
	$sql = new Sql();
	/*$usuarios = $sql->select("SELECT * FROM tb_usuarios");
	echo json_encode($usuarios);*/
	
	//Carrega apenas um Usuario
	/*
	
	$root = new Usuario();
	$root->loadbyId(1);
	echo $root;*/

	//Carrega uma lista de Usuario
	/*$lista  = Usuario :: getList();
	echo json_encode($lista);*/

	// carrega um alista de usuario pelo login
	//$search =  Usuario:: search("Ju");
	//echo json_encode($search);

	//Carrega um usuario usando o lOgin e senha
	/*$usuario = new Usuario();
	$usuario->Login("JUNIOR","MAMAE");
	echo $usuario;*/
	// inserindo prestar atenção no parenteses
	/*
	$aluno = new Usuario("aluno", "hdhgdg");
	
	$aluno->insert();

	echo $aluno;*/
	
    /*$usuario = new Usuario();
    $usuario->loadByid ( 9 );
    echo $usuario;
    $usuario->update("Professor", "Junior");*/
    //DELETANDO USUARIO
    $usuario = new  Usuario();
    $usuario->loadByid(8);
    $usuario->delete();
    echo $usuario;



?>