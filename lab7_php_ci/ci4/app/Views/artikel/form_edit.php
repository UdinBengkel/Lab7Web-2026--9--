<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>

<form action="" method="post">
    <p>
        <label>Judul</label>
        <input type="text" name="judul"
               value="<?= $artikel['judul']; ?>"
               style="width:100%; padding:8px; margin-top:4px;">
    </p>
    <p>
        <label>Isi Artikel</label>
        <textarea name="isi" cols="50" rows="10"
                  style="width:100%; padding:8px; margin-top:4px;"><?= $artikel['isi']; ?></textarea>
    </p>
    <p>
        <label for="id_kategori">Kategori</label>
        <select name="id_kategori" id="id_kategori"
                style="width:100%; padding:8px; margin-top:4px;" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($kategori as $k) : ?>
                <option value="<?= $k['id_kategori']; ?>"
                    <?= ($artikel['id_kategori'] == $k['id_kategori']) ? 'selected' : ''; ?>>
                    <?= $k['nama_kategori']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <input type="submit" value="Kirim" class="btn btn-large">
    </p>
</form>

<?= $this->include('template/admin_footer'); ?>