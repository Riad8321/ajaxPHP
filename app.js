const tache = document.querySelector("#text")
const button = document.querySelector("#add")


let listeTaches = []

async function postJSON(data) {
    try {
        const url = 'add_todo.php';
        const response = await fetch(url, {
            method: "POST",
            headers: {
            "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
      });
  
      const result = await response.json();
      console.log("Success:", result);
    } catch (error) {
      console.error("Error:", error);
    }
  }

button.addEventListener("click", (e)=>{
    e.preventDefault
    listeTaches.push(tache.value)
    console.log(listeTaches)
    postJSON(listeTaches)
})



