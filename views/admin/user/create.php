<?php
require_once "../../../DB/Connection.php";
require_once "../../../models/User.php";
require_once "../../../controllers/UserController.php";
UserController::verifyLogin();
UserController::verifyAdmin();
?>


<html>
<?php
if (isset($_SESSION['different-passwords'])) {
  echo $_SESSION['different-passwords'];
}
?>

<form action="/Treinamento2020/user/store" method="post">
  <input required name="name" placeholder="name">
  <input required type="email" name="email" placeholder="email">
  <select required name="type">
    <option value="" selected disabled>Selecione um tipo</option>
    <option value="admin">Administrador</option>
    <option value="user">Usuário comum</option>
  </select>
  <input required type="password" name="password" placeholder="Insira sua senha">
  <input required type="password" name="password_confirmation" placeholder="Confirme sua senha">
  <button type="submit"> Cadastrar </button>
</form>
<a href="http://localhost/Treinamento2020/views/admin/dashboard.php">Voltar</a>

</html>