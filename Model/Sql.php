<?php

// Informando o namespace da class
namespace Model;

class Sql extends \PDO
{
    //Atributos
    private $host = HOST;
    private $banco = BANCO;
    private $usuario = USUARIO;
    private $senha = SENHA;
    private $conexao;

    // Metodos

    // Construtor que inicia a conexâo com o banco de dados
    public function __construct()
    {
        $this->conexao = new \PDO("mysql:host=$this->host;dbname=$this->banco", "$this->usuario", "$this->senha");
    }

    // Responsavel por Executar o comando passado por parametro no banco de dados
    public function executaComando($sql, $parametros = array())
    {
        // Preparando a instrução sql
        $stmt = $this->conexao->prepare($sql);

        // Trocando os parametros pelos valores
        foreach($parametros as $indice => $valor)
        {
            $stmt->bindValue($indice, $valor);
        }

        // Executando e verificando ser a execução foi bem sucedida
        if($stmt->execute())
        {
            return $mensagem = true;
        }
        else
        {
            return $mensagem =  false;
        }
        
    }

    // Respnsavel por selecionar os dados no banco de dados e trazer eles em formato de array
    public function select($sql, $parametros = array())
    {
         // Preparando a instrução sql
        $stmt = $this->conexao->prepare($sql);

         // Trocando os parametros pelos valores
        foreach($parametros as $indice => $valor)
        {
            $stmt->bindValue($indice, $valor);
        }

         // Executando 
        $stmt->execute();
        
        // retornando os dados do SELECT
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

}


?>