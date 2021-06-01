const login = document.querySelector("#login");
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
                    if (resp.tipo[0] === "Gerente") {
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
}