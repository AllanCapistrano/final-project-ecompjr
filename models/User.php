<?php

class User
{
  private $id;
  private $name;
  private $email;
  private $type;
  private $password;

  public function __construct($id, $name, $email, $type)
  {
    $this->id = $id;
    $this->name = $name;
    $this->email = $email;
    $this->type = $type;
  }

  /*Buscar o usuário para o login.*/
  public static function find($email, $password)
  {
    $connection = Connection::getConnection();
    $query = "select * from users where email = '{$email}' and password = '{$password}'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) { /*Se o usuário existir.*/
      $user = mysqli_fetch_assoc($result);
      $varUser = new User($user['id'], $user['name'], $user['email'], $user['type']);

      return $varUser;
    } else {;
      return false;
    }

    // mysqli_close($connection);
  }

  /*Retornar um usuário pelo id.*/
  public static function get($id)
  {
  }

  /*Criar um novo usuário.*/
  public static function create($name, $email, $type, $password)
  {
    $connection = Connection::getConnection();
    $query = "insert into users(name, email, type, password) values('{$name}', 
    '{$email}', '{$type}', '{$password}')";
    $result = mysqli_query($connection, $query);
  }

  /*Retorna todos os usuários.*/
  public static function all()
  {
    $connection = Connection::getConnection();
    $query = "select * from users";
    $result = mysqli_query($connection, $query);
    $users = [];

    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
      $user = mysqli_fetch_assoc($result);
      $users[$i] = new User($user['id'], $user['name'], $user['email'], $user['type']);
    }
    
    return $users;
  }

  /*Deletar um usuário.*/
  public static function delete($id)
  {
  }

  /*Editar um usuário já existente.*/
  public static function update($id, $name, $email, $type, $password, $password_confirmation)
  {
  }

  public function getId()
  {
    return $this->id;
  }

  public function getType()
  {
    return $this->type;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setType($name)
  {
    $this->name = $name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }
}
