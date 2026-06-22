<?= $this->include('template/header'); ?>

<h1>Data Artikel</h1>

<!-- Tombol Tambah -->
<button id="btnTambah"
        style="margin-bottom:15px; padding:8px 16px; background:#27ae60;
               color:#fff; border:none; border-radius:4px; cursor:pointer; font-size:14px;">
    + Tambah Data
</button>

<!-- Modal Form Tambah/Edit -->
<div id="modalOverlay"
     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
            background:rgba(0,0,0,0.5); z-index:100; justify-content:center; align-items:center;">
    <div style="background:#fff; padding:30px; width:480px; border-radius:8px;
                box-shadow:0 4px 20px rgba(0,0,0,0.2);">
        <h3 id="modalTitle" style="margin-bottom:15px; color:#1e3a5f;">Tambah Artikel</h3>

        <input type="hidden" id="editId" value="">

        <p>
            <label style="font-weight:bold; font-size:13px;">Judul</label>
            <input type="text" id="inputJudul"
                   style="width:100%; padding:8px; border:1px solid #ccc;
                          border-radius:4px; margin-top:4px;">
        </p>
        <p>
            <label style="font-weight:bold; font-size:13px;">Isi</label>
            <textarea id="inputIsi" rows="6"
                      style="width:100%; padding:8px; border:1px solid #ccc;
                             border-radius:4px; margin-top:4px;"></textarea>
        </p>
        <p>
            <label style="font-weight:bold; font-size:13px;">Status</label>
            <select id="inputStatus"
                    style="width:100%; padding:8px; border:1px solid #ccc;
                           border-radius:4px; margin-top:4px;">
                <option value="0">Draft</option>
                <option value="1">Publish</option>
            </select>
        </p>
        <div style="margin-top:15px; display:flex; gap:8px;">
            <button id="btnSimpan"
                    style="padding:8px 18px; background:#2c5282; color:#fff;
                           border:none; border-radius:4px; cursor:pointer;">
                Simpan
            </button>
            <button id="btnBatal"
                    style="padding:8px 18px; background:#999; color:#fff;
                           border:none; border-radius:4px; cursor:pointer;">
                Batal
            </button>
        </div>
    </div>
</div>

<table class="table" id="artikelTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data diisi oleh AJAX -->
    </tbody>
</table>

<script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
<script>
$(document).ready(function () {

    // ── Fungsi Tampil Loading ─────────────────────────
    function showLoadingMessage() {
        $('#artikelTable tbody').html(
            '<tr><td colspan="4" style="text-align:center;">Loading data...</td></tr>'
        );
    }

    // ── Fungsi Load Data dari Server ──────────────────
    function loadData() {
        showLoadingMessage();
        $.ajax({
            url: '<?= base_url('ajax/getData') ?>',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                var tableBody = '';
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        var row = data[i];
                        var judulEsc = row.judul.replace(/\\/g, '\\\\').replace(/'/g, "\\'");
                        tableBody += '<tr>';
                        tableBody += '<td>' + row.id + '</td>';
                        tableBody += '<td><b>' + row.judul + '</b></td>';
                        tableBody += '<td>' + (row.status == 1 ? 'Publish' : 'Draft') + '</td>';
                        tableBody += '<td>';
                        tableBody += '<a href="#" class="btn-edit" '
                                   + 'style="display:inline-block; padding:4px 10px; background:#17a2b8; '
                                   + 'color:#fff; border-radius:4px; text-decoration:none; font-size:12px; margin-right:4px;" '
                                   + 'data-id="' + row.id + '" '
                                   + 'data-judul="' + judulEsc + '" '
                                   + 'data-isi="' + (row.isi || '').substring(0, 100) + '" '
                                   + 'data-status="' + row.status + '">Edit</a>';
                        tableBody += '<a href="#" class="btn-delete" '
                                   + 'style="display:inline-block; padding:4px 10px; background:#c0392b; '
                                   + 'color:#fff; border-radius:4px; text-decoration:none; font-size:12px;" '
                                   + 'data-id="' + row.id + '">Delete</a>';
                        tableBody += '</td>';
                        tableBody += '</tr>';
                    }
                } else {
                    tableBody = '<tr><td colspan="4" style="text-align:center;">Tidak ada data.</td></tr>';
                }
                $('#artikelTable tbody').html(tableBody);
            },
            error: function () {
                $('#artikelTable tbody').html(
                    '<tr><td colspan="4" style="color:red; text-align:center;">Gagal memuat data.</td></tr>'
                );
            }
        });
    }

    loadData();

    // ── Buka Modal Tambah ─────────────────────────────
    $('#btnTambah').on('click', function () {
        $('#modalTitle').text('Tambah Artikel');
        $('#editId').val('');
        $('#inputJudul').val('');
        $('#inputIsi').val('');
        $('#inputStatus').val('0');
        $('#modalOverlay').css('display', 'flex');
    });

    // ── Tutup Modal ───────────────────────────────────
    $('#btnBatal').on('click', function () {
        $('#modalOverlay').hide();
    });

    // ── Buka Modal Edit ───────────────────────────────
    $(document).on('click', '.btn-edit', function (e) {
        e.preventDefault();
        $('#modalTitle').text('Edit Artikel');
        $('#editId').val($(this).data('id'));
        $('#inputJudul').val($(this).data('judul'));
        $('#inputIsi').val($(this).data('isi'));
        $('#inputStatus').val($(this).data('status'));
        $('#modalOverlay').css('display', 'flex');
    });

    // ── Simpan Data (Tambah atau Edit) ────────────────
    $('#btnSimpan').on('click', function () {
        var id     = $('#editId').val();
        var judul  = $('#inputJudul').val().trim();
        var isi    = $('#inputIsi').val().trim();
        var status = $('#inputStatus').val();

        if (judul === '') {
            alert('Judul tidak boleh kosong!');
            return;
        }

        var url = id
            ? '<?= base_url('ajax/update/') ?>' + id
            : '<?= base_url('ajax/add') ?>';

        $.ajax({
            url: url,
            method: 'POST',
            data: { judul: judul, isi: isi, status: status },
            dataType: 'json',
            success: function (res) {
                $('#modalOverlay').hide();
                loadData();
            },
            error: function () {
                alert('Gagal menyimpan data.');
            }
        });
    });

    // ── Hapus Data ────────────────────────────────────
    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        if (confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
            $.ajax({
                url: '<?= base_url('ajax/delete/') ?>' + id,
                method: 'DELETE',
                dataType: 'json',
                success: function (data) {
                    loadData();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error: ' + textStatus + ' ' + errorThrown);
                }
            });
        }
    });

});
</script>

<?= $this->include('template/footer'); ?>