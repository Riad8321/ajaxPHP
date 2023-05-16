<?php
$_POST = json_decode(file_get_contents("php://input"), true);
    echo($_POST['title']);
    echo("<br/>");
    echo($_POST['content']);




    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=blog;charset=utf8',
            'root',
            '',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    
        $requete = "INSERT INTO posts(title, content) VALUES(:title, :content)";
    
        $data = $db->prepare($requete);
    
        $data->execute(array(
            "title" => $_POST['title'],
            "content" => $_POST['content'],
        ));
    
    
        if($data->rowCount() == 1){
            http_response_code(201); // OK
            echo json_encode(array("Message" => "Article ajouté", "ErreurCode" => 0));
        } else {
            http_response_code(500); // Erreur serveur
            echo json_encode(array("Message" => "Impossible d'ajouter l'article", "ErreurCode" => 1));
        }
    
    } catch (Exception $e) {
        http_response_code(500); // Erreur connexion BDD
        echo json_encode(array("Message" => "Connexion refusée à la base de données", "ErreurCode" => 1));
        exit();
    }
    
?>