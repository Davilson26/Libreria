document.getElementById('libroForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('id').value;
    const titulo = document.getElementById('titulo').value;
    const autor = document.getElementById('autor').value;
    const disponibilidad = document.getElementById('disponibilidad').value;
    const categoria_id = document.getElementById('categoria_id').value;    
    if (id) {
        updateLibro(id, { titulo, autor, disponibilidad, categoria_id});
    } else {
        createLibro({ titulo, autor, disponibilidad, categoria_id });
    }
});

function createLibro(formData) {
    fetch('../../controllers/LibrosController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    }).then(response => response.json()).then(data => {
        console.log(data);
        loadLibro();
    });
}

function updateLibro(id, formData) {
    fetch(`../../controllers/LibrosController.php?id=${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    }).then(response => response.json()).then(data => {
        console.log(data);
        loadLibro();
		document.getElementById('id').value = '';
    });
}

function deleteLibro(id) {
    fetch(`../../controllers/LibrosController.php?id=${id}`, {
        method: 'DELETE'
    }).then(response => response.json()).then(data => {
        console.log(data);
        loadLibro();
    });
}

function loadLibro() {
    fetch('../../controllers/LibrosController.php')
        .then(response => response.json())
        .then(libros => {
            const libroList = document.getElementById('librosList');
            libroList.innerHTML = '';
            libros.forEach(libro => {
                console.log(libro);
                
                const li = document.createElement('li');
                li.textContent = `${libro.titulo} - ${libro.autor}/(${libro.nombre}): ${libro.disponibilidad==1?'disponible':'agotado'}`;
                li.className = 'list-group-item';
                li.appendChild(createEditButton(libro));
                li.appendChild(createDeleteButton(libro.id,));
                libroList.appendChild(li);
            });
        });
}

function createDeleteButton(id) {
    const button = document.createElement('button');
    button.textContent = 'Eliminar';
    button.className = 'btn btn-sm btn-danger '
    button.onclick = () => deleteLibro(id);
    return button;
}

function createEditButton(libro) {
    const button = document.createElement('button');
    button.textContent = 'Editar';
    button.className = 'btn btn-sm btn-outline-success mx-2'
    button.onclick = () => {
        document.getElementById('id').value = libro.id;
        document.getElementById('titulo').value = libro.titulo;
        document.getElementById('autor').value = libro.autor;
        document.getElementById('disponibilidad').value = libro.disponibilidad;
        document.getElementById('categoria_id').value = libro.categoria_id;
    };
    return button;
}

// Cargar usuarios al inicio
loadLibro();