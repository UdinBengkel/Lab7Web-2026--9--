<?= $this->include('template/admin_header'); ?>

<h2>Daftar Artikel</h2>

<form method="get" style="margin-bottom: 15px; display: flex; gap: 8px; flex-wrap: wrap;">
    <input type="text"
           name="q"
           value="<?= $q; ?>"
           placeholder="Cari judul..."
           style="padding: 7px 10px; width: 200px; border: 1px solid #ccc; border-radius: 4px;">

    <select name="kategori_id"
            style="padding: 7px 10px; border: 1px solid #ccc; border-radius: 4px;">
        <option value="">Semua Kategori</option>
        <?php foreach ($kategori as $k) : ?>
            <option value="<?= $k['id_kategori']; ?>"
                <?= ($kategori_id == $k['id_kategori']) ? 'selected' : ''; ?>>
                <?= $k['nama_kategori']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Cari" class="btn btn-primary">

    <?php if ($q != '' || $kategori_id != '') : ?>
        <a href="<?= base_url('/admin/artikel'); ?>" class="btn" style="background:#999;">Reset</a>
    <?php endif; ?>
</form>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($artikel) : foreach ($artikel as $row) : ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td>
                <b><?= $row['judul']; ?></b>
                <p><small><?= substr($row['isi'], 0, 50); ?></small></p>
            </td>
            <td><?= $row['nama_kategori'] ?? '-'; ?></td>
            <td><?= $row['status'] == 1 ? 'Publish' : 'Draft'; ?></td>
            <td>
                <a class="btn"
                   href="<?= base_url('/admin/artikel/edit/' . $row['id']); ?>">Ubah</a>
                <a class="btn btn-danger"
                   onclick="return confirm('Yakin menghapus data?');"
                   href="<?= base_url('/admin/artikel/delete/' . $row['id']); ?>">Hapus</a>
            </td>
        </tr>
        <?php endforeach; else : ?>
        <tr>
            <td colspan="5" style="text-align:center;">Tidak ada data.</td>
        </tr>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </tfoot>
</table>

<?= $pager->only(['q', 'kategori_id'])->links(); ?>

<?= $this->include('template/admin_footer'); ?>