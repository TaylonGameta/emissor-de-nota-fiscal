
/*
** function to handle emitente stuff
*/


// fetch the data to create emitente table
fetchData();

function fetchData(){
    axios({
        url: "http://localhost/nfeasy/public/api/emitente/getall.php",
        method: "POST",
        headers: {Authorization: `Bearer ${localStorage.getItem('nfeasy-token')}`}
    })
    .then(result=>{
        let table = document.getElementById("emitente-table")

        if(table){
            result.data.forEach(item=>{
                table.insertAdjacentHTML("beforeend", `
                    <td><a href=http://localhost/nfeasy/public/emitente/getitem.php?id=${item.id}>${item.nome}</a></td>
                    <td><a href=http://localhost/nfeasy/public/emitente/getitem.php?id=${item.id}>${item.cnpj}</a></td>
                    <td><a href=http://localhost/nfeasy/public/emitente/getitem.php?id=${item.id}>${item.uf}</a></td>
                    <td><a href=http://localhost/nfeasy/public/emitente/getitem.php?id=${item.id}>${item.inscricao_estadual}</a></td>
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


// create a new emitente
function create(){

    const emitente = {
        nome : document.getElementById("nome").value,
        cnpj : document.getElementById("cnpj").value,
        uf : document.getElementById("uf").value,
        inscricao_estadual : document.getElementById("inscricao_estadual").value
    }

    axios({
        url: "http://localhost/nfeasy/public/api/emitente/create.php",
        method: "POST",
        headers: {Authorization: `Bearer ${localStorage.getItem('nfeasy-token')}`},
        data:{ ...emitente }
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