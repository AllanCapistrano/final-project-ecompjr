<?php
require_once "../../../DB/Connection.php";
require_once "../../../models/User.php";
require_once "../../../controllers/UserController.php";
UserController::verifyLogin();
UserController::verifyAdmin();
$user = UserController::get($_GET['id']);
?>


<html>
<?php
if (isset($_SESSION['different-passwords'])) {
  echo $_SESSION['different-passwords'];
}

if (isset($_SESSION['invalid-email'])) {
  echo $_SESSION['invalid-email'];
}

if (!$user) {
  echo "<h1>Erro 404</h1>";
  echo "<h3>Usuário não encontrado.</h3>";;
}
?>
<form action="/Treinamento2020/user/update/<?php echo $user->getId() ?>" method="post">
  <input name="name" placeholder="name" value="<?php echo $user->getName() ?>">
  <input type="email" name="email" placeholder="email" value="<?php echo $user->getEmail() ?>">
  <select name="type">
    <option value="" disabled>Selecione um tipo</option>
    <option value="admin" <?php if ($user->getType() == "admin") { ?> selected <?php } ?>>Administrador</option>
    <option value="user" <?php if ($user->getType() == "user") { ?> selected <?php } ?>>Usuário comum</option>
  </select>
  <input type="password" name="password" placeholder="Insira sua senha">
  <input type="password" name="password_confirmation" placeholder="Confirme sua senha">
  <button type="submit"> Editar </button>
</form>
<a href="/Treinamento2020/user/index">Voltar</a>

</html>