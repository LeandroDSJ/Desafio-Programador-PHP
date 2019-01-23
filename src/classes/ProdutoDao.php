<?php
class ProdutoDao {
  private $produto;

  public function setProduto($produto) {
    $this->produto = $produto;
  }

  public function getProduto($produto) {
    return $this->produto;
  }

  public function insert() {
      $con = Connection::getConnection();
    try {
        $stmt = $con->prepare("INSERT INTO produto (CODIGO, DESCRICAO, PRECO) VALUES (?, ?, ?)");

        $codigo = $this->produto->getCodigo();
        $descricao = $this->produto->getDescricao();
        $preco = $this->produto->getPreco();

        $stmt->bindParam(1, $codigo);
        $stmt->bindParam(2, $descricao);
        $stmt->bindParam(3, $preco);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return "Produto Cadastrado com sucesso!";;
            } else {
                return "Erro ao tentar Cadastrar o Produto";
            }
        } else {
               throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
  }

  public static function findByCodigo($codigo) {
    $con = Connection::getConnection();
    try {
        $stmt = $con->prepare("SELECT * FROM produto WHERE CODIGO = ?");
        $stmt->bindParam(1, $codigo);
        if ($stmt->execute()) {
          if ($stmt->rowCount() > 0) {
            while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $objProduto = new Produto();
              $objProduto->setCodigo($rs['CODIGO']);
              $objProduto->setDescricao($rs['DESCRICAO']);
              $objProduto->setPreco($rs['PRECO']);
              return $objProduto;
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
