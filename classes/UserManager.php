<?php

class UserManager
{
    private $users = []; // Armazena os usuários em memória

    public function addUser($user)
    {
        // Verifica se o e-mail já está cadastrado
        foreach ($this->users as $u) {
            if ($u->getEmail() === $user->getEmail()) {
                throw new Exception("E-mail já está em uso!");
            }
        }

        // Verifica se a idade é maior que 0
        if ($user->getAge() <= 0) {
            throw new Exception("Idade deve ser maior que 0!");
        }

        // Adiciona o usuário ao array
        $this->users[] = $user;
    }

    public function getUsers()
    {
        return $this->users; // Retorna todos os usuários cadastrados
    }
}
?>
