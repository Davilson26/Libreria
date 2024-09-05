document.getElementById('userForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('userId').value;
    const name = document.getElementById('userName').value;
    const telefono = document.getElementById('telefono').value;
    const email = document.getElementById('userEmail').value;

    if (id) {
        updateUser(id, { name, telefono, email });
    } else {
        createUser({ name, telefono, email });
    }
});

function createUser(user) {
    fetch('../api/miembrosController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(user)
    }).then(response => response.json()).then(data => {
        console.log(data);
        loadUsers();
    });
}

function updateUser(id, user) {
    fetch(`../api/miembrosController.php?id=${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(user)
    }).then(response => response.json()).then(data => {
        console.log(data);
        loadUsers();
		document.getElementById('userId').value = '';
    });
}

function deleteUser(id) {
    fetch(`../api/miembrosController.php?id=${id}`, {
        method: 'DELETE'
    }).then(response => response.json()).then(data => {
        console.log(data);
        loadUsers();
    });
}

function loadUsers() {
    fetch('../api/miembrosController.php')
        .then(response => response.json())
        .then(users => {
            const userList = document.getElementById('userList');
            userList.innerHTML = '';
            users.forEach(user => {
                const li = document.createElement('li');
                li.textContent = `${user.name} (${user.email})`;
                li.appendChild(createDeleteButton(user.id));
                li.appendChild(createEditButton(user));
                userList.appendChild(li);
            });
        });
}

function createDeleteButton(id) {
    const button = document.createElement('button');
    button.textContent = 'Eliminar';
    button.onclick = () => deleteUser(id);
    return button;
}

function createEditButton(user) {
    const button = document.createElement('button');
    button.textContent = 'Editar';
    button.onclick = () => {
        document.getElementById('userId').value = user.id;
        document.getElementById('userName').value = user.name;
        document.getElementById('userEmail').value = user.email;
    };
    return button;
}

// Cargar usuarios al inicio
loadUsers();