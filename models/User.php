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
    } else {
      return false;
    }
  }

  /*Retornar um usuário pelo id.*/
  public static function get($id)
  {
    $connection = Connection::getConnection();
    $query = "select * from users where id = '{$id}'"; /*Verificar id, array to string */
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) { /*Se o usuário existir.*/
      $user = mysqli_fetch_assoc($result);
      $varUser = new User($user['id'], $user['name'], $user['email'], $user['type']);

      return $varUser;
    } else {
      return false;
    }
  }

  /*Criar um novo usuário.*/
  public static function create($name, $email, $type, $password)
  {
    $connection = Connection::getConnection();
    $query = "insert into users(name, email, type, password) values('{$name}', 
    '{$email}', '{$type}', '{$password}')";

    mysqli_query($connection, $query);
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
    $connection = Connection::getConnection();
    $query = "delete from users where id = {$id}";

    mysqli_query($connection, $query);
  }

  /*Editar um usuário já existente.*/
  public static function update($id, $name, $email, $type, $password, $password_confirmation)
  {
    if ($password === $password_confirmation) {
      $connection = Connection::getConnection();

      if ($password == "") { /*Se não digitar uma senha, ela não é alterada. */
        $query = "update users set name = '{$name}', email = '{$email}', 
        type = '{$type}' where id = {$id} ";
      } else {
        $query = "update users set name = '{$name}', email = '{$email}', 
          type = '{$type}', password = '{$password}' where id = {$id} ";
      }

      mysqli_query($connection, $query);
      unset($_SESSION['senhas-diferentes']);

      return true;
    } else {
      $_SESSION['senhas-diferentes'] = "Erro, as senhas digitadas não são iguais!";

      return false;
    }
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

  // public function setType($name)
  // {
  //   $this->name = $name;
  // }

  // public function setName($name)
  // {
  //   $this->name = $name;
  // }

  // public function setEmail($email)
  // {
  //   $this->email = $email;
  // }

  // public function setPassword($password)
  // {
  //   $this->password = $password;
  // }
}
