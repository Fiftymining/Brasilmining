// ===== Cadastro =====
function cadastrar() {
    const usuario = document.getElementById('cadastro-usuario').value;
    const senha = document.getElementById('cadastro-senha').value;

    if (!usuario || !senha) {
        alert('Preencha todos os campos!');
        return;
    }

    fetch('http://localhost:3000/api/register', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username: usuario, password: senha })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
    })
    .catch(() => alert('Erro na conexão com o servidor.'));
}

// ===== Login =====
function login() {
    const usuario = document.getElementById('login-usuario').value;
    const senha = document.getElementById('login-senha').value;

    if (!usuario || !senha) {
        alert('Preencha todos os campos!');
        return;
    }

    fetch('http://localhost:3000/api/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username: usuario, password: senha })
    })
    .then(res => {
        if (res.status === 200) {
            localStorage.setItem('usuarioLogado', usuario);
            window.location.href = 'dashboard.html';
        } else {
            alert('Usuário ou senha incorretos!');
        }
    })
    .catch(() => alert('Erro na conexão com o servidor.'));
}

// ===== Calculadora =====
function calcularLucro() {
    const investimento = parseFloat(document.getElementById('investimento').value);
    const dias = parseInt(document.getElementById('dias').value);
    const
