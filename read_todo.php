<?php 
// Connexion à la base de données
try {
    $db = new PDO(
        'mysql:host=localhost;dbname=todo;charset=utf8',
        'root',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

    $requete = "SELECT id, task_todo FROM todo";

    $data = $db->prepare($requete);

    $data->execute();

    // Récupère toutes les données
    $data = $data->fetchAll();

    // Créer un tableau qui permet d'ajouter les données
    $tasks = array();

    foreach($data as $task){
        $task = array(
            "id" => $task["id"],
            "task" => $task['task_todo']
        );
        $tasks[] = $task;
    }

    header('Content-Type: application/json');
    echo json_encode($tasks);

} catch (Exception $e) {
    echo "Connexion refusée à la base de données";
    exit();
}

// Préparation de la requête

// Execution de la requête

?>