const msg = document.querySelector("#mensagem");
const xhr = new XMLHttpRequest();
const tableMesa = document.querySelector("#mesa");
const urlMesa = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.mesa.php?id_mesa=0";

function listaMesa() {
    fetch(urlMesa)
        .then(function (resp) {
            if (!resp.ok)
                throw new Error("Erro ao executar requisição: " + resp.status);
            return resp.json();
        })
        .then(function (data) {
            data.forEach((val) => {
                let row = document.createElement("tr");
                row.innerHTML = `<tr><td><center><h3>${val.id_mesa}<h3></center></td></tr>`;
                row.innerHTML += `<tr><td><center><h3>${val.descricao}<h3></center></td></tr>`;
                row.innerHTML += `<tr><td><center><h3>${val.id_usuario}<h3></center></td></tr>`;
                row.innerHTML += `<td style="padding:3px"><button onclick='editMesa(this)'>Edit</button><button onclick='delMesa(this)'>Del</button></td></tr>`;
                tableMesa.appendChild(row);
            });
        }) 
        .catch(function (error) {
            console.error(error.message);
        });
    }

 function criaMesa(){
    let url = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.mesa.php"
    let descricao = document.querySelector("#descricao");
    let id_usuario = document.querySelector("#id_usuario");
    if (descricao.value != "" && id_usuario.value !=""){
        let dados = new FormData();
        dados.append("descricao", descricao.value);
        dados.append("id_usuario", id_usuario.value);
        dados.append("verbo", "POST");
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                    msg.innerHTML = resp.erro;
                } else {
                    msg.innerHTML = "Mesa Cadastrada com sucesso";
                }
                setTimeout(() => { window.location.reload(); }, 1000);
            }
        });
        xhr.open("POST", url);
        xhr.send(dados);
    } else {
        msg.innerHTML = "Preencher todos os campos.";
        setTimeout(() => { msg.innerHTML = "Mensagens do sistema"; }, 1000);
    }
}

function editMesa(p) {
    p.parentNode.parentNode.cells[1].setAttribute("contentEditable", "true");
    p.parentNode.parentNode.cells[2].setAttribute("contentEditable", "true");
    p.parentNode.parentNode.cells[3].innerHTML = "<button onclick='putMesa(this)'>Enviar</button>";
}

function putMesa(p) {
    let url = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.mesa.php"; 
    let id_mesa = p.parentNode.parentNode.cells[0].innerHTML;
    let descricao = p.parentNode.parentNode.cells[1].innerHTML;
    let id_usuario = p.parentNode.parentNode.cells[2].innerHTML;
    
    let dados = new FormData();
    dados.append("id_mesa", id_mesa);
    dados.append("descricao", descricao);
    dados.append("id_usuario", id_usuario);
    dados.append("verbo","PUT");

    if (window.confirm("Confirma Alteração dos dados?")) {
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                    msg.innerHTML = resp.erro;
                } else {
                    msg.innerHTML = "Configurações da mesa alterada.";
                }
                setTimeout(() => { window.location.reload(); }, 1000);
            }
        });
        xhr.open("POST", url);
        xhr.send(dados);
    }
}
function delMesa(p) {
    let url = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.mesa.php";
    let id_mesa = p.parentNode.parentNode.cells[0].innerText;
    let dados = new FormData();
    dados.append("id_mesa", id_mesa);
    dados.append("verbo","DELETE")

    if (window.confirm("Confirma Exclusão do id " + id_mesa + "?")) {
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                    msg.innerHTML = resp.erro;
                } else {
                    msg.innerHTML = "Mesa excluida com sucesso.";
                }
                setTimeout(() => { window.location.reload(); }, 1000);
            }
        });
        xhr.open("POST", url);
        xhr.send(dados);
    }
}