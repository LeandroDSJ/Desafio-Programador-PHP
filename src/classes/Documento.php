<?php
class Documento {
  private $numero;
  private $total;
  private $confirmado;

  public function setNumero($numero) {
    $this->numero = $numero;
  }

  public function getNumero() {
    return $this->numero;
  }

  public function setTotal($total) {
    $this->total = $total;
  }

  public function getTotal() {
    return $this->total;
  }

  public function setConfirmado($confirmado) {
    $this->confirmado = $confirmado;
  }

  public function getConfirmado() {
    return $this->confirmado;
  }

}
