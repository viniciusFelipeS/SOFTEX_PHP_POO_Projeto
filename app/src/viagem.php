<?php

namespace App\src;

use \App\db\DataBase;

use \PDO;

interface ViagemTemplate{
  
  /**
   * 
   *
   * @param  mixed $id
   * @return void
   */
  public function diminuirAssento($id);
  public function setValores($id_empresa, $origem, $destino, $data, $hora, $preco, $assentos);
  public function setViagemDB();
  

}


class Viagem implements ViagemTemplate
{

  /**
   * ID do ôniibus
   *
   * @var integer
   */
  public $id;

  /**
   * id_Empresa que está disponibilizando a viagem
   *
   * @var string
   */
  public $nome;

  /**
   * Cidade de origem da viagem
   *
   * @var string
   */
  public $origem;

  /**
   * Cidade destino da viagem
   *
   * @var string
   */
  public $destino;

  /**
   * Data da saída do ônibus
   *
   * @var string
   */
  public $data;

    /**
   * Horaa da saída do ônibus
   *
   * @var string
   */
  public $hora;

  /**
   * Preço da passagem da viagem
   *
   * @var float
   */
  public $preco;

  /**
   * Número de assentos disponivéis que o ônibus possui
   *
   * @var integer
   */
  public $assento;



  /**
   * Método que recebe o valor do POST
   *
   * @param  string $id_empresa
   * @param  string $origem
   * @param  string $destino
   * @param  string $data
   * @param  string $hora
   * @param  integer $preco
   * @param  string $assentos
   * @return void
   */
  public function setValores($id_empresa, $origem, $destino, $data, $hora, $preco, $assentos)
  {
    $this->id_empresa = $id_empresa;
    $this->origem = $origem;
    $this->destino = $destino;
    $this->data = $data;
    $this->hora = $hora;
    $this->preco = $preco;
    $this->assentos = $assentos;
  }

  /**
   * Método que insere uma nova viagem no banco de dados
   *
   * @return boolean
   */
  public function setViagemDB()
  {
    $objDataBase = new DataBase('viagem');

    $this->id = $objDataBase->setInsertDB([
      'id_empresa' => $this->id_empresa,
      'origem' => $this->origem,
      'destino' => $this->destino,
      'data' => $this->data,
      'hora' => $this->hora,
      'preco' => $this->preco,
      'assento' => $this->assentos,
    ]);
  }

  /**
   * Método que exibe as viagens disponíveis do banco de dados
   *
   * @param string $where
   * @param string $order
   * @param string $limit
   * @param string $innerJoin
   * @return array
   */
  public static function getViagens($where = null, $order = null,   $limit = null, $campo = '*', $innerJoin = null)
  {
    return (new DataBase('viagem'))->getSelectDB($where, $order, $limit, $campo, $innerJoin)->fetchAll(PDO::FETCH_CLASS, self::class);
  }

  public static function delViagemDB($where){
    $objDataBase = new DataBase('viagem');
    $sucesso = $objDataBase->setDeleteDB($where);
    if ($sucesso) return true;
    return false;
  }

  /**
   * Método que diminuiu um assento disponivél de uma viagem quando uma compra é realizada
   *
   * @param integer $qnt
   * @param integer $id
   * @return boolean
   */
  public function diminuirAssento($id)
  {
    $objDataBase = new DataBase('viagem');
    if ($objDataBase->getSelectDB('id = ' . $id, null, null, 'assento')->fetchColumn() > 0) {
      return $objDataBase->setDecrementUpdateDB('assento  = assento -1', 'id = ' . $id);
    }
    return false;
  }
}
