<?php
session_start();


if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $dsn = "mysql:host=localhost;dbname=https://neo01mrt.github.io/dtb";
    $username = "admin";
    $password = "admin";

    try {
        $pdo = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }

    
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php"); 
        exit();
    } else {
        
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

