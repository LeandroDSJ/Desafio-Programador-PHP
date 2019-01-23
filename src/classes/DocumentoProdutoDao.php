<?php
class DocumentoProdutoDao {
  private $documentoProduto;

  function setDocumentoProduto($documentoProduto) {
    $this->documentoProduto = $documentoProduto;
  }

  function getDocumentoProduto($documentoProduto) {
    return $this->documentoProduto;
  }

  public function insert() {
      $con = Connection::getConnection();
    try {
        $stmt = $con->prepare("INSERT INTO documento_produto (DOCUMENTO_NUMERO, PRODUTO_CODIGO) VALUES (?, ?)");

        $documentoNumero = $this->documentoProduto->getDocumentoNumero();
        $produtoCodigo = $this->documentoProduto->getProdutoCodigo();

        $stmt->bindParam(1, $documentoNumero);
        $stmt->bindParam(2, $produtoCodigo);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
              return "Produto inserido com sucesso!";;
          } else {
              return "Produto nao cadastrado!";
          }
        } else {
               throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
  }
}
