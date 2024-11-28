<?php
require_once 'classes/User.php';
require_once 'classes/UserManager.php';

// Instância de UserManager para gerenciar os usuários cadastrados
$userManager = new UserManager();

// Inicialização de variáveis para mensagens de erro e sucesso
$errorMessage = "";
$successMessage = "";

// Lógica para processar o formulário enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $age = intval(trim($_POST['age']));

    try {
        // Cria um novo objeto User com os dados enviados
        $user = new User($name, $email, $age);

        // Tenta adicionar o usuário usando o UserManager
        $userManager->addUser($user);

        // Exibe mensagem de sucesso caso tudo seja válido
        $successMessage = "Usuário cadastrado com sucesso!";
    } catch (Exception $e) {
        // Exibe mensagem de erro caso ocorra alguma validação falha
        $errorMessage = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="logo-container">
            <img src="images/logo-gvd.png" alt="Logo da aplicação" class="logo">
        </div>
        
        <h1>Gerenciamento de Usuários</h1>

        <!-- Formulário de cadastro de usuários -->
        <form method="POST" action="">
            <h2>Cadastrar Usuário</h2>
            
            <!-- Exibe mensagem de erro, caso exista -->
            <?php if ($errorMessage): ?>
                <div class="error"><?php echo $errorMessage; ?></div>
            <?php endif; ?>

            <!-- Exibe mensagem de sucesso, caso exista -->
            <?php if ($successMessage): ?>
                <div class="success"><?php echo $successMessage; ?></div>
            <?php endif; ?>

            <!-- Campos do formulário -->
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="age">Idade:</label>
            <input type="number" id="age" name="age" required>

            <button type="submit">Cadastrar</button>
        </form>

        <h2>Usuários Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Idade</th>
                </tr>
            </thead>
            <tbody>
                <!-- Exibe os usuários retornados pelo método getUsers -->
                <?php foreach ($userManager->getUsers() as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user->getName()); ?></td>
                        <td><?php echo htmlspecialchars($user->getEmail()); ?></td>
                        <td><?php echo htmlspecialchars($user->getAge()); ?></td>
                    </tr>
                <?php endforeach; ?>

                <!-- Exibe mensagem caso não existam usuários cadastrados -->
                <?php if (empty($userManager->getUsers())): ?>
                    <tr>
                        <td colspan="3">Nenhum usuário cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
