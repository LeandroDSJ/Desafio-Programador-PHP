<?php
class DocumentoDao {
  private $documento;

  function setDocumento($documento) {
    $this->documento = $documento;
  }

  function getDocumento($documento) {
    return $this->documento;
  }

  public function insert() {
      $con = Connection::getConnection();
    try {
        $stmt = $con->prepare("INSERT INTO documento (TOTAL, CONFIRMADO) VALUES (?, ?)");

        $total = $this->documento->getTotal();
        $confirmado = $this->documento->getConfirmado();

        $stmt->bindParam(1, $total);
        $stmt->bindParam(2, $confirmado);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return $con->lastInsertId();
            } else {
                return null;
            }
        } else {
               throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
  }

  public static function calcTotal($numero) {
    $con = Connection::getConnection();
    try {
        $stmt = $con->prepare(
          "SELECT SUM(produto.PRECO) FROM produto
          WHERE produto.CODIGO in (SELECT documento_produto.PRODUTO_CODIGO FROM documento_produto dp
                                    WHERE documento_produto.DOCUMENTO_NUMERO = ?)
          ");
        $stmt->bindParam(1, $numero);
        if ($stmt->execute()) {
          if ($stmt->rowCount() > 0) {
            while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
              return $rs['total'];
            }
          }
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
  }

  public function update() {
      $con = Connection::getConnection();
    try {
        $stmt = $con->prepare("UPDATE INTO documento (TOTAL, CONFIRMADO) VALUES (?, ?)");

        $total = $this->documento->getTotal();
        $confirmado = $this->documento->getConfirmado();

        $stmt->bindParam(1, $total);
        $stmt->bindParam(2, $confirmado);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return 'Venda Confirmada!';
            } else {
                return 'Não foi possivel confirmar a veda!';
            }
        } else {
               throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
  }

  public static function findByNumero($numero) {
    $con = Connection::getConnection();
    try {
        $stmt = $con->prepare("SELECT * FROM documento WHERE NUMERO = ?");
        $stmt->bindParam(1, $numero);
        if ($stmt->execute()) {
          if ($stmt->rowCount() > 0) {
            while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $objDocumento = new Documento();
              $objDocumento->setNumero($rs['NUMERO']);
              $objDocumento->setTotal($rs['TOTAL']);
              $objDocumento->setConfirmado($rs['CONFIRMADO']);

              return $objDocumento;
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

  Public static function calcTotalVendido() {
    $con = Connection::getConnection();
    try {
        $stmt = $con->query("SELECT SUM(TOTAL)as total FROM documento WHERE CONFIRMADO = 1");
        while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $rs['total'];
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
  }
}
