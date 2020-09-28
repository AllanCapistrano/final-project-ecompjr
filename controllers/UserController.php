<?php

session_start();

class UserController
{

  /*Mostar todos os usuários cadastrados.*/
  public function index()
  {
    header("location: /Treinamento2020/views/admin/user/index.php");
  }

  /*Página para a criação de um novo usuário. (GET)*/
  public function create()
  {
    header("location: /Treinamento2020/views/admin/user/create.php");
  }

  /*Criar e salvar um novo usuário no banco de dados. (POST)*/
  public function store()
  {
    // if($_POST['password'] != $_POST['password_confirmation']){

    // }
    User::create(
      $_POST['name'], 
      $_POST['email'], 
      $_POST['type'], 
      $_POST['password']
    );

    header("location: /Treinamento2020/user/index");
  }

  /*Página para a edição de usuário. (GET)*/
  public function edit($id)
  {
    header("location: /Treinamento2020/views/admin/user/edit.php?id={$id[0]}");
  }

  /*Página para o usuário editar o seu perfil.*/
  public function profile()
  {
  }

  /*Editar um usuário e salvar no banco de dados.*/
  public function update($id)
  {
    $user = User::get($id); /*Verificar se o usuário existe no banco de dados.*/

    User::update($user->getId(), $_POST['name'], $_POST['email'], $_POST['type'], $_POST['password']);

    header("location: /Treinamento2020/user/index");
  }

  /*Apagar um usuário. */
  public function delete($id)
  {
    $user = User::get($id);

    User::delete($user->getId());

    header("location: /Treinamento2020/user/index");
  }

  /*Listar todos os usuários.*/
  public static function all()
  {
    return User::all();
  }

  /*Checar se existe o usuário com aqueles dados (email e senha) no DB.*/
  public function check()
  {
    $user = User::find($_POST['email'], $_POST['password']);

    if ($user) {
      $_SESSION['user'] = $user;
      header("location: /Treinamento2020/views/admin/dashboard.php");
    } else {
      /*Avisar para o usuário que algo deu errado.*/
      $_SESSION['errologin'] = "Essas credenciais não foram encontradas.";
      header("location: /Treinamento2020/home/login");
    }
  }

  public static function verifyLogin()
  {
    if($_SESSION['user'] == null){ /*Se não estiver logado.*/
      header("location: /Treinamento2020/home/login");
      /*Avisar que o usuário não estã logado */
    }
  }

  public static function verifyAdmin()
  {
  }

  public static function logout()
  {
    $_SESSION['user'] = null;
    /*Ou.*/
    // session_destroy(); /*Limpara a sessão.*/
    header("location: /Treinamento2020/home/login");
  }

  /*Pegar o id para setar os campos.*/
  public static function get($id)
  {
    return User::get($id);
  }
}
