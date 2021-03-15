<?php

require_once("config.php");

// Carrega um usuário
//$root = new Usuario();
//$root->loadById(2);
//echo $root;

// Carrega uma lista de usuários
//$lista = Usuario::getList();
//echo json_encode($lista);

// Carrega uma lista de usuários buscando pelo username
//$search = Usuario::search("andr");
//echo json_encode($search);

// Carrega um usuário usando o username e a senha
//$usuario = new Usuario();
//$usuario->login("franciny", "123");
//echo $usuario;

// Fazendo INSERT
//$usuario= new Usuario();

//$usuario->setUsername("Flavio");
//$usuario->setSenha("123");


// Criando um novo usuario
//$usuario = new Usuario("dorila","dorila10");

//$usuario->insert();


// Update
/*
$usuario = new Usuario();
$usuario->loadById(5);
$usuario->update("dorila","dorilaza");
*/


// Deletar um usuário
$usuario = new Usuario();
$usuario->loadById(5);
$usuario->delete();
echo $usuario;

echo $usuario;






//$sql = new Sql();

//$usuarios = $sql->select("SELECT * FROM usuarios");

//echo json_encode($usuarios);
