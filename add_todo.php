<?php 
// echo "La tâche : ".$_POST['task'];

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

    $requete = "INSERT INTO todo(task_todo) VALUES(:task)";

    $data = $db->prepare($requete);

    $data->execute(array(
        "task" => $_POST['task']
    ));

    if($data->rowCount() == 1){
        echo "Tâche ajoutée";
    } else {
        echo "Erreur";
    }

} catch (Exception $e) {
    echo "Connexion refusée à la base de données";
    exit();
}

// Préparation de la requête

// Execution de la requête

?>