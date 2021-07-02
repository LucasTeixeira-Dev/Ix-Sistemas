const login = document.getElementById("login");
const senha = document.getElementById("senha");
const msg = document.getElementById("mensagem");

function acessar() {
    let xhr = new XMLHttpRequest();
    let url = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.usuario.php";
    let dados = new FormData();
    if (login.value != "" && senha.value != "") {
        dados.append("login", login.value);
        dados.append("senha", senha.value);
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                let destino = "";
                if (resp.length === 0) {
                    msg.innerHTML = "Login ou senha inválido";
                } else {
                    if (resp[0].tipo === "Gerente") {
                        destino += "../index-ge.html";
                    } else if (resp[0].tipo === "Chapeiro") {
                        destino += "../indexfun.html";
                    } else if (resp[0].tipo === "Garçom") {
                        destino += "../indexfun.html"; 
                    }else {
                        destino += "./login.html";
                    }
                    localStorage.setItem('tipo', resp[0].tipo);
                    localStorage.setItem('id_usuario', resp[0].id_usuario);
                    window.location.href = destino + "?id_usuario=" + resp[0].id_usuario + "login=" + resp[0].login;
                }
            }
        });
        xhr.open("POST", url);
        xhr.send(dados);
    } else {
        msg.innerHTML = "Favor preencher o email e a senha";
    }
    setTimeout(() => { msg.innerHTML = "Mensagens do sistema"; }, 3000);
}
/*const login = document.querySelector("#login");
const senha = document.querySelector("#senha");
const msg = document.querySelector("#mensagem");

function acessar() {
    let xhr = new XMLHttpRequest();
   
    let url = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.usuario.php";
    let dados = new FormData();
    if (login.value != "" && senha.value != "") {
        dados.append("login", login.value);
        dados.append("senha", senha.value);
        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === this.DONE) {
                let resp = JSON.parse(this.responseText);
                if (resp.hasOwnProperty("erro")) {
                    msg.innerHTML = resp.erro;
                } else {
                    let destino = "";
                    if (resp.tipo[""] === "Gerente") {
                        destino += "../index-ge.html";
                    } else {
                        destino += "./login.html";
                    }
					window.localStorage.setItem("login",resp.login);
					window.localStorage.setItem("id", resp.id_usuario);
                    window.location.href = destino;
                }
            }
        });
        xhr.open("POST", url);
        xhr.send(dados);
    } else {
        msg.innerHTML = "Favor preencher o login e a senha";
    }
    setTimeout(() => { msg.innerHTML = "Mensagens do sistema"; }, 3000);
}*/