import Alpine from "alpinejs";
import $ from "jquery";
import jQuery from "jquery";
import Swal from "sweetalert2";

window.Alpine = Alpine;
window.$ = $;
window.JQuery = jQuery;
window.Swal = Swal;

import "./bootstrap";
import "./file-picker.js";
import "./delete-item.js";

window.Toast = Swal.mixin({
    toast: true,
    position: "bottom-end",
    iconColor: "white",
    customClass: {
        popup: "colored-toast",
        container: "swal2-toast-container",
    },
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
});

Alpine.start();
