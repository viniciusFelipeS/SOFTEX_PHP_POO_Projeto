<?php

namespace App\src;

use App\db\DataBase;
use \App\session\Login;

abstract class Usuario
{
    /**
     * ID do usuário
     *
     * @var integer
     */
    public $id;

    /**
     * Nome do usuário
     *
     * @var string
     */
    public $nome;

    /**
     * Email do usuário
     *
     * @var string
     */
    public $email;
    
    /**
     * Senha do usuário
     *
     * @var string
     */
    public $senha;
    
        
    /**
     * Método que verifica o banco de dados através do email
     *
     * @param  string $email
     * @return Usuario
     */
    public static function  getUsuarioEmail($db,$email){
        return (new DataBase($db))->getSelectDB('email = "'.$email.'"')->fetchObject();
    }
}
