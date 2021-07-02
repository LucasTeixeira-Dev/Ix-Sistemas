const msg = document.querySelector("#mensagem");
const xhr = new XMLHttpRequest();
const tableProduto = document.querySelector("#produto");
const urlProduto = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.produto.php?id_produto=0";


function listaProduto() {
    fetch(urlProduto)
        .then(function (resp) {
            if (!resp.ok)
                throw new Error("Erro ao executar requisição: " + resp.status);
            return resp.json();
        })
        .then(function (data) {
            console.log(data);
            data.forEach((val) => {
                let row = document.createElement("tr");
                row.innerHTML = `<tr><td><center><h3>${val.id_produto}</h3></center></td></tr>`;
                row.innerHTML += `<tr><td><center><h3>${val.nome}</h3></center></td></tr>`;
                row.innerHTML += `<tr><td><center><h3>${val.descricao}</h3></center></td></tr>`;
                row.innerHTML += `<tr><td><center><h3>${val.valor}</h3></center></td></tr>`;
                row.innerHTML += `<tr><td><center><h3>${val.tipos}</h3></center></td></tr>`;
                tableProduto.appendChild(row);
            });
        }) 
        .catch(function (error) {
            console.error(error.message);
        });
}
