<?php
include_once('template/header.php');
?>


<div class="container">
  <?php include_once("template/backbtn.html"); ?> 
  <h1 id="main-title">Editar Contato</h1>
  <form id="create-form" action="<?= $BASE_URL ?>config/process.php" method="post">
    <input type="hidden" name="type" value="edit">
    <input type="hidden" name="id" value="<?= $contact['id'] ?>">
    <div class="form-group">
      <label for="name">Nome do Contato:</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Digite o Nome"
      value="<?= $contact['name'] ?>" require>
    </div>
    <div class="form-group">
      <label for="phone">Telefone Contato:</label>
      <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o Telefone"
      value="<?= $contact['phone'] ?>" require>
    </div>
    <div class="form-group">
      <label for="observations">Observações:</label>
      <textarea type="text" class="form-control" id="observations" name="observations"
      placeholder="Insira a Observação" rows="3"><?= $contact['observations'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
  </form>
</div>



<?php
include_once('template/footer.php');
?>
