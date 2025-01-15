const cepInput = document.getElementById("cep");

cepInput.addEventListener("input", () => {
  let value = cepInput.value;

  // Remove tudo que não for número
  value = value.replace(/\D/g, "");

  // Adiciona o traço no formato #####-###
  value = value.replace(/^(\d{5})(\d)/, "$1-$2");

  // Atualiza o valor no campo
  cepInput.value = value;
});