<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>

<form action="" method="post" enctype="multipart/form-data">
    <p>
        <label>Judul</label>
        <input type="text" name="judul"
               style="width:100%; padding:8px; margin-top:4px;">
    </p>
    <p>
        <label>Isi Artikel</label>
        <textarea name="isi" cols="50" rows="10"
                  style="width:100%; padding:8px; margin-top:4px;"></textarea>
    </p>
    <p>
        <label for="id_kategori">Kategori</label>
        <select name="id_kategori" id="id_kategori"
                style="width:100%; padding:8px; margin-top:4px;" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($kategori as $k) : ?>
                <option value="<?= $k['id_kategori']; ?>">
                    <?= $k['nama_kategori']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <label>Gambar (opsional)</label>
        <input type="file" name="gambar" accept="image/*"
               style="margin-top: 4px;">
    </p>
    <p>
        <input type="submit" value="Kirim" class="btn btn-large">
    </p>
</form>

<?= $this->include('template/admin_footer'); ?>