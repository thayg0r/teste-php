<?php

// Classe que representa um usuário
class User
{
    private $name;
    private $email;
    private $age;

    // Construtor para inicializar os atributos do usuário
    public function __construct($name, $email, $age)
    {
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
    }

    // Retorna o nome do usuário
    public function getName()
    {
        return $this->name;
    }

    // Retorna o e-mail do usuário
    public function getEmail()
    {
        return $this->email;
    }

    // Retorna a idade do usuário
    public function getAge()
    {
        return $this->age;
    }
}
?>
