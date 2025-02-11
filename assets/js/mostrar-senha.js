// Seleciona o elemento de input de senha
const senhaInputLogin = document.querySelector('#mostrar-senha-input-login');
const senhaInputCadastro = document.querySelector('#mostrar-senha-input-cadastro');
const confirmasenhaInputCadastro = document.querySelector('#mostrar-confirmasenha-input-cadastro');

// Seleciona o checkbox para mostrar a senha
const mostrarSenhaCheckboxLogin = document.querySelector('#mostrar-senha-checkbox-login');
const mostrarSenhaCheckboxCadastro = document.querySelector('#mostrar-senha-checkbox-cadastro');


// Adiciona um evento de clique ao checkbox
mostrarSenhaCheckboxLogin.addEventListener('click', function () {
    if (mostrarSenhaCheckboxLogin.checked) {
        senhaInputLogin.type = 'text';
    } else {
        senhaInputLogin.type = 'password';
    }
});

mostrarSenhaCheckboxCadastro.addEventListener('click', function () {
    if (mostrarSenhaCheckboxCadastro.checked) {
        senhaInputCadastro.type = 'text';
        confirmasenhaInputCadastro.type = 'text';
    } else {
        senhaInputCadastro.type = 'password';
        confirmasenhaInputCadastro.type = 'password';
    }
});