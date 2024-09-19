
function insertar(){
    datos = {
        fecha_compra : document.getElementById('fecha_compra').value,
        no_serie : document.getElementById('no_serie').value,
        nombre : document.getElementById('nombre').value,
        modelo : document.getElementById('modelo').value,
        precio : document.getElementById('precio').value
        
    }
    
    fetch('insertar.php',{
        headers:{'Content-Type' : 'application/json'},
        method: 'POST',
        body: JSON.stringify(datos)
    }).then(()=>{console.log('datos enviados');
        mostrar();
    })
    .catch(error => {
        console.log(error)
        
    });
    
    document.getElementById('fecha_compra').value="";
    document.getElementById('no_serie').value="";
    document.getElementById('nombre').value="";
    document.getElementById('modelo').value="";
    document.getElementById('precio').value="";
}
function mostrar(){
    
    fetch('mostrar.php').
    then(response => response.json())
    .then(data => {
        let tablaHTML = "<table><tr><th>Fecha de compra</th><th>No. Serie</th><th>Nombre</th><th>Modelo</th><th>Precio</th></tr>";

        data.forEach(registro => {
            tablaHTML+= `<tr>
                            <td>${registro.fecha_compra}</td>
                            <td>${registro.no_serie}</td>
                            <td>${registro.nombre}</td>
                            <td>${registro.modelo}</td>
                            <td>${registro.precio}</td>
                          </tr>`;
        });
        tablaHTML+="</table>"
        document.getElementById('tabla').innerHTML = tablaHTML;

        let combobox = document.getElementById('combobox');
            combobox.innerHTML = '';  // Limpiar el contenido anterior

            data.forEach(registro => {
                let option = document.createElement('option');
                option.value = registro.no_serie;
                option.text = registro.no_serie;
                combobox.appendChild(option);
            });
    });
    
   
}

function borrar(){
    fetch('borrar.php',{
        
    }).then(()=>{
        console.log("Eliminados")
    }).catch(error=>{
        console.log(error);
    });
}
function borrarSeleccion(){
    fetch('borrarSeleccion.php',{
        headers:{'Content-Type' : 'application/json'},
        method: 'POST',
        body: JSON.stringify({no_serie:document.getElementById('combobox').value})
    })
    .then(()=>{
        console.log("seleccion eliminada");
        mostrar();
    })
    
    .catch(error =>{console.log(error)});
}