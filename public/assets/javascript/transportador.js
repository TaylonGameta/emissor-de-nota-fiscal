
/*
** function to handle transportador stuff
*/


// fetch the data to create transportador table
fetchData();

function fetchData(){
    axios({
        url: "http://localhost/nfeasy/public/api/transportador/getall.php",
        method: "POST",
        headers: {Authorization: `Bearer ${localStorage.getItem('nfeasy-token')}`}
    })
    .then(result=>{
        let table = document.getElementById("transportador-table")

        if(table){
            result.data.forEach(item=>{
                table.insertAdjacentHTML("beforeend", `
                    <td class=table-item><a href=http://localhost/nfeasy/public/transportador/getitem.php?id=${item.id}>${item.nome}</a></td>
                    <td class=table-item><a href=http://localhost/nfeasy/public/transportador/getitem.php?id=${item.id}>${item.cnpj}</a></td>
                    <td class=table-item><a href=http://localhost/nfeasy/public/transportador/getitem.php?id=${item.id}>${item.uf}</a></td>
                    <td class=table-item><a href=http://localhost/nfeasy/public/transportador/getitem.php?id=${item.id}>${item.inscricao_estadual}</a></td>
                    <td class=table-item><a href=http://localhost/nfeasy/public/transportador/getitem.php?id=${item.id}>${item.placa_do_veiculo}</a></td>
                    <td class=table-item><a href=http://localhost/nfeasy/public/transportador/getitem.php?id=${item.id}>${item.frete_por_conta}</a></td>
                    <td class=table-item><a href=http://localhost/nfeasy/public/transportador/getitem.php?id=${item.id}>${item.cod_antt}</a></td>
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


// create a new transportador
function create(){

    const transportador = {
        nome : document.getElementById("nome").value,
        cnpj : document.getElementById("cnpj").value,
        uf : document.getElementById("uf").value,
        inscricao_estadual : document.getElementById("inscricao_estadual").value,
        placa_do_veiculo : document.getElementById("placa_do_veiculo").value,
        frete_por_conta : Number(document.getElementById("frete_por_conta").value),
        cod_antt : Number(document.getElementById("cod_antt").value)
    }

    axios({
        url: "http://localhost/nfeasy/public/api/transportador/create.php",
        method: "POST",
        headers: {Authorization: `Bearer ${localStorage.getItem('nfeasy-token')}`},
        data:{ ...transportador }
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