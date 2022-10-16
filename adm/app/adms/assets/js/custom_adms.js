// Receber o formulario login
const formLogin = document.getElementById("form-login");

// Verificar se existe o formulario login
if (formLogin) {
    // Aguardar o evento submit, aguardar o usuario clicar no botao acessar do formulario de login
    formLogin.addEventListener("submit", async(e) => {
        // Receber o valor do campo
        var username = document.querySelector("#username").value;

        // Verificar se o campo esta vazio
        if (username === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo usuário!</p>";
            return;
        }

        // Receber o valor do campo
        var password = document.querySelector("#password").value;

        // Verificar se o campo esta vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo senha!</p>";
            return;
        }
    });
}