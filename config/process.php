<?php

session_start();
$contacts = [];
include_once('connection.php');
include_once('url.php');

$data = $_POST;
// MODIFICAÇÕES NO BANCO
if (!empty($data)) {

  //criar contato
  if($data['type'] === "create") {
    $name = $data['name'];
    $phone = $data['phone'];
    $observations = $data['observations'];

    $query = "INSERT INTO contacts (name, phone, observations) VALUES (?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $name, PDO::PARAM_STR);
    $stmt->bindParam(2, $phone, PDO::PARAM_STR);
    $stmt->bindParam(3, $observations, PDO::PARAM_STR);

    try {
      $stmt->execute();
      $_SESSION['msg'] = "Contato criado com sucesso";
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

  } else if($data['type'] === "edit") {
    $name = $data['name'];
    $phone = $data['phone'];
    $observations = $data['observations'];
    $id = $data['id'];

    $query = "UPDATE contacts 
              SET name = ?, phone = ?, observations = ?
              WHERE id = ?";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(1, $name, PDO::PARAM_STR);
    $stmt->bindParam(2, $phone, PDO::PARAM_STR);
    $stmt->bindParam(3, $observations, PDO::PARAM_STR);
    $stmt->bindParam(4, $id, PDO::PARAM_STR);

    try {
      $stmt->execute();
      $_SESSION['msg'] = "Contato atualizado com secesso";
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

  } else if($data['type'] === "delete") {

    $id = $data['id'];

    $query = "DELETE FROM contacts WHERE id = ?";
    $stmt = $conn->prepare($query);

    $stmt->bindParam(1, $id, PDO::PARAM_STR);

    try {
      $stmt->execute();
      $_SESSION['msg'] = "Contato Deletado com sucesso";
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

  }

  //REDIRECT HOME
  header('location:' . $BASE_URL . "../index.php");

} else {
  //SELEÇÃO DE DADOS
  $id;
  if (!empty($_GET)) {
    $id = $_GET['id'];
  } 


  //retorno dado de um contato
  if(!empty($id)){
    $query = "SELECT * FROM contacts WHERE id = :id";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(":id", $id);

    $stmt->execute();

    $contact = $stmt->fetch();
    
  }else{

  }



  //Retorna todo os contatos
  $query = "SELECT * FROM contacts";

  $stmt = $conn->prepare($query);

  $stmt->execute();

  $contacts = $stmt->fetchAll();
}


// FECHAR CONEXÃO
$conn = null;