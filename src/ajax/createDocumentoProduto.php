<?php
include '../classes/Connection.php';
include '../classes/ProdutoDao.php';
include '../classes/Produto.php';
include '../classes/DocumentoDao.php';
include '../classes/Documento.php';
include '../classes/DocumentoProdutoDao.php';
include '../classes/DocumentoProduto.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $codigo = (isset($_POST["codigo"]) && $_POST["codigo"] != null) ? $_POST["codigo"] : "";
  $objProduto = ProdutoDao::findByCodigo($codigo);

  if ($objProduto instanceof Produto) {
    $DocumentoNumero = $_POST["documento_numero"];
    if ($DocumentoNumero == "") {
      $objDocumento = new Documento();
      $objDocumento->setTotal(0);
      $objDocumento->setConfirmado(0);

      $objDocumentoDao = new DocumentoDao();
      $objDocumentoDao->setDocumento($objDocumento);
      $DocumentoNumero = $objDocumentoDao->insert();
    }

    $objDocumentoProduto = new DocumentoProduto();
    $objDocumentoProduto->setDocumentoNumero($DocumentoNumero);
    $objDocumentoProduto->setProdutoCodigo($objProduto->getCodigo());

    $objDocumentoProdutoDao = new DocumentoProdutoDao();
    $objDocumentoProdutoDao->setDocumentoProduto($objDocumentoProduto);
    $objDocumentoProdutoDao->insert();

    echo json_encode(['documentoNumero' => $DocumentoNumero,
                      'ProdutoCodigo' => $objProduto->getCodigo(),
                      'ProdutoDescricao' => $objProduto->getDescricao(),
                      'ProdutoPreco' => $objProduto->getPreco(),
                      'status' => 'sucesso']);

} else {
    echo json_encode(['status'=>'erro']);
  }
}
