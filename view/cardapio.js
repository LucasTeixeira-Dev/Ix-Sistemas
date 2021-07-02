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
                row.innerHTML += `<td style="padding:3px"><button onclick='editProduto(this)'>Edit</button><button onclick='delProduto(this)'>Del</button></td></tr>`;
                tableProduto.appendChild(row);
            });
        }) 
        .catch(function (error) {
            console.error(error.message);
        });
}

function criaProduto(){
    let url = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.produto.php"
    let nome = document.querySelector("#nome");
    let descricao = document.querySelector("#descricao");
    let valor = document.querySelector("#valor");
    let tipos = document.querySelector("#tipos");
    if (nome.value != "" && descricao.value != "" && valor.value !="" && tipos.value !=""){
        let dados = new FormData();
        dados.append("nome", nome.value);
        dados.append("descricao", descricao.value);
        dados.append("valor", valor.value);
        dados.append("tipos", tipos.value);
        dados.append("verbo", "POST");
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                    msg.innerHTML = resp.erro;
                } else {
                    msg.innerHTML = "Produto Cadastrado com sucesso";
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


function editProduto(p) {
    p.parentNode.parentNode.cells[1].setAttribute("contentEditable", "true");
    p.parentNode.parentNode.cells[2].setAttribute("contentEditable", "true");
    p.parentNode.parentNode.cells[3].setAttribute("contentEditable", "true");
    p.parentNode.parentNode.cells[4].setAttribute("contentEditable", "true");
    p.parentNode.parentNode.cells[5].innerHTML = "<button onclick='putProduto(this)'>Enviar</button>";
}


function putProduto(p) {
    let url = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.produto.php";
    let id_produto = p.parentNode.parentNode.cells[0].innerHTML;
    let nome = p.parentNode.parentNode.cells[1].innerHTML;
    let descricao = p.parentNode.parentNode.cells[2].innerHTML;
    let valor = p.parentNode.parentNode.cells[3].innerHTML;
    let tipos = p.parentNode.parentNode.cells[4].innerHTML;
    
    let dados = new FormData();
    dados.append("id_produto", id_produto);
    dados.append("nome", nome);
    dados.append("descricao", descricao);
    dados.append("valor", valor);
    dados.append("tipos", tipos);
    dados.append("verbo","PUT") ;

    if (window.confirm("Confirma Alteração dos dados?")) {
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                    msg.innerHTML = resp.erro;
                } else {
                    msg.innerHTML = "Configurações do produto alterado.";
                }
                setTimeout(() => { window.location.reload(); }, 1000);
            }
        });
        xhr.open("POST", url);
        xhr.send(dados);
    }
}

                                
function delProduto(p) {
    let url = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.produto.php"; 
    let id_produto = p.parentNode.parentNode.cells[0].innerText;
    let dados = new FormData();
    dados.append("id_produto", id_produto);
    dados.append("verbo","DELETE");

    if (window.confirm("Confirma Exclusão do id " + id_produto + "?")) {
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