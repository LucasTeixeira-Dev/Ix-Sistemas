const msg = document.querySelector("#mensagem");
const xhr = new XMLHttpRequest();
const tablePedido = document.querySelector("#pedido");
const urlPedido = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.pedido.php?id_pedido=0";


function listaPedido() {
    fetch(urlPedido)
        .then(function (resp) {
            if (!resp.ok)
                throw new Error("Erro ao executar requisição: " + resp.status);
            return resp.json();
        })
        .then(function (data) {
            console.log(data);
            data.forEach((val) => {
                let row = document.createElement("tr");
                row.innerHTML = `<tr><td><center><h3>${val.id_pedido}</h3></center></td></tr>`;
                row.innerHTML += `<tr><td><center><h3>${val.id_mesa}</h3></center></td></tr>`;
                row.innerHTML += `<tr><td><center><h3>${val.data}</h3></center></td></tr>`;
                row.innerHTML += `<tr><td><center><h3>${val.hora}</h3></center></td></tr>`;
                row.innerHTML += `<tr><td><center><h3>${val.status}</h3></center></td></tr>`;
                row.innerHTML += `<tr><td><center><h3>${val.obs}</h3></center></td></tr>`;
                row.innerHTML += `<td style="padding:3px"><button onclick='editPedido(this)'>Edit</button></td></tr>`;
                tablePedido.appendChild(row);
            });
        }) 
        .catch(function (error) {
            console.error(error.message);
        });
}

function editPedido(p) {
    p.parentNode.parentNode.cells[4].setAttribute("contentEditable", "true");
    p.parentNode.parentNode.cells[5].setAttribute("contentEditable", "true");
    p.parentNode.parentNode.cells[6].innerHTML = "<button onclick='putPedido(this)'>Enviar</button>";
}

function putPedido(p) {
    let url = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.pedido.php";
    let id_pedido = p.parentNode.parentNode.cells[0].innerHTML;
    let id_mesa = p.parentNode.parentNode.cells[1].innerHTML;
    let data = p.parentNode.parentNode.cells[2].innerHTML;
    let hora = p.parentNode.parentNode.cells[3].innerHTML;
    let status = p.parentNode.parentNode.cells[4].innerHTML;
    let obs = p.parentNode.parentNode.cells[5].innerHTML;
    
    let dados = new FormData();
    dados.append("id_pedido", id_pedido);
    dados.append("id_mesa", id_mesa);
    dados.append("data", data);
    dados.append("hora", hora);
    dados.append("status", status);
    dados.append("obs", obs);
    dados.append("verbo","PUT");

    if (window.confirm("Confirma Alteração dos dados?")) {
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                    msg.innerHTML = resp.erro;
                } else {
                    msg.innerHTML = "Configurações do pedido alterado.";
                }
                setTimeout(() => { window.location.reload(); }, 1000);
            }
        });
        xhr.open("POST", url);
        xhr.send(dados);
    }
}
