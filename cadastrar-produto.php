<?php
  include 'src/includes/head.php';
  include 'src/classes/Produto.php';
  include 'src/classes/ProdutoDao.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = (isset($_POST["codigo"]) && $_POST["codigo"] != null) ? $_POST["codigo"] : "";
    $descricao = (isset($_POST["descricao"]) && $_POST["descricao"] != null) ? $_POST["descricao"] : "";
    $preco = (isset($_POST["preco"]) && $_POST["preco"] != null) ? $_POST["preco"] : "";

    $objProduto = new Produto();
    $objProduto->setCodigo($codigo);
    $objProduto->setDescricao($descricao);
    $objProduto->setPreco($preco);

    $error = $objProduto->valydate();
    $success = null;

    if (is_null($error)) {
      $objProdutoDao = new ProdutoDao();
      $objProdutoDao->setProduto($objProduto);
      $success = $objProdutoDao->insert();
    }

  }
?>
<div class="container">
  <ol class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li><a class="active" href="#">Cadastrar Produto</a></li>
  </ol>
  <div class="jumbotron">
    <h1>Cadastrar Produto</h1>
  </div>
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form method="POST">
        <div class="form-group">
          <label>Código</label>
          <input type="text" name="codigo" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Descrição</label>
          <input type="text" name="descricao" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Preço</label>
          <input type="number" name="preco" class="form-control" min="0" step="0.01" required>
        </div>
        <?php if ($success != null) : ?>
          <div class="alert alert-success" role="alert"><?php echo $success ?></div>
        <?php endif ?>
        <?php if ($error != null) : ?>
          <div class="alert alert-danger" role="alert"><?php echo $error ?></div>
        <?php endif ?>
        <button type="submit" class="btn btn-default">Salvar</button>
        <a href="index.php" class="btn btn-default" role="button">Cancelar</a>
      </form>
    </div>
  </div>
</div>
<?php include 'src/includes/footer.php'?>
