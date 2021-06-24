const msg = document.querySelector("#mensagem");
const xhr = new XMLHttpRequest();
const tablePeddetalhes = document.querySelector("#peddetalhes");
const urlPeddetalhes = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.itens.php?id_pedido=0";


function listaPeddetalhes() {
    fetch(urlPeddetalhes)
        .then(function (resp) {
            if (!resp.ok)
                throw new Error("Erro ao executar requisição: " + resp.status);
            return resp.json();
        })
        .then(function (data) {
            console.log(data);
            data.forEach((val) => {
                let row = document.createElement("tr");
                row.innerHTML = `<tr><td>${val.id_pedido}</td>`;
                row.innerHTML += `<tr><td>${val.nome}</td>`;
                row.innerHTML += `<tr><td>${val.data}</td>`;
                row.innerHTML += `<tr><td>${val.hora}</td>`;
                row.innerHTML += `<tr><td>${val.status}</td>`;
                row.innerHTML += `<tr><td>${val.obs}</td>`;
                tablePeddetalhes.appendChild(row);
            });
        }) 
        .catch(function (error) {
            console.error(error.message);
        });
}


