let listElements = document.querySelectorAll('.list__button--click');

listElements.forEach(listElement => {
    listElement.addEventListener('click', () => {

        listElement.classList.toggle('arrow');

        let height = 0;
        let menu = listElement.nextElementSibling;
        if (menu.clientHeight == "0") {
            height = menu.scrollHeight;
        }

        menu.style.height = `${height}px`;

    })
});

$(document).ready(function () {
    $('.nav__link').on('click', function (e) {
        e.preventDefault();
        var url = $(this).attr('href'); // Obtener el URL del enlace

        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                $('#content-area').html(response); // Reemplazar el contenido
            },
            error: function (xhr) {
                console.error("Error al cargar la página.");
            }
        });
    });
});

let productoIndex = 1;

    function agregarProducto() {
        const table = document.getElementById('productos_table');
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>
                <select name="productos[${productoIndex}][producto]" class="form-control" onchange="actualizarPrecio(this, ${productoIndex})" required>
                    <option value="">Seleccione un producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}" data-precio="{{ $producto->precio_venta }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
            </td>
            <td><input class="form-control ms-2" type="number" name="productos[${productoIndex}][cantidad]" oninput="calcularTotal()" required></td>
            <td><input class="form-control" type="number" name="productos[${productoIndex}][precio_unitario]" step="0.01" required readonly></td>
            <td><input class="form-control" type="number" name="productos[${productoIndex}][descuento]" step="0.01" oninput="calcularTotal()" required></td>
            <td><button type="button" onclick="eliminarProducto(this)" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></td>
            <td><button type="button" onclick="agregarProducto()" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></td>
        `;

        table.appendChild(row);
        productoIndex++;
    }

    function eliminarProducto(button) {
        button.parentElement.parentElement.remove();
        calcularTotal();
    }

    function actualizarPrecio(selectElement, index) {
        const precioVenta = selectElement.options[selectElement.selectedIndex].getAttribute('data-precio');
        const precioInput = document.querySelector(`input[name="productos[${index}][precio_unitario]"]`);
        precioInput.value = precioVenta;
        calcularTotal();
    }

    function calcularTotal() {
        let cantidadItems = 0;
        let precioNeto = 0;
        let totalDescuento = 0; // Variable para almacenar el descuento total
    
        document.querySelectorAll('#productos_table tr').forEach((row, index) => {
            if (index === 0) return; // Saltar encabezado
    
            const cantidad = parseFloat(row.querySelector(`input[name="productos[${index - 1}][cantidad]"]`)?.value) || 0;
            const precioUnitario = parseFloat(row.querySelector(`input[name="productos[${index - 1}][precio_unitario]"]`)?.value) || 0;
            const descuento = parseFloat(row.querySelector(`input[name="productos[${index - 1}][descuento]"]`)?.value) || 0;
    
            // Calcular el precio neto por producto
            const precioConDescuento = cantidad * precioUnitario * (1 - (descuento / 100));
            
            // Aumentar cantidad total y precio neto
            cantidadItems += cantidad;
            precioNeto += precioConDescuento;
            
            // Calcular el descuento total
            totalDescuento += cantidad * precioUnitario * (descuento / 100);
        });
    
        const iva = precioNeto * 0.19;
        const precioTotal = precioNeto + iva;
    
        // Actualizar los valores en la vista
        document.getElementById('cantidad_items').innerText = cantidadItems.toLocaleString('es-ES');
        document.getElementById('precio_neto').innerText = precioNeto.toLocaleString('es-ES', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        document.getElementById('iva').innerText = iva.toLocaleString('es-ES', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        document.getElementById('descuento').innerText = totalDescuento.toLocaleString('es-ES', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        document.getElementById('precio_total').innerText = precioTotal.toLocaleString('es-ES', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    
        // Actualizar los campos ocultos
        document.getElementById('input_precio_neto').value = precioNeto.toFixed(2);
        document.getElementById('input_iva').value = iva.toFixed(2);
        document.getElementById('input_descuento').value = totalDescuento.toFixed(2);
        document.getElementById('input_precio_total').value = precioTotal.toFixed(2);
    }
    
    