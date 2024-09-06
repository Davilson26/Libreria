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
    fetch('../../controllers/miembrosController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(user)
    }).then(response => response.json()).then(data => {
        console.log(data);
        loadUsers();
		document.getElementById('userName').value = '';
		document.getElementById('telefono').value = '';
		document.getElementById('userEmail').value = '';
    });
}

function updateUser(id, user) {
    fetch(`../../controllers/miembrosController.php?id=${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(user)
    }).then(response => response.json()).then(data => {
        console.log(data);
        loadUsers();
		document.getElementById('userId').value = '';
		document.getElementById('userName').value = '';
		document.getElementById('telefono').value = '';
		document.getElementById('userEmail').value = '';
    });
}

function deleteUser(id) {
    fetch(`../../controllers/miembrosController.php?id=${id}`, {
        method: 'DELETE'
    }).then(response => response.json()).then(data => {
        console.log(data);
        loadUsers();
    });
}

function loadUsers() {
    fetch('../../controllers/miembrosController.php')
        .then(response => response.json())
        .then(users => {
            const userList = document.getElementById('userList');
            userList.innerHTML = '';
            users.forEach(user => {
                const li = document.createElement('li');
                li.textContent = `${user.name} / ${user.email}`;
                li.className = 'list-group-item';
                li.appendChild(createEditButton(user));
                li.appendChild(createDeleteButton(user.id));
                userList.appendChild(li);
            });
        });
}

function createDeleteButton(id) {
    const button = document.createElement('button');
    button.textContent = 'Eliminar';
    button.className = 'btn btn-sm btn-danger '
    button.onclick = () => deleteUser(id);
    return button;
}

function createEditButton(user) {
    const button = document.createElement('button');
    button.textContent = 'Editar';
    button.className = 'btn btn-sm btn-outline-success mx-2'
    button.onclick = () => {
        document.getElementById('userId').value = user.id;
        document.getElementById('userName').value = user.name;
        document.getElementById('telefono').value = user.telefono;
        document.getElementById('userEmail').value = user.email;
    };
    return button;
}

// Cargar usuarios al inicio
loadUsers();