const cpfInput = document.getElementById("cpf");

cpfInput.addEventListener("input", () => {
    let value = cpfInput.value;

    // Remove tudo que não for número
    value = value.replace(/\D/g, "");

    // Adiciona os pontos e traço
    value = value.replace(/^(\d{3})(\d)/, "$1.$2"); // Primeiro ponto
    value = value.replace(/^(\d{3}\.\d{3})(\d)/, "$1.$2"); // Segundo ponto
    value = value.replace(/^(\d{3}\.\d{3}\.\d{3})(\d)/, "$1-$2"); // Traço

    // Atualiza o valor no campo
    cpfInput.value = value;
});