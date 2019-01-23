<?php
include_once '../classes/Connection.php';
include_once '../classes/ProdutoDao.php';
include_once '../classes/Produto.php';
include_once '../classes/DocumentoDao.php';
include_once '../classes/Documento.php';
include_once '../classes/DocumentoProdutoDao.php';
include_once '../classes/DocumentoProduto.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = (isset($_POST["codigo"]) && $_POST["codigo"] != null) ? $_POST["codigo"] : "";
    $DocumentoNumero = $_POST["documento_numero"];

    $objProduto = ProdutoDao::findByCodigo($codigo);

    if ($objProduto instanceof Produto) {

        if ($DocumentoNumero == "") {
            $objDocumento = new Documento();
            $objDocumento->setTotal(0);
            $objDocumento->setConfirmado(0);

            $objDocumentoDao = new DocumentoDao();
            $objDocumentoDao->setDocumento($objDocumento);
            $DocumentoNumero = $objDocumentoDao->insert();
        }

        $objDocumentoProduto = DocumentoProdutoDao::find($DocumentoNumero, $objProduto->getCodigo());

        header('Content-Type: application/json');
        if (!$objDocumentoProduto instanceof DocumentoProduto) {
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
            echo json_encode(['documentoNumero' => $DocumentoNumero,'status'=>'repetido']);
        }
    } else {
        echo json_encode(['documentoNumero' => $DocumentoNumero,'status'=>'erro']);
    }
}
