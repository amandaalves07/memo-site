function validaFormCad() {
  //usada no register.html
  //função para validar dados digitados pelo usuário
  var enviar = true;
  if (
    document.form1.name.value == "" ||
    document.form1.birthDate.value == "" ||
    document.form1.phone.value == "" ||
    document.form1.email.value == "" ||
    document.form1.password.value == ""
  )
    enviar = false;
  return enviar;
}

function formatarTel(input) {
  //usada no register.html
  //coloca mascara no telefone digitado
  let valor = input.value.replace(/\D/g, "");
  valor = valor.replace(/(\d{2})(\d{4,5})(\d{4})/, "($1) $2-$3");
  input.value = valor;
}

function validarSenha(input) {
  //usada no register.html
  //função para verificar formatação da senha informada no cadastro
  var enviar = true;
  var senha = input.value;

  if (senha.length < 8) {
    document.getElementById("password-length").style.color = "red";
    document.getElementById("password-length").style.fontWeight = "normal";
    enviar = false;
  } else {
    document.getElementById("password-length").style.color = "green";
    document.getElementById("password-length").style.fontWeight = "bold";
  }

  var maiuscCont = (senha.match(/[A-Z]/g) || []).length;
  var minuscCont = (senha.match(/[a-z]/g) || []).length;
  var sinaisCont = (senha.match(/[!@#$%^&*(),.?":{}|<>]/g) || []).length;
  var numCont = (senha.match(/[0-9]/g) || []).length;

  if (maiuscCont < 1) {
    document.getElementById("password-uppercase").style.color = "red";
    document.getElementById("password-uppercase").style.fontWeight = "normal";
    enviar = false;
  } else {
    document.getElementById("password-uppercase").style.color = "green";
    document.getElementById("password-uppercase").style.fontWeight = "bold";
  }
  if (minuscCont < 1) {
    document.getElementById("password-lowercase").style.color = "red";
    document.getElementById("password-lowercase").style.fontWeight = "normal";
    enviar = false;
  } else {
    document.getElementById("password-lowercase").style.color = "green";
    document.getElementById("password-lowercase").style.fontWeight = "bold";
  }
  if (sinaisCont < 1) {
    document.getElementById("password-symbol").style.color = "red";
    document.getElementById("password-symbol").style.fontWeight = "normal";
    enviar = false;
  } else {
    document.getElementById("password-symbol").style.color = "green";
    document.getElementById("password-symbol").style.fontWeight = "bold";
  }
  if (numCont < 1) {
    document.getElementById("password-number").style.color = "red";
    document.getElementById("password-number").style.fontWeight = "normal";
    enviar = false;
  } else {
    document.getElementById("password-number").style.color = "green";
    document.getElementById("password-number").style.fontWeight = "bold";
  }
  return enviar;
}

function validarEmail(input) {
  const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
  return emailRegex.test(input);
}

function validaFormLogin() {
  //usada no login01.php
  var enviar = true;
  if (document.form1.email.value == "") enviar = false;
  if (document.form1.senha.value == "") enviar = false;
  return enviar;
}

function validaFormMudaSenha() {
  //usada no mudaSenha01.php
  //função para validar form para envio
  var enviar = true;
  var msgErro = ""; //variável para concatenar mensagens de erro

  if (document.form1.oldPassword.value == "") {
    document.getElementById("erroSenhaAnt").innerHTML =
      "Preencha a senha atual!";
    enviar = false;
  } else document.getElementById("erroSenhaAnt").innerHTML = "";

  if (document.form1.newPassword1.value == "") {
    document.getElementById("erroSenhaNova1").innerHTML =
      "Preencha a senha nova!";
    enviar = false;
  } else document.getElementById("erroSenhaNova1").innerHTML = "";

  if (document.form1.newPassword2.value == "") {
    msgErro += "Confirme a senha nova! <br>";
    enviar = false;
  }
  if (document.form1.newPassword1.value != document.form1.newPassword2.value) {
    msgErro += "Senhas não conferem! <br>";
    enviar = false;
  }
  if (
    document.form1.newPassword1 != "" &&
    document.form1.newPassword2 != "" &&
    document.form1.oldPassword.value == document.form1.newPassword1.value
  ) {
    msgErro += "Senha nova não pode ser igual à atual!";
    enviar = false;
  }

  document.getElementById("erroSenhaNova2").innerHTML = msgErro; //mostrando mensagens de erro
  return enviar;
}

function validaFormNovaSenha1() {
  //usada no novaSenha01.php
  var enviar = true;
  var email = document.form1.email.value;
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (email == "") {
    document.getElementById("erroEmail").innerHTML += "Preencha o e-mail!";
    enviar = false;
  } else document.getElementById("erroEmail").innerHTML = "";

  if (validarEmail(email)) {
    //e-mail informado não é válido
    document.getElementById("erroEmail").innerHTML +=
      "Informe um e-mail válido!";
  } else document.getElementById("erroEmail").innerHTML = "";

  return enviar;
}

function validaFormNovaSenha3() {
  //usada no novaSenha03.php
  var enviar = true;
  if (
    document.form1.newPassword1.value == "" ||
    document.form1.newPassword2.value == "" ||
    ((document.form1.newPassword1.value == "") !=
      document.form1.newPassword2.value) ==
      ""
  ) {
    document.getElementById("erroSenhaNova").innerHTML +=
      "Preencha corretamente as senhas!";
    enviar = false;
  } else document.getElementById("erroSenhaNova").innerHTML += "";
  return enviar;
}

function validaFormModUser() {
  //usada no modUser01.php
  var enviar = true;
  if (
    document.form1.userName.value == "" ||
    document.form1.birthDate.value == "" ||
    document.form1.phone.value == "" ||
    document.form1.email.value == ""
  ) {
    enviar = false;
  }
  return enviar;
}

function validaFormArtigo() {
  //usada no addArt01.php
  var enviar = true;
  if (
    document.form1.name.value == "" ||
    document.form1.date.value == "" ||
    document.form1.time.value == ""
  ) {
    enviar = false;
  }
  return enviar;
}

function validaFormTarefa() {
  //usada no addTarefa01.php e no modTarefa01.php
  var enviar = true;
  if (
    document.form1.name.value == "" ||
    document.form1.date.value == "" ||
    document.form1.time.value == ""
  ) {
    enviar = false;
  }
  return enviar;
}

function confirmDelete() {
    if (confirm("Tem certeza que deseja excluir sua conta? Essa ação não poderá ser desfeita.")) {
        window.location.href = "excUser.php";
        return true;
    } else return false;
}

function confirmDeleteTarefa() {
    if (confirm("Tem certeza que deseja excluir essa tarefa? Essa ação não poderá ser desfeita.")) {
        window.location.href = "excTarefa.php";
        return true;
    } else return false;
}

// Funções da Janela Modal de Artigos:
function abrirModal(titulo, autores, resumo, link, imagem, fonte) {
  document.getElementById("modalTitulo").textContent = titulo;
  document.getElementById("modalAutores").textContent = "Autores: " + autores;
  document.getElementById("modalResumo").textContent = resumo;
  const imgModal = document.getElementById("modalImagem");
  imgModal.src = imagem;
  imgModal.alt = titulo;
  const modalLink = document.getElementById("modalLink");
  if (link && link !== "") {
    modalLink.href = link;
    modalLink.style.display = "inline-block";
  } else {
    modalLink.style.display = "none";
  }
  const modalFonte = document.getElementById("modalFonte");
  if (fonte && fonte.trim() !== "") {
    modalFonte.textContent = fonte;
    modalFonte.style.display = "block";
  } else {
    modalFonte.style.display = "none";
  }
  const modal = document.getElementById("modal");
  modal.style.display = "flex";
  document.body.style.overflow = "hidden";
}
// Xzinho de fechar no artigo
function fecharModal() {
  const modal = document.getElementById("modal");
  modal.style.display = "none";
  document.body.style.overflow = "";
}
// Fechar clicando fora
window.onclick = function (event) {
  const modal = document.getElementById("modal");
  if (event.target === modal) {
    fecharModal();
  }
};

// Funções Carrossel de Artigos:
document.addEventListener("DOMContentLoaded", () => {
  const artigosCardsContainer = document.querySelector(".artigos-cards");
  const setaEsquerda = document.querySelector("#setaEsquerda");
  const setaDireita = document.querySelector("#setaDireita");
  const containerBolinhas = document.querySelector("#containerBolinhas");
  if (
    !artigosCardsContainer ||
    !setaEsquerda ||
    !setaDireita ||
    !containerBolinhas
  ) {
    console.warn("Carrossel não inicializado nesta página (faltam elementos).");
    return;
  }

  // Pega os cards
  const allCardsOriginais = Array.from(
    artigosCardsContainer.querySelectorAll(".artigo-card")
  );
  const allCards = allCardsOriginais.map((card) => card.cloneNode(true));
  const cardsPorGrupo = 3;
  const totalGrupos = Math.ceil(allCards.length / cardsPorGrupo);
  let grupoAtual = 0;

  // Função pra criar as bolinhas
  function criarBolinhas() {
    containerBolinhas.innerHTML = "";
    for (let i = 0; i < totalGrupos; i++) {
      const bolinha = document.createElement("div");
      bolinha.classList.add("bolinha");
      if (i === grupoAtual) bolinha.classList.add("active");
      bolinha.addEventListener("click", () => {
        if (grupoAtual !== i) {
          mudarGrupo(i);
        }
      });
      containerBolinhas.appendChild(bolinha);
    }
  }

  //Função pra mudar o grupo(trio) de cards com animação
  function mudarGrupo(novoGrupo) {
    artigosCardsContainer.classList.add("fade-out");
    setTimeout(() => {
      artigosCardsContainer.innerHTML = "";
      const start = novoGrupo * cardsPorGrupo;
      const end = start + cardsPorGrupo;
      const cardsMostrar = allCards.slice(start, end);
      cardsMostrar.forEach((card) => {
        artigosCardsContainer.appendChild(card);
      });
      grupoAtual = novoGrupo;
      atualizarBolinhas();
      artigosCardsContainer.classList.remove("fade-out");
      artigosCardsContainer.classList.add("fade-in");
      artigosCardsContainer.classList.add("carrossel-pronto"); // mostra container após renderizar cards
      setTimeout(() => {
        artigosCardsContainer.classList.remove("fade-in");
      }, 300);
    }, 300);
  }

  //Função pra atualizar as bolinhas de progresso
  function atualizarBolinhas() {
    const bolinhas = containerBolinhas.querySelectorAll(".bolinha");
    bolinhas.forEach((bolinha, i) => {
      bolinha.classList.toggle("active", i === grupoAtual);
    });
  }

  //Setas de navegação dos artigos
  setaEsquerda.addEventListener("click", () => {
    const proximoGrupo = (grupoAtual - 1 + totalGrupos) % totalGrupos;
    mudarGrupo(proximoGrupo);
  });

  setaDireita.addEventListener("click", () => {
    const proximoGrupo = (grupoAtual + 1) % totalGrupos;
    mudarGrupo(proximoGrupo);
  });

  //Carrossel
  function iniciarCarrossel() {
    mudarGrupo(0);
    criarBolinhas();
  }

  iniciarCarrossel();
});