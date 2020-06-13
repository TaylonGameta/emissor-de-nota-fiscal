
/*
** function to handle destinario stuff
*/


// fetch the data to create destinario table
fetchData();

function fetchData(){
    axios({
        url: "http://localhost/nfeasy/public/api/destinario/getall.php",
        method: "POST",
        headers: {Authorization: `Bearer ${localStorage.getItem('nfeasy-token')}`}
    })
    .then(result=>{
        let table = document.getElementById("destinario-table")

        if(table){
            result.data.forEach(item=>{
                table.insertAdjacentHTML("beforeend", `
                    <td><a href=http://localhost/nfeasy/public/destinario/getitem.php?id=${item.id}>${item.nome}</a></td>
                    <td><a href=http://localhost/nfeasy/public/destinario/getitem.php?id=${item.id}>${item.cnpj}</a></td>
                    <td><a href=http://localhost/nfeasy/public/destinario/getitem.php?id=${item.id}>${item.endereco}</a></td>
                    <td><a href=http://localhost/nfeasy/public/destinario/getitem.php?id=${item.id}>${item.municipio}</a></td>
                    <td><a href=http://localhost/nfeasy/public/destinario/getitem.php?id=${item.id}>${item.uf}</a></td>
                    <td><a href=http://localhost/nfeasy/public/destinario/getitem.php?id=${item.id}>${item.telefone}</a></td>
                    <td><a href=http://localhost/nfeasy/public/destinario/getitem.php?id=${item.id}>${item.inscricao_estadual}</a></td>
                `)
            })
        }
    })
}


// functon to handle the come back button
function addOutro(){
    let container =  document.getElementById('main-container')
    container.classList.remove("none")

    let sContainer = document.getElementById('secund-container')
    sContainer.classList.add("none")
}


// create a new destinario
function create(){

    const destinario = {
        nome : document.getElementById("nome").value,
        cnpj : document.getElementById("cnpj").value,
        endereco : document.getElementById("endereco").value,
        municipio : document.getElementById("municipio").value,
        uf : document.getElementById("uf").value,
        telefone : document.getElementById("telefone").value,
        inscricao_estadual : document.getElementById("inscricao_estadual").value
    }

    axios({
        url: "http://localhost/nfeasy/public/api/destinario/create.php",
        method: "POST",
        headers: {Authorization: `Bearer ${localStorage.getItem('nfeasy-token')}`},
        data:{ ...destinario }
    })
    .then(result=>{
        if(result.data.success){
            let container =  document.getElementById('main-container')
            container.classList.add("none")

            let sContainer = document.getElementById('secund-container')
            sContainer.classList.remove("none")
        }
    })
}