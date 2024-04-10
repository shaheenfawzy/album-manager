import $ from "jquery";

const showSelectedImage = (filePicker, imgElement) => {
    let reader = new FileReader();
    const file = filePicker[0].files[0];

    reader.onload = function (e) {
        imgElement.attr("src", e.target.result);
    };

    if (file) {
        reader.readAsDataURL(file);
    }
};

$(".file-picker-container").each(function (index, filePickerContainer) {
    filePickerContainer = $(filePickerContainer);

    const fileItemsContainer = filePickerContainer.find(
        ".file-items-container"
    );
    const form = filePickerContainer.closest("form");
    const fileName = filePickerContainer.data("file-name");
    const filePicker = filePickerContainer.find("input.file-picker");
    const successCallback = filePickerContainer.data("success-callback");
    const fileItemPrefix = filePickerContainer.data("file-item-prefix");
    const fileItemElement = filePickerContainer.find(".file-item");
    const fileItemHtml = fileItemElement.clone().removeClass("hidden");
    const filesList = [];

    fileItemElement.remove();

    filePicker.on("change", function () {
        const fileItem = fileItemHtml.clone();
        const imgElement = fileItem.find("img");
        const itemsCount = fileItemsContainer.children().length;
        const inputs = fileItem.find("input");

        inputs.each(function (index, input) {
            const name = $(input).attr("name");

            $(input).attr("name", `${fileItemPrefix}[${itemsCount}][${name}]`);
            $(input).prop("required", true);
        });

        filesList.push(filePicker[0].files[0]);

        fileItemsContainer.append(fileItem);

        fileItem.find(".remove-file-item").on("click", function () {
            fileItem.remove();

            if (fileItemsContainer.children().length === 0) {
                fileItemsContainer.removeClass("border-2");
                fileItemsContainer.addClass("border-0");
            }
        });

        fileItemsContainer.addClass("border-2");
        showSelectedImage(filePicker, imgElement);
        filePicker.val("");
    });

    form.on("submit", function (e) {
        e.preventDefault();
        const formData = new FormData();

        const collectInputsIntoFormData = (inputs) => {
            inputs.each(function (index, input) {
                input = $(input);

                formData.append(input.attr("name"), input.val());
            });
        };

        const fileItemsInputs = fileItemsContainer.find("input");
        const formInputs = form.find("input").not(fileItemsInputs);
        console.log(formInputs);

        collectInputsIntoFormData(formInputs);

        fileItemsContainer.children().each(function (fileItemIndex, fileItem) {
            const fileItemInputs = $(fileItem).find("input");

            collectInputsIntoFormData(fileItemInputs);

            formData.append(
                `${fileItemPrefix}[${fileItemIndex}][${fileName}]`,
                filesList[fileItemIndex]
            );
        });

        $.ajax({
            headers: { accept: "application/json" },
            type: "POST",
            url: form.attr("action"),
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.success) {
                    Toast.fire({
                        icon: "success",
                        title: data.message,
                    });

                    $(fileItemsContainer).html("");
                    window[successCallback](data);
                }
            },
            error: function (data) {
                Swal.fire({
                    icon: "error",
                    title: "Some error happened during validation",
                });
            },
        });
    });
});
