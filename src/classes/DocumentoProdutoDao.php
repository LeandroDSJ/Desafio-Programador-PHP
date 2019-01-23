<?php
include_once 'Connection.php';

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

    public static function find($numero, $codigo) {
        $con = Connection::getConnection();
        try {
            $stmt = $con->prepare("SELECT * FROM documento_produto WHERE DOCUMENTO_NUMERO = ? AND PRODUTO_CODIGO = ?");
            $stmt->bindParam(1, $numero);
            $stmt->bindParam(2, $codigo);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $objDocumentoProduto = new DocumentoProduto();
                        $objDocumentoProduto->setProdutoCodigo($rs['PRODUTO_CODIGO']);
                        $objDocumentoProduto->setDocumentoNumero($rs['DOCUMENTO_NUMERO']);
                        return $objDocumentoProduto;
                    }
                } else {
                    return null;
                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: ".$erro->getMessage();
        }
    }
}
