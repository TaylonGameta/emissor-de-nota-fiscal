function create(obj){
    axios({
        url: "http://localhost/nfeasy/public/api/destinario/create.php",
        method: "POST",
        header: {Authentication: `bearer ${localStorage.getItem('nfeasy-token')}`}
    })
}