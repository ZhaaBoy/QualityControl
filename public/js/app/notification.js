function proses_notif(year, url, editUrl, badge, content){
    $.ajax({
        type: "get",
        url: url,
        data: {year: year},
        dataType: "json",
        success: function (response) {
            let html = '';
            if (response && response.items) {
                let totalWeekdaysDifference = 0;
                let counter=1;
                response.items.forEach(function (data) {
                    let updatedEditUrl = editUrl.replace(':id', data.pengaduan_id);
                    let nomor_name = '';
                    let nomor_data = '';
                    let btn = '';
                    if(badge == 'Vermin'){
                        nomor_name = 'No Registrasi';
                        nomor_data = data.pengaduan_id;
                        btn = 'Verifikasi';
                    }else if(badge == 'Vermat'){
                        nomor_name = 'No Pengaduan';
                        nomor_data = data.no_pengaduan;
                        btn = 'Verifikasi';
                    }else if(badge == 'Sidang'){
                        nomor_name = 'No Perkara';
                        nomor_data = data.no_perkara;
                        btn = 'Jadwalkan';
                    }
                    const updated = data.updated_at;
                    const parsedDate = moment(updated);
                    const today = moment();

                    const differenceInDays = today.diff(parsedDate, 'days');

                    let weekends = 0;
                    for (let i = 0; i <= differenceInDays; i++) {
                        const dateToCheck = moment(parsedDate).add(i, 'days');
                        if (dateToCheck.day() === 6 || dateToCheck.day() === 7 || dateToCheck.day() === 0) {
                            weekends++;
                        }
                    }

                    const weekdaysDifference = differenceInDays - weekends;

                    const formattedDifference = moment().subtract(weekdaysDifference, 'days').fromNow();

                    
                    if(weekdaysDifference >= 3){
                        totalWeekdaysDifference += counter;

                        html += `<div class="text-reset notification-item d-block dropdown-item position-relative">
                                    <div class="d-flex">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title bg-soft-danger text-danger rounded-circle fs-16">
                                                <i class='bx bx-message-square-dots'></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <span class="stretched-link">
                                                <h6 class="mt-0 mb-2 fs-13 lh-base">Data ${nomor_name} <strong>${nomor_data}</strong> - Belum Di${btn} Sudah Lebih dari 3 Hari 
                                                </h6>
                                            </span>
                                            <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                <span><i class="mdi mdi-clock-outline"></i> ${formattedDifference}</span>
                                            </p>
                                        </div>
                                        <div class="px-2 fs-15">
                                            <div class="form-check notification-check">
        
                                                <div class="justify-content-end">
                                                    <a href="${updatedEditUrl}" title="${badge}" class="btn btn-primary btn-active-color-success btn-sm me-1 stretched-link"> ${btn} </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                    }
                });
                
                if (totalWeekdaysDifference > 0 ) {
                    $('#notif-badge').show(); 
                }else{
                    $('#notif-badge').fadeOut('fast');
                }
                $('#' + badge).text(`${badge}(${totalWeekdaysDifference})`);
                
            } else {
                console.log('');
            }
            
            if (html !== '') {
                $('.' + content).html(html);
            } else {
                $('.' + content).html(`<div class="w-25 w-sm-50 pt-3 mx-auto">
                                                    <img src="/assets/images/svg/bell.svg" class="img-fluid" alt="user-pic">
                                                </div>
                                                <div class="text-center pb-5 mt-2">
                                                    <h6 class="fs-18 fw-semibold lh-base">Hey! You have no any notifications </h6>
                                                </div>`);
            }
        }

    });
} 

function NotificationSidang(year, url, editUrl, badge, content){
    // const url = '';
    proses_notif(year, url, editUrl, badge, content);
}

function NotificationVermin(year, url, editUrl, badge, content){
    // const url = '';
    proses_notif(year, url, editUrl, badge, content);
}

function NotificationVermat(year, url, editUrl, badge, content){
    // const url = '';
    proses_notif(year, url, editUrl, badge, content);
}

$(document).ready(function() {
    var selectedYear = null;
    $('#yearFilterNotif').change(function() {
        selectedYear = $(this).val();
        if (selectedYear && selectedYear !== null) {
            NotificationVermin(selectedYear, `{{ route('get_notification.vermin') }}`, `{{ route('verifikasi.cek_data_administrasi.edit', [':id']) }}`, 'Vermin', 'content-vermin'); 

            NotificationVermat(selectedYear, `{{ route('get_notification.vermat') }}`, `{{ route('verifikasi.cek_data_materiil.edit', [':id']) }}`, 'Vermat', 'content-vermat'); 
            
            NotificationSidang(selectedYear, `{{ route('get_notification.sidang') }}`, `{{ route('persidangan.penjadwalan_sidang.edit', [':id']) }}`, 'Sidang', 'content-sidang');
        }
    });
    NotificationVermin(selectedYear, `{{ route('get_notification.vermin') }}`, `{{ route('verifikasi.cek_data_administrasi.edit', [':id']) }}`, 'Vermin', 'content-vermin'); 
        
    NotificationSidang(selectedYear, `{{ route('get_notification.sidang') }}`, `{{ route('persidangan.penjadwalan_sidang.edit', [':id']) }}`, 'Sidang', 'content-sidang');

    NotificationVermat(selectedYear, `{{ route('get_notification.vermat') }}`, `{{ route('verifikasi.cek_data_materiil.edit', [':id']) }}`, 'Vermat', 'content-vermat'); 

    setInterval(function() {
        NotificationVermin(selectedYear, `{{ route('get_notification.vermin') }}`, `{{ route('verifikasi.cek_data_administrasi.edit', [':id']) }}`, 'Vermin', 'content-vermin'); 
        
        NotificationSidang(selectedYear, `{{ route('get_notification.sidang') }}`, `{{ route('persidangan.penjadwalan_sidang.edit', [':id']) }}`, 'Sidang', 'content-sidang');

        NotificationVermat(selectedYear, `{{ route('get_notification.vermat') }}`, `{{ route('verifikasi.cek_data_materiil.edit', [':id']) }}`, 'Vermat', 'content-vermat'); 
        
    }, 15 * 100000);
});
