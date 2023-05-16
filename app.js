// import axios from 'axios';

const postSubmit = document.querySelector("#submit")

postSubmit.addEventListener('click', (e)=>{
    e.preventDefault()

    const postTitle = document.querySelector("#post-title")
    const postContent = document.querySelector("#post-content")
   

    const data = {
        title: postTitle.value,
        content: postContent.value,
      };

       
    
      sendData(data)
})


const sendData = (data)=>{
    axios({
        url: 'add_post.php',
        method: 'post',
        TransformRequest: [(data, header)=>{
            return JSON.stringify(data);
        }],
        data: data
      })
} 
