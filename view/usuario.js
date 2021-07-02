const msg = document.querySelector("#mensagem");
const xhr = new XMLHttpRequest();
const tableUsuario = document.querySelector("#usuario");
const urlUsuario = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.usuario.php?id_usuario=0";


function listaUsuario() {
    fetch(urlUsuario)
        .then(function (resp) {
            if (!resp.ok)
                throw new Error("Erro ao executar requisição: " + resp.status);
            return resp.json();
        })
        .then(function (data) {
            console.log(data);
            data.forEach((val) => {
                let row = document.createElement("tr");
                row.innerHTML = `<tr><td><center><h3>${val.id_usuario}</h3></center></td></tr>`;
                row.innerHTML += `<tr><td><center><h3>${val.login}</h3></center></td></tr>`;
                row.innerHTML += `<tr><td><center><h3>${val.senha}</h3></center></td></tr>`;
                row.innerHTML += `<tr><td><center><h3>${val.tipo}</h3></center></td></tr>`;
                row.innerHTML += `<td style="padding:3px"><button onclick='editUsuario(this)'>Edit</button><button onclick='delUsuario(this)'>Del</button></td></tr>`;
                tableUsuario.appendChild(row);
            });
        }) 
        .catch(function (error) {
            console.error(error.message);
        });
}

function criaUsuario(){
    let url = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.usuario.php"
    let login = document.querySelector("#login");
    let senha = document.querySelector("#senha");
    let tipo = document.querySelector("#tipo");
    if (login.value != "" && senha.value != "" && tipo.value !=""){
        let dados = new FormData();
        dados.append("login", login.value);
        dados.append("senha", senha.value);
        dados.append("tipo", tipo.value);
        dados.append("verbo", "POST");
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                    msg.innerHTML = resp.erro;
                } else {
                    msg.innerHTML = "Usuário Cadastrado com sucesso";
                }
                setTimeout(() => { window.location.reload(); }, 1000);
            }
        });
        xhr.open("POST", url);
        xhr.send(dados);
    } else {
        msg.innerHTML = "Favor preencher os campos.";
        setTimeout(() => { msg.innerHTML = "Mensagens do sistema"; }, 1000);
    }
}


function editUsuario(p) {
    p.parentNode.parentNode.cells[1].setAttribute("contentEditable", "true");
    p.parentNode.parentNode.cells[2].setAttribute("contentEditable", "true");
    p.parentNode.parentNode.cells[3].setAttribute("contentEditable", "true");
   p.parentNode.parentNode.cells[4].innerHTML = "<button onclick='putUsuario(this)'>Enviar</button>";
}


function putUsuario(p) {
    let url = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.usuario.php";
    let id_usuario = p.parentNode.parentNode.cells[0].innerHTML;
    let login = p.parentNode.parentNode.cells[1].innerHTML;
    let senha = p.parentNode.parentNode.cells[2].innerHTML;
    let tipo = p.parentNode.parentNode.cells[3].innerHTML;
 
    let dados = new FormData();
    dados.append("id_usuario", id_usuario);
    dados.append("login", login);
    dados.append("senha", senha);
    dados.append("tipo", tipo);
    dados.append("verbo","PUT");

    if (window.confirm("Confirma Alteração dos dados?")) {
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                    msg.innerHTML = resp.erro;
                } else {
                    msg.innerHTML = "Configurações do usuário alterado.";
                }
                setTimeout(() => { window.location.reload(); }, 1000);
            }
        });
        xhr.open("POST", url);
        xhr.send(dados);
    }
}


function delUsuario(p) {
    let url = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.usuario.php"; 
    let id_usuario = p.parentNode.parentNode.cells[0].innerText;
    let dados = new FormData();
    dados.append("id_usuario", id_usuario);
    dados.append("verbo","DELETE");

    if (window.confirm("Confirma Exclusão do id " + id_usuario + "?")) {
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                    msg.innerHTML = resp.erro;
                } else {
                    msg.innerHTML = "Produto excluido com sucesso.";
                }
                setTimeout(() => { window.location.reload(); }, 1000);
            }
        });
        xhr.open("POST", url);
        xhr.send(dados);
    }
}