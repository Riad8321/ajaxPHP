const tache = document.querySelector("#text")
const button = document.querySelector("#add")
const responseServer = document.querySelector("#response-server")


let listeTaches = []

async function postJSON(data) {
    try {
        const url = 'add_todo.php';
        const formData = new FormData()
        formData.append('tasks', data)
        const response = await fetch(url, {
            method: "POST",
            body: formData
      });
  
    const result = await response.json();
    console.log("Success:", result);
    

    } catch (error) {
      console.error("Error:", error);
    }
  }

button.addEventListener("click", (e)=>{
    e.preventDefault();
    listeTaches.push(tache.value)
    console.log(listeTaches)
    postJSON(listeTaches)
})



