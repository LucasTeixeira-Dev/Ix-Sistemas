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
                row.innerHTML = `<tr><td></td>`;
                row.innerHTML += `<tr><td>${val.nome}</td>`;
                row.innerHTML += `<tr><td>${val.descricao}</td>`;
                row.innerHTML += `<tr><td>${val.valor}</td>`;
                row.innerHTML += `<tr><td>${val.tipos}</td>`;
                tableProduto.appendChild(row);
            });
        }) 
        .catch(function (error) {
            console.error(error.message);
        });
}
