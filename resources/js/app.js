require('./bootstrap');

// Importar jQuery
import $ from 'jquery';
window.$ = window.jQuery = $;

// Importar Select2
import 'select2';

// Inicializar Select2
$(document).ready(function() {
    $('#animal_id').select2({
        placeholder: "Seleccione una mascota",
        allowClear: true,
        width: '100%' // Ajusta el ancho al contenedor del form
    });
});
