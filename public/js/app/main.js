$(document).off('click', '.lihat-aktivitas').on('click', '.lihat-aktivitas', function(){
    const dataId = $(this).data('id');
    let url = showLogUserUrl.replace(':id', dataId);
    url = url.replace(':id', dataId);
    $('.log_content').empty();
    $('.log_content').append('<i>please wait ...</i>');
    let html = '';
    $.ajax({
        type: "GET",
        url: url,
        success: function (response) {
            // console.log(response.history_pengaduan.data);
            const complete = '';
            const name = '';
            const where = '';
            const last = response.last.toLowerCase().replace(/\s/g, '')
            const lastIndex = response.track.findIndex(el => el.name === response.last);
            html += `
                <div class="card mb-3">
                    <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
                    </div>
                    <div class="card-body" style="background-color: #f3f3f9;">
                        <div class="row justify-content-center">
                            <div class="steps col-md-12">
                                <ul class="nav nav-pills mb-3 d-flex flex-wrap" id="pills-tab" role="tablist">
                                ${response.track.map((element, index) => {
                                    const isActive = element.name === response.last;
                                    const time = element.time;
                                    const isCompleted = index <= lastIndex;
                                    const isBeforeLast = index < lastIndex;
                                    return `
                                        <li class="nav-item col-6 col-md-auto" role="presentation">
                                            <button class="step nav-link ${isActive ? 'active' : ''}"
                                                id="pills-${element.name.toLowerCase().replace(/\s/g, '')}-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-${element.name.toLowerCase().replace(/\s/g, '')}" type="button"
                                                role="tab" aria-controls="pills-${element.name.toLowerCase().replace(/\s/g, '')}" aria-selected="false">
                                                ${isActive ? '<center><div class="badge bg-success mb-2">&#x2713;</div></center>' : '<center><div class="mb-2"><br></div></center>'}
                                                <div class="step-icon-wrap">
                                                    <div class="step-icon" style="background-color: ${isCompleted ? '#0da9ef' : ''};">
                                                        <i class="${element.icon}"></i>
                                                    </div>
                                                </div>
                                                <h4 class="step-title">${element.name}</h4>
                                            </button>
                                        </li>
                                       ${index < response.track.length - 1 ? `
                                            <li class="nav-item col-1 line-between">
                                                <div class="time-gap" style="color: ${isBeforeLast ? '#ff0000' : ''};"></div>
                                                <div class="line ${isBeforeLast ? 'completed' : ''}" style="background-color: ${isBeforeLast ? '#0da9ef' : ''};"></div>
                                            </li>
                                        ` : ''}
                                    `;
                                }).join('')}
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <div class="timeline">
                                        <div class="tab-content" id="pills-tabContent">

                                            <div class="tab-pane fade show ${last === 'forma' ? 'active' : ''}" id="pills-forma" role="tabpanel" aria-labelledby="pills-forma-tab">
                                            ${response.history_pengaduan.data
                                                .filter(element => element.status_pengaduan === null)
                                                .map((element, index) => {
                                                    let message;
                                                    if (element.act === null) {
                                                        message = `Membuat data dengan No Registrasi : ${element.no_registrasi+element.nomor_registrasi_pengaduan}`;
                                                    }else if (element.act === 'Proses') {
                                                        message = `Mengedit data No Registrasi : ${element.no_registrasi+element.nomor_registrasi_pengaduan}`;
                                                    }
                                                    else {
                                                        message = `Data diperbaiki, karna data sebelumnya ${element.act}`;
                                                    }
                                                    return `
                                                        <div class="timeline-item ${index % 2 === 0 ? 'left' : 'right'}">
                                                            <i class="icon ri-vip-diamond-line"></i>
                                                            <div class="date">${moment(element.created_at).locale('id').format("dddd, Do MMMM YYYY, HH:mm")}</div>
                                                            <div class="content">
                                                                <h5 class="fs-15">${element.email_user} <small class="text-muted fs-13 fw-normal">- ${moment(element.created_at).fromNow()}</small></h5>
                                                                <p class="text-muted">${message}</p>
                                                            </div>
                                                        </div>
                                                    `;
                                                }).join('')}
                                            </div>

                                            <div class="tab-pane fade show ${last === 'verifikasiadministrasi' ? 'active' : ''}" id="pills-verifikasiadministrasi" role="tabpanel" aria-labelledby="pills-verifikasiadministrasi-tab">
                                            ${response.history_pengaduan.data
                                                .filter(element => element.status_pengaduan === 'administrasi' && element.status_sidang === null)
                                                .map((element, index) => {
                                                    let message;
                                                    if (element.act === 'verif_admin' && element.status === 'MS') {
                                                        message = `Memverifikasi administrasi no. registrasi: ${element.no_registrasi} dengan no. pengaduan: ${element.no_pengaduan}`;
                                                    }else if (element.status === 'BMS') {
                                                        message = `Data belum memenuhi syarat dengan alasan ${element.text ? element.text : `-`}`;
                                                    }else if (element.status === 'TMS'){
                                                        message = `Data tidak memenuhi syarat dengan alasan ${element.text ? element.text : `-`}`;
                                                    }else if (element.status === 'Dismiss'){
                                                        message = `Data gugur dengan alasan ${element.text ? element.text : `-`}`;
                                                    }else if (element.act === 'no_pengadu_vermat') {
                                                        message = `Mengubah No Pengaduan menjadi ${element.no_pengaduan}`;
                                                    }
                                                    
                                                    return `
                                                        <div class="timeline-item ${index % 2 === 0 ? 'left' : 'right'}">
                                                            <i class="icon ri-vip-diamond-line"></i>
                                                            <div class="date">${moment(element.created_at).locale('id').format("dddd, Do MMMM YYYY, HH:mm")}</div>
                                                            <div class="content">
                                                                <h5 class="fs-15">${element.email_user} <small class="text-muted fs-13 fw-normal">- ${moment(element.created_at).fromNow()}</small></h5>
                                                                <p class="text-muted">${message}</p>
                                                            </div>
                                                        </div>
                                                    `;
                                                }).join('')}
                                            </div>

                                            <div class="tab-pane fade show ${last === 'verifikasimateril' ? 'active' : ''}" id="pills-verifikasimateril" role="tabpanel" aria-labelledby="pills-verifikasimateril-tab">
                                                ${response.history_pengaduan.data
                                                .filter(element => element.status_pengaduan === 'materil' && element.status_sidang === null)
                                                .map((element, index) => {
                                                    let message;
                                                    if (element.act === 'verif_materil' && element.status === 'MS') {
                                                        message = `Memverifikasi materil no. pengaduan: ${element.no_pengaduan} dengan no. perkara: ${element.no_perkara}`;
                                                    } else if (element.act === 'no_pengadu_vermat') {
                                                        message = `Mengubah No Pengaduan menjadi ${element.no_pengaduan}`;
                                                    } else if (element.act === 'no_perkara_sidang'){
                                                        message = `Mengubah No Perkara menjadi ${element.no_perkara}`;
                                                    }else if (element.status === 'BMS') {
                                                        message = `Data belum memenuhi syarat dengan alasan ${element.text ? element.text : `-`}`;
                                                    }else if (element.status === 'TMS'){
                                                        message = `Data tidak memenuhi syarat dengan alasan ${element.text ? element.text : `-`}`;
                                                    }else if (element.status === 'Dismiss'){
                                                        message = `Data gugur dengan alasan ${element.text ? element.text : `-`}`;
                                                    }
                                                    
                                                    return `
                                                        <div class="timeline-item ${index % 2 === 0 ? 'left' : 'right'}">
                                                            <i class="icon ri-vip-diamond-line"></i>
                                                            <div class="date">${moment(element.created_at).locale('id').format("dddd, Do MMMM YYYY, HH:mm")}</div>
                                                            <div class="content">
                                                                <h5 class="fs-15">${element.email_user} <small class="text-muted fs-13 fw-normal">- ${moment(element.created_at).fromNow()}</small></h5>
                                                                <p class="text-muted">${message}</p>
                                                            </div>
                                                        </div>
                                                    `;
                                                }).join('')}
                                            </div>
                                            
                                            <div class="tab-pane fade show ${last === 'penjadwalansidangpemeriksaan' ? 'active' : ''}" id="pills-penjadwalansidangpemeriksaan" role="tabpanel" aria-labelledby="pills-penjadwalansidangpemeriksaan-tab">
                                            ${response.history_pengaduan.data
                                                .filter(element => element.status_sidang <= 5 && element.proses_sidang !== null && element.proses_sidang == 'proses')
                                                .map((element, index) => {
                                                    let message;
                                                    if (element.act === 'update_jadwal_sidang_pemeriksaan') {
                                                        message = `Mengupdate jadwal sidang pemeriksaan`;
                                                    } else{
                                                        message = `Menjadwalkan no. perkara: ${element.no_perkara} pada sidang ${`pemeriksaan ${element.status_sidang}`}`;
                                                    }
                                                    return `
                                                        <div class="timeline-item ${index % 2 === 0 ? 'left' : 'right'}">
                                                            <i class="icon ri-vip-diamond-line"></i>
                                                            <div class="date">${moment(element.created_at).locale('id').format("dddd, Do MMMM YYYY, HH:mm")}</div>
                                                            <div class="content">
                                                                <h5 class="fs-15">${element.email_user} <small class="text-muted fs-13 fw-normal">- ${moment(element.created_at).fromNow()}</small></h5>
                                                                <p class="text-muted">${message}</p>
                                                            </div>
                                                        </div>
                                                    `;
                                                }).join('')}
                                            </div>

                                            <div class="tab-pane fade show ${last === 'sidangpemeriksaan' ? 'active' : ''}" id="pills-sidangpemeriksaan" role="tabpanel" aria-labelledby="pills-sidangpemeriksaan-tab">
                                                ${response.history_pengaduan.data
                                                .filter(element => element.status_sidang !== null && element.selesai_pemeriksaan !== null && element.proses_sidang == 'selesai' && element.selesai_putusan == null) 
                                                .map((element, index) => {
                                                    let message;
                                                    if (element.act === 'selesai_sidang_pemeriksaan') {
                                                        message = `No. perkara: ${element.no_perkara} pada sidang pemeriksaan ${element.status_sidang} selesai diperiksa pada ${moment(element.selesai_pemeriksaan).locale('id').format("dddd, Do MMMM YYYY")}`;
                                                    } else if (element.act === 'no_pengadu_vermat') {
                                                        message = `Mengubah No Pengaduan menjadi ${element.no_pengaduan}`;
                                                    } else if (element.act === 'no_perkara_sidang'){
                                                        message = `Mengubah No Perkara menjadi ${element.no_perkara}`;
                                                    }
                                                    
                                                    return `
                                                        <div class="timeline-item ${index % 2 === 0 ? 'left' : 'right'}">
                                                            <i class="icon ri-vip-diamond-line"></i>
                                                            <div class="date">${moment(element.created_at).locale('id').format("dddd, Do MMMM YYYY, HH:mm")}</div>
                                                            <div class="content">
                                                                <h5 class="fs-15">${element.email_user} <small class="text-muted fs-13 fw-normal">- ${moment(element.created_at).fromNow()}</small></h5>
                                                                <p class="text-muted">${message}</p>
                                                            </div>
                                                        </div>
                                                    `;
                                                }).join('')}
                                            </div>
                                            
                                            <div class="tab-pane fade show ${last === 'penjadwalansidangpembacaanputusan' ? 'active' : ''}" id="pills-penjadwalansidangpembacaanputusan" role="tabpanel" aria-labelledby="pills-penjadwalansidangpembacaanputusan-tab">
                                                ${response.history_pengaduan.data
                                                .filter(element => element.status_sidang > 5 && element.proses_sidang !== null && element.proses_sidang == 'proses')
                                                .map((element, index) => {
                                                    let message;
                                                    if (element.act === 'update_jadwal_sidang_putusan') {
                                                        message = `Mengubah jadwal sidang pembacaan putusan`;
                                                    }else{
                                                        message = `Menjadwalkan no. perkara: ${element.no_perkara} pada sidang ${`${element.status_sidang == 6 ? 'pleno' : 'pembacaan putusan'}`}`;
                                                    }
                                                    return `
                                                        <div class="timeline-item ${index % 2 === 0 ? 'left' : 'right'}">
                                                            <i class="icon ri-vip-diamond-line"></i>
                                                            <div class="date">${moment(element.created_at).locale('id').format("dddd, Do MMMM YYYY, HH:mm")}</div>
                                                            <div class="content">
                                                                <h5 class="fs-15">${element.email_user} <small class="text-muted fs-13 fw-normal">- ${moment(element.created_at).fromNow()}</small></h5>
                                                                <p class="text-muted">${message}</p>
                                                            </div>
                                                        </div>
                                                    `;
                                                }).join('')}
                                            </div>

                                            <div class="tab-pane fade show ${last === 'sidangpembacaanputusan' ? 'active' : ''}" id="pills-sidangpembacaanputusan" role="tabpanel" aria-labelledby="pills-sidangpembacaanputusan-tab">
                                            ${response.history_pengaduan.data
                                                .filter(element => element.status_sidang !== null && element.selesai_putusan !== null && element.proses_sidang == 'selesai')
                                                .map((element, index) => `
                                                        <div class="timeline-item ${index % 2 === 0 ? 'left' : 'right'}">
                                                            <i class="icon ri-vip-diamond-line"></i>
                                                            <div class="date">${moment(element.created_at).locale('id').format("dddd, Do MMMM YYYY, HH:mm")}</div>
                                                            <div class="content">
                                                                <h5 class="fs-15">${element.email_user} <small class="text-muted fs-13 fw-normal">- ${moment(element.created_at).fromNow()}</small></h5>
                                                                <p class="text-muted">No. perkara: ${element.no_perkara} pada Sidang Pembacaan Putusan selesai diputuskan pada ${moment(element.selesai_putusan).locale('id').format("dddd, Do MMMM YYYY")}</p>
                                                            </div>
                                                        </div>
                                                        `).join('')
                                            }
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $('.log_content').html(html);
        }
    });
});