/*
*** function to send a request and get back a token that will be added in localstorage
*/

function login(){
    
    //get user credentials - email and password

    const credentials = {
        email: document.getElementById("email").value,
        password: document.getElementById("password").value
    }
    
    axios({
        url: "http://localhost/nfeasy/public/api/usuario/login.php",
        method: "post",
        data:{ ...credentials }
    })
    .then(result=>{
        if(result.data.token){
            localStorage.setItem('nfeasy-token', result.data.token)
            window.location.href = "http://localhost/nfeasy/public/adddestinario"
        }
        if(result.data.error){
            document.getElementById('error').innerHTML = result.data.error
        }
    })
}