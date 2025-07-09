$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function handleUpload(btn, form, method, dataArray) {
    $(document).off('click', `#${btn}`).on('click', `#${btn}`, function(e) {
        e.preventDefault();
        submitForm(method, form, dataArray);
    });
};

function handleUploadRedirectDetail(btn, form, method, dataArray) {
    $(document).off('click', `#${btn}`).on('click', `#${btn}`, function(e) {
        e.preventDefault();
        submitFormRedirectDetail(method, form, dataArray);
    });
};

function submitForm(method, form, dataArray) {
    $('.indicator-progress').show();
    $('.indicator-label').hide();
    // loading_show('indicator-label', 'overlay');
    let form_data = new FormData(document.getElementById(form));
    form_data.append('_method', method);
    if (dataArray !== undefined) {
        for (let i = 0; i < dataArray.length; i++) {
            let elementValue = dataArray[i];
            elementValue = $('#' + dataArray[i]).val();
            form_data.append(dataArray[i], elementValue);
        }
    }
    // form_data.forEach((value, key) => {
    //     console.log(key + ": " + value);
    // });
    $.ajax({
        type: 'POST',
        url: $(`#${form}`).attr('action'),
        data: form_data,
        contentType: false,
        processData: false,
        success: function(res) {
            // loading_hide('indicator-label', 'overlay');
            $('.indicator-progress').hide();
            $('.indicator-label').show();
            Swal.fire({
                icon: 'success',
                title: res.text,
                showConfirmButton: false,
                timer: 1500
            }).then((res) => {
                var form_url = $(`#${form}`);
                var redirectUrl = form_url.data('redirect-url');
                window.location.href = redirectUrl;
            });
        },
        error: function(xhr) {
            // loading_hide('indicator-label', 'overlay');
            $('.indicator-progress').hide();
            $('.indicator-label').show();
            toastify_message(xhr.responseJSON.text);
        }
    });
}

function submitFormRedirectDetail(method, form, dataArray) {
    $('.indicator-progress').show();
    $('.indicator-label').hide();
    // loading_show('indicator-label', 'overlay');
    let form_data = new FormData(document.getElementById(form));
    form_data.append('_method', method);
    if (dataArray !== undefined) {
        for (let i = 0; i < dataArray.length; i++) {
            let elementValue = dataArray[i];
            elementValue = $('#' + dataArray[i]).val();
            form_data.append(dataArray[i], elementValue);
        }
    }
    $.ajax({
        type: 'POST',
        url: $(`#${form}`).attr('action'),
        data: form_data,
        contentType: false,
        processData: false,
        success: function(res) {
            // loading_hide('indicator-label', 'overlay');
            $('.indicator-progress').hide();
            $('.indicator-label').show();
            Swal.fire({
                icon: 'success',
                title: res.text,
                showConfirmButton: false,
                timer: 1500
            }).then((res) => {
                var form_url = $(`#${form}`);
                var redirectUrl = form_url.data('redirect-url');

                var nrp = $(`#${form}`).find('input[name="nrp"]').val();
                redirectUrl = redirectUrl.replace(':nrp', nrp);

                window.location.href = redirectUrl;
            });
        },
        error: function(xhr) {
            // loading_hide('indicator-label', 'overlay');
            $('.indicator-progress').hide();
            $('.indicator-label').show();
            toastify_message(xhr.responseJSON.text);
        }
    });
}

$(document).ready(function() {
    $('form').on('keypress', function(e) {
        if (e.which === 13) { 
            e.preventDefault();
            $(this).find('[type="submit"]').click();
        }
    });
});

function toastify_message(text)
{
    Toastify({
        text: text,
        duration: 3000,
        // destination: "https://github.com/apvarun/toastify-js",
        newWindow: true,
        close: false,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
        },
        onClick: function(){} // Callback after click
    }).showToast();
}

function loading_show(label, progress){
    $('.'+label).hide();
    $('.'+progress).show();
};
function loading_hide(label, progress){
    $('.'+label).show();
    $('.'+progress).hide();
};


function diffForHuman(date) {
    var seconds = Math.floor((new Date() - date) / 1000);
    var interval = Math.floor(seconds / 31536000);

    if (interval > 1) {
        return interval + " tahun yang lalu";
    }
    interval = Math.floor(seconds / 2592000);
    if (interval > 1) {
        return interval + " bulan yang lalu";
    }
    interval = Math.floor(seconds / 86400);
    if (interval > 1) {
        return interval + " hari yang lalu";
    }
    interval = Math.floor(seconds / 3600);
    if (interval > 1) {
        return interval + " jam yang lalu";
    }
    interval = Math.floor(seconds / 60);
    if (interval > 1) {
        return interval + " menit yang lalu";
    }
    return Math.floor(seconds) + " detik yang lalu";
}

function initializeDataTable(options) {
    if ($.fn.DataTable.isDataTable('#' + options.tableId)) {
        $('#' + options.tableId).DataTable().clear().destroy();
    }
    var table = $('#' + options.tableId).DataTable({
        pageLength: options.pageLength,
        lengthMenu: [ [5, 10, 25, 50], [5, 10, 25, 50] ],
        searching: options.searching,
        serverSide: options.serverSide,
        processing: options.processing,
        responsive: options.responsive,
        ajax: {
            url: options.ajax.url, 
            type: options.ajax.type || 'GET', 
            data: options.ajax.data,
        },
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
        }],
        columns: options.columns, 
        rowCallback: options.rowCallback 
    });

    $("#search").on("input", function() {
        table.search($(this).val()).draw();
    });
}

function addNewField(wrp, options, index) {
    $(wrp).append(`
        <div class="col-lg-6" id="new_container">
            <div class="mb-3 mx-5">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <select class="form-select" name="${options.selectName}[${index}][]" id="${options.selectId}_${index}">
                            <option value="">---pilih ${options.label}---</option>
                            ${options.data.map(item => `
                                <option value="${item.id}">${item.nama}</option>
                            `).join('')}
                        </select>
                    </div>
                    <div class="ms-2">
                        <a class="btn btn-outline-danger ${options.removeClass}" id="DeleteRow_${index}">
                            Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>`);
}

function addFilePerkara(wrpfile, optionsFile, indexFile) {
    $(wrpfile).append(`
        <div class="d-flex align-items-center justify-content-end mb-3" id="new_file_perkara_container">
            <div class="flex-grow-1 me-2">
                <input type="file" class="form-control" id="${optionsFile.selectId}_${indexFile}" name="${optionsFile.selectName}[${indexFile}][]">
            </div>
            <a class="btn btn-outline-danger ${optionsFile.removeClass}" id="DeleteRow_${indexFile}">
                Delete
            </a>
        </div>
    `);
}

function initAddRemoveField(addBtn, wrp, options, index) {
    $(addBtn).off().click(function (e) {
        e.preventDefault();
        addNewField(wrp, options, index);
    });

    $(document).on("click", `.${options.removeClass}`, function () {
        $(this).closest("#new_container").remove();
    });
}

function initAddRemoveFilePerkara(addBtnFile, wrpfile, optionsFile, indexFile) {
    $(addBtnFile).off().click(function (e) {
        e.preventDefault();
        addFilePerkara(wrpfile, optionsFile, indexFile);
    });

    $(document).on("click", `.${optionsFile.removeClass}`, function () {
        $(this).closest("#new_file_perkara_container").remove();
    });
}

function initializeClipboard(buttonSelector, targetSelector) {
    var clipboard = new ClipboardJS(buttonSelector, {
        target: function() {
            return document.querySelector(targetSelector);
        }
    });

    clipboard.on('success', function(e) {
        iziToast.success({
            title: 'Success',
            message: 'Table berhasil di salin !',
        });
        e.clearSelection();
    });

    clipboard.on('error', function(e) {
        iziToast.warning({
            title: 'Failed',
            message: "Gagal menyalin table!",
        });
    });
}

function confirmAndDelete(deleteUrl, id, tableSelector = '#dataTable') {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            sendDeleteRequest(deleteUrl, id, tableSelector);
        }
    });
}

function sendDeleteRequest(deleteUrl, id, tableSelector) {
    $.ajax({
        url: deleteUrl,
        type: 'POST',
        data: {
            id: id,
            _token: token
        },
        success: function (res, status) {
            if (status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Dihapus',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    $(tableSelector).DataTable().ajax.reload();
                });
            }
        },
        error: function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: xhr.responseJSON?.text || 'Something went wrong!'
            });
        }
    });
}