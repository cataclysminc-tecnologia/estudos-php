<?php

class Usuario {
    
    private $id;
    private $username;
    private $senha;
    private $email;
    private $data_criacao;
    private $ip;
    
    public function getId() {
        return $this->id;
    }
    public function setId($value) {
        $this->id = $value;
    }
    
    public function getUsername() {
        return $this->username;
    }
    public function setUsername($value) {
        $this->username = $value;
    }
    
    public function getSenha() {
        return $this->senha;
    }
    public function setSenha($value) {
        $this->senha = $value;
    }
    
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($value) {
        $this->email = $value;
    }
    
    public function getData_criacao() {
        return $this->data_criacao;
    }
    public function setData_criacao($value) {
        $this->data_criacao = $value;
    }
    
    public function getIp() {
        return $this->ip;
    }
    public function setIp($value) {
        $this->ip = $value;
    }
    
    
    // Método
    public function loadById($id) {
        
        $sql = new Sql();
        
        $results = $sql->select("SELECT * FROM usuarios WHERE id = :ID", array(
            ":ID"=>$id    
        ));
        
        if (count($results) > 0)
        {
            $this->setData($results[0]);
        }
        
    }
    
    
    public static function getList()
    {
        $sql = new Sql();
        
        return $sql->select("SELECT * FROM usuarios ORDER BY username");
    }
    
    
    public static function search($username)
    {
        
        $sql = new Sql();
        
        return $sql->select("SELECT * FROM usuarios WHERE username LIKE :SEARCH ORDER BY username", array(
            
            ':SEARCH'=>"%".$username."%"
            
            ));
        
    }
    
    
    
    public function login($username, $senha)
    {
        $sql = new Sql();
        
        $results = $sql->select("SELECT * FROM usuarios WHERE username = :USERNAME AND senha = :SENHA", array(
            ":USERNAME"=>$username,
            ":SENHA"=>$senha
        ));
        
        if (count($results) > 0)
        {
            
            $this->setData($results[0]);
            
        } else {
            
            throw new Exception("Usuário e/ou senha inválidos!");
            
        }    
    }
    
    
    
    public function setData($data) 
    {
         $this->setId($data['id']);
         $this->setUsername($data['username']);
         $this->setSenha($data['senha']);
         $this->setEmail($data['email']);
         $this->setData_criacao($data['data_criacao']);
         $this->setIp($data['ip']);
        
    }
    
    
    
    // Método INSERT
    public function insert()
    {
        $sql = new Sql();
        
        $results = $sql->select("CALL sp_usuarios_insert(:USERNAME, :SENHA)", array(
            ':USERNAME'=>$this->getUsername(),
            ':SENHA'=>$this->getSenha()
        )); // PROCEDURE
        
        if (count($results) > 0 )
        {
            $this->setData($results[0]);
        }
    }
    
    
    
    public function update($username, $senha) {
        
        $this->setUsername($username);
        $this->setSenha($senha);
        
        $sql = new Sql();
        $sql->query("UPDATE usuarios SET username = :USERNAME, senha = :SENHA WHERE id = :ID", array(
            
            ':USERNAME'=>$this->getUsername(),
            ':SENHA'=>$this->getSenha(),
            ':ID'=>$this->getId()
                
        ));
    }
    
    
    
    public function delete()
    {
        
        $sql = new Sql();
        
        $sql->query("DELETE FROM usuarios WHERE id = :ID", array(
        
            ':ID'=>$this->getId()    
        
        ));
        
        $this->setId(0);
        $this->setUsername("");
        $this->setSenha("");
        
    }
    
    
    
    public function __construct($username="", $senha="")
    {
        $this->setUsername($username);
        $this->setSenha($senha);
    }
    
    
    public function __toString() {
        
        return json_encode(array(
            
            "id"=>$this->getId(),
            "username"=>$this->getUsername(),
            "senha"=>$this->getSenha(),
            "email"=>$this->getEmail(),
            "data_criacao"=>$this->getData_criacao(), //getData_criacao()->format("d/m/Y H:i:s")
            "ip"=>$this->getIp()
        ));
    }
    
}