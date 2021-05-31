const login = document.getElementById("login");  
const senha = document.getElementById("senha")
const msg = document.querySelector("mensagem");



function Logar() {   
    let xhr = new XMLHttpRequest();
    let url = "http://ix-sistemas.000webhostapp.com/src/controll/routes/route.usuario.php";
    let dados = new FormData();
    if  (login.value != "" && senha.value != "") {
        dados.append("login", login.value);
        dados.append("senha", senha.value);
        xhr.addEventListener("readystatechange", function () {
            if(this.readyState === this.DONE){
                let resp = JSON.parse(this.responseText);
                let destino = "";
                if(resp.length === 0){
                msg.innerHTML = "Login ou Senha Inválido ";
            }else{
                if(resp[0].tipo === ""){
                   destino += "index.html";
                }else{
                    destino = "home.html";
                }
                localStorage.setItem('id_usuario', resp[0].id);
                window.location.href = destino + "?id_usuario=" + resp[0].id_usuario + "&login=" + resp[0].login;
                }

            }
        });
        xhr.open("POST",url);
        xhr.send(dados);
    } else {
        msg.innerHTML = "Insira Login e Senha";
    }
    setTimeout(() => { msg.innerHTML = "Mensagens do Sistema"; }, 3000);
}