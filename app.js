const add = document.querySelector('#submit')
add.addEventListener('click', (e) => {
    e.preventDefault();

    // Capturer les données envoyées
    const input = document.querySelector('#addList')

    // console.log(input.value)

    // Envoyer les données
    sendData(input.value)

    // Effacer le champs de formulaire
    input.value = '';
})

async function sendData(value) {
    const url = 'add_todo.php'
    // Récupérer les données du formulaire
    const formData = new FormData();
    formData.append('task', value)

    const req = await fetch(url, 
    {
        method: 'POST',
        body: formData
    })

    const response = await req.json()

    // Met à jour le dom avec toutes les tâches
    await getAllTasks()
}

async function getAllTasks() {
    console.log("Mettre à jour les tâches")
    const url = 'read_todo.php'

    const req = await fetch(url)
    const resp = await req.json()

    // Reset le contenu du ul
    document.querySelector('ul').innerHTML = ''

    // console.log(resp)
    // Parcourir les données
    resp.forEach(data => {
        // Afficher sur le DOM
        const li = `<li>${data.task} <a href="#" data-id="${data.id}" class="delete">X</a></li>`
        document.querySelector('ul').insertAdjacentHTML('beforeend', li)
    })

    await addListener()

}

getAllTasks()

async function addListener(){
    // Capturer le click sur la croix
    const deleteButton = document.querySelectorAll('.delete')
    deleteButton.forEach(button => {
        button.addEventListener('click', (e) => {
            // console.log(e.target.dataset.id)
            deleteTask(e.target.dataset.id)
        })
    })
}

// Supprimer une tache
async function deleteTask(taskID) {
    const url = `delete_todo.php?id=${taskID}`
    const req = await fetch(url)
    const resp = await req.json()

    // Mise à jour de la liste sur le DOM
    await getAllTasks()
}
