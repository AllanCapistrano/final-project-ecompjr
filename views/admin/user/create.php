<?php
require_once "../../../DB/Connection.php";
require_once "../../../models/User.php";
require_once "../../../controllers/UserController.php";
UserController::verifyLogin();
UserController::verifyAdmin();
?>


<html>
<form action="/Treinamento2020/user/store" method="post">
  <input name="name" placeholder="name">
  <input type="email" name="email" placeholder="email">
  <select name="type">
    <option value="">Selecione um tipo</option>
    <option value="admin">Administrador</option>
    <option value="user">Usuário comum</option>
  </select>
  <input type="password" name="password" placeholder="Insira sua senha">
  <input type="password" name="password_confirmation" placeholder="Confirme sua senha">
  <button type="submit"> Cadastrar </button>
</form>
<a href="http://localhost/Treinamento2020/views/admin/dashboard.php">Voltar</a>

</html>