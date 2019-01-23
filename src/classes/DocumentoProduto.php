<?php
class DocumentoProduto {
  private $documentoNumero;
  private $produtoCodigo;

  public function setDocumentoNumero($documentoNumero) {
    $this->documentoNumero = $documentoNumero;
  }

  public function getDocumentoNumero() {
    return $this->documentoNumero;
  }

  public function setProdutoCodigo($produtoCodigo) {
    $this->produtoCodigo = $produtoCodigo;
  }

  public function getProdutoCodigo() {
    return $this->produtoCodigo;
  }
}
