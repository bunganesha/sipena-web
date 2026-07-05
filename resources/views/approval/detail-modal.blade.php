<div class="modal fade"
    id="detailModal"
    tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h3 class="modal-title">

                    Detail Pengajuan

                </h3>

                <button
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <table class="table table-bordered">

                    <tr>
                        <th width="30%">Nama</th>
                        <td id="dNama"></td>
                    </tr>

                    <tr>
                        <th>NIP</th>
                        <td id="dNip"></td>
                    </tr>

                    <tr>
                        <th>Jenis Pengajuan</th>
                        <td id="dJenis"></td>
                    </tr>

                    <tr>
                        <th>Tanggal</th>
                        <td id="dTanggal"></td>
                    </tr>

                    <tr>
                        <th>Alasan</th>
                        <td id="dAlasan"></td>
                    </tr>

                </table>

                <hr>

                <h4>Riwayat Approval</h4>

                <div id="approvalLogs">

                </div>

            </div>

        </div>

    </div>

</div>


<script>
    document.querySelectorAll('.btn-detail').forEach(btn => {

        btn.addEventListener('click', function() {

            let id = this.dataset.id;

            fetch('/approval/' + id + '/detail')

                .then(res => res.json())

                .then(res => {

                    let d = res.data;

                    document.getElementById('dNama').innerHTML = d.pegawai.nama;

                    document.getElementById('dNip').innerHTML = d.pegawai.nip;

                    document.getElementById('dJenis').innerHTML = d.jenis_pengajuan;

                    document.getElementById('dTanggal').innerHTML =
                        d.tanggal_mulai + ' s/d ' + d.tanggal_selesai;

                    document.getElementById('dAlasan').innerHTML = d.alasan;

                    let html = '';

                    if (d.logs.length == 0) {

                        html = '<p class="text-secondary">Belum ada riwayat approval.</p>';

                    } else {

                        d.logs.forEach(function(log) {

                            let badge = 'secondary';

                            if (log.status == 'approved')
                                badge = 'success';

                            if (log.status == 'rejected')
                                badge = 'danger';

                            html += `

                    <div class="card mb-2">

                        <div class="card-body">

                            <div class="d-flex justify-content-between">

                                <strong>${log.role.toUpperCase()}</strong>

                                <span class="badge bg-${badge}">

                                    ${log.status}

                                </span>

                            </div>

                            <small class="text-secondary">

                                ${log.created_at}

                            </small>

                            <div class="mt-2">

                                ${log.alasan ?? '-'}

                            </div>

                        </div>

                    </div>

                    `;

                        });

                    }

                    document.getElementById('approvalLogs').innerHTML = html;

                    new bootstrap.Modal(document.getElementById('detailModal')).show();

                });

        });

    });
</script>