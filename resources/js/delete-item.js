import $ from "jquery";
import "select2/dist/css/select2.min.css";
import Swal from "sweetalert2";

import("select2").then((m) => m.default());

window.deleteItem = (endpoint, album = false, albumId) => {
    let html = "You won't be able to revert this!";

    if (album) {
        const crsf = $("meta[name=csrf-token]").attr("content");
        const csrfInput = $(`<input name='_token' value='${crsf}' hidden>`);
        let select2;

        const form = $("<form id='albumForm'></form>")
            .attr("method", "POST")
            .attr("action", route("albums.transfer", albumId))
            .append(csrfInput);

        const select = $(
            "<select id='albumSearch' class='z-50 my-4' required></select>"
        );

        select.append($("<option value=''>Please select</option>"));

        const text = $(
            "<span style='padding-bottom: 1rem'>Transfer pictures to another album</span>"
        );

        form.append(select);
        form.prepend(text);

        Swal.fire({
            title: "Are you sure?",
            html: form,
            icon: "warning",
            showCancelButton: true,
            showDenyButton: true,
            denyButtonColor: "#3085d6",
            confirmButtonColor: "#d33",
            cancelButtonColor: "gray",
            confirmButtonText: "Yes, delete it!",
            denyButtonText: "No, Transefer",
            scrollbarPadding: false,
            preDeny: () => {
                const value = select2.find(":selected").val();

                if (value === "") {
                    Swal.showValidationMessage(
                        "You should choose an album to transfer to first"
                    );

                    return false;
                }

                form.append(`<input name='album_id' value='${value}'></input>`);

                $("body").append(form);

                form.trigger("submit");
            },
            customClass: {
                htmlContainer: "sweetalert2-delete-html-container",
            },
            didOpen: function () {
                select2 = $("#albumSearch").select2({
                    ajax: {
                        url: route("albums.search"),
                    },
                    width: "100%",
                    dropdownParent: $(Swal.getContainer()),
                });
            },
        }).then((result) => {
            if (result.isConfirmed) {
                const crsf = $("meta[name=csrf-token]").attr("content");
                const methodInput = $("<input name='_method' value='DELETE'>");
                const csrfInput = $(`<input name='_token' value='${crsf}'>`);

                const form = $("<form>")
                    .addClass("hidden")
                    .attr("method", "POST")
                    .attr("action", endpoint)
                    .append(methodInput)
                    .append(csrfInput);

                $("body").append(form);
                form.trigger("submit");
            }
        });
    }
};
