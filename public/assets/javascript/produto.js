
/*
** function to handle produto stuff
*/


// fetch the data to create produto table
fetchData();

function fetchData(){
    axios({
        url: "http://localhost/nfeasy/public/api/produto/getall.php",
        method: "POST",
        headers: {Authorization: `Bearer ${localStorage.getItem('nfeasy-token')}`}
    })
    .then(result=>{
        let table = document.getElementById("produto-table")

        if(table){
            result.data.forEach(item=>{
                table.insertAdjacentHTML("beforeend", `
                    <td><a href=http://localhost/nfeasy/public/produto/getitem.php?id=${item.id}>${item.descricao}</a></td>
                    <td><a href=http://localhost/nfeasy/public/produto/getitem.php?id=${item.id}>${item.valor_unitario}</a></td>
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


// create a new produto
function create(){

    const produto = {
        descricao: document.getElementById("descricao").value,
        valor_unitario: Number(document.getElementById("valor-unitario").value),
    }


    axios({
        url: "http://localhost/nfeasy/public/api/produto/create.php",
        method: "POST",
        headers: {Authorization: `Bearer ${localStorage.getItem('nfeasy-token')}`},
        data:{ ...produto }
    })
    .then(result=>{
        console.log(result)

        if(result.data.success){
            let container =  document.getElementById('main-container')
            container.classList.add("none")

            let sContainer = document.getElementById('secund-container')
            sContainer.classList.remove("none")
        }
    })

}