<?php
include 'src/includes/head.php';
include 'src/classes/Documento.php';
include 'src/classes/DocumentoDao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $confirmado = (isset($_POST["confirmado"]) && $_POST["confirmado"] != null) ? $_POST["confirmado"] : "0";
    $documentoNumero = (isset($_POST["documento_numero"]) && $_POST["documento_numero"] != null) ? $_POST["documento_numero"] : "";

    if ($documentoNumero != null) {
        $objDocumento = DocumentoDao::findByNumero($documentoNumero);
        $objDocumento->setConfirmado($confirmado);
        $objDocumento->setTotal(DocumentoDao::calcTotal($objDocumento->getNumero()));
        $objDocumentoDao = new DocumentoDao();
        $objDocumentoDao->setDocumento($objDocumento);
        $objDocumentoDao->update();
    }
}
?>
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li><a class="active" href="#">Realizar Venda</a></li>
    </ol>
    <div class="jumbotron">
      <h1>Realizar Venda</h1>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <form id="DocumentoProduto" method="POST">
          <div class="form-group">
            <label>Produto</label>
            <input type="text" name="codigo" class="form-control" required>
          </div>
          <div id="alert-DocumentoProduto" class="hide" role="alert"></div>
          <button type="submit" id="sbmt_codigo" class="btn btn-default">Ok</button>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <label>Tabela de Produtos</label>
        <div class="panel panel-default">
          <table class="table" id="product-table">
            <thead>
              <tr>
                <th>Código</th>
                <th>Descrição</th>
                <th>Preço</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <form method="POST">
          <input type="hidden" name="documento_numero">
            <input type="hidden" name="confirmado" value="1">
          <button type="submit" class="btn btn-default">Confirmar</button>
          <a href="index.php" class="btn btn-default" role="button">Cancelar</a>
        </form>
      </div>
    </div>
  </div>
</ol>
<?php include 'src/includes/footer.php'?>

