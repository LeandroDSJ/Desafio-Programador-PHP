<?php include 'src/includes/head.php'?>
  <div class="container">
    <ol class="breadcrumb">
      <li><a class="active" href="#">Home</a></li>
    </ol>
    <div class="jumbotron">
      <h1>Sistema de Vendas</h1>
      <p>Escolha uma das opções abaixo para executar a tarefa</p>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <a href="cadastrar-produto.php" class="btn btn-primary btn-lg btn-block" role="button">Cadastrar Produto</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <a href="realizar-venda.php" class="btn btn-primary btn-lg btn-block" role="button">Realizar Venda</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <a href="#" class="btn btn-primary btn-lg btn-block" role="button">Visualizar Total Vendido</a>
      </div>
    </div>
  </div>
</ol>
<?php include 'src/includes/footer.php'?>
