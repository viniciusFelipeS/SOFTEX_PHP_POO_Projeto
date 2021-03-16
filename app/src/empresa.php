<?php

namespace App\src;

use \App\src\Usuario;
use \App\db\DataBase;
use \App\session\Login;


class Empresa extends Usuario
{
  public $cnpj;

  public $foto;

  /**
   * Método que define os valores de acordo com o POST
   *
   * @param  string $nome
   * @param  string $email
   * @param  string $senha
   * @param  string $cnpj
   * @return void
   */
  public function setValores($foto,$nome, $email, $senha, $cnpj)
  {
    $this->foto = $foto;
    $this->nome = $nome;
    $this->email = $email;
    $this->senha = $senha;
    $this->cnpj = $cnpj;
  }

  /**
   * Método que cadastra uma nova empresa no banco de dados
   *
   * @return boolean
   */
  public function setEmpresaDB()
  {
    $objDataBase = new DataBase('empresa');

    $this->id = $objDataBase->setInsertDB([
      'foto' => $this->foto,
      'nome' => $this->nome,
      'email' => $this->email,
      'senha' => $this->senha,
      'cnpj' => $this->cnpj,
    ]);
  }

  /**
   * Método que verifica o banco de dados através do email
   *
   * @param  string $email
   * @return Usuario
   */
  public static function  getEmpresaCadastro($db, $email, $cnpj)
  {
    return (new DataBase($db))->getSelectDB('email = "' . $email . '" or cnpj = "' . $cnpj . '"')->fetchObject(self::class);
  }

  /**
   * Método que verifica o banco de dados através do email
   *
   * @param  string $email
   * @return Usuario
   */
  public static function  getUsuarioEmail($email)
  {
    return (new DataBase('empresa'))->getSelectDB('email = "' . $email . '"')->fetchObject();
  }

  /**
   * Método que cria uma $_SESSION do cliente quando autenticado
   *
   * @param  object Client $objUsuario
   * @param  string $location
   */
  public static function autenticado($objUsuario)
  {
    Login::autenticado($objUsuario, 'empresa.php', __CLASS__);
  }
}
