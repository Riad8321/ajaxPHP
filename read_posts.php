<?php 
// Connexion à la base de données
try {
    $db = new PDO(
        'mysql:host=localhost;dbname=blog;charset=utf8',
            'root',
            '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

    $requete = "SELECT id, title, content, post_date FROM posts";

    $data = $db->prepare($requete);

    $data->execute();

    // Récupère toutes les données
    $data = $data->fetchAll();

    // Créer un tableau qui permet d'ajouter les données
    $posts = array();

    foreach($data as $post){
        $posts = array(
            "id" => $post['id'],
            "title" => $post["title"],
            "content" => $post['content'],
            "post_date" => $post['post_date']
        );

        
        $posts[] = $post;
        echo($posts[0]['id']);
    }

    header('Content-Type: application/json');
    http_response_code(200); // Tout s'est bien passé
    echo json_encode($posts);

} catch (Exception $e) {
    http_response_code(500); // Erreur connexion BDD
    echo json_encode("Connexion refusée à la base de données");
    exit();
}
?>