<?php include 'src/includes/head.php'?>
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
        <form id="DocumentoProduto">
          <div class="form-group">
            <label>Produto</label>
            <input type="text" name="codigo" class="form-control" required>
          </div>
          <div id="alert-DocumentoProduto" class="alert hide" role="alert"></div>
          <button type="submit" id="sbmt_codigo" class="btn btn-default">Ok</button>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <label>Tabela de Produtos</label>
        <div class="panel panel-default">
          <table class="table">
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
        <form>
          <input type="hidden" name="documento_numero" value="">
          <button type="submit" class="btn btn-default">Confirmar</button>
          <a href="index.php" class="btn btn-default" role="button">Cancelar</a>
        </form>
      </div>
    </div>
  </div>
</ol>
<?php include 'src/includes/footer.php'?>
<script>
$(document).ready(function(){
  $('#DocumentoProduto').submit(function(e) {
    e.preventDefault();
    var codigo = $('input[name="codigo"]').val();
    var documento_numero = $('input[name="documento_numero"]').val();
    $.ajax({
        url: 'src/ajax/createDocumentoProduto.php',
        type: 'POST',
        data: {codigo,documento_numero},
        beforeSend: function() {
          $('#sbmt_codigo').html('<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Aguarde');
        },
        success: function(response) {
            console.log(response);
              $('#sbmt_codigo').html('Ok');
              $('input[name="documento_numero"]').val(response.documentoNumero);
              if (response.status == 'sucesso') {
                $('#alert-DocumentoProduto').attr('class','alert-success');
                $('#alert-DocumentoProduto').html('Produto incluso na venda.');
                $('#alert-DocumentoProduto').show();
              } else {
                $('#alert-DocumentoProduto').attr('class','alert-danger');
                $('#alert-DocumentoProduto').html('Produto não cadastrado.');
                $('#alert-DocumentoProduto').show();
              }



        },
        error: function(xhr, status, error) {
            $('#sbmt_codigo').html('Ok');
        }
    });
    return false;
  });
});
</script>
