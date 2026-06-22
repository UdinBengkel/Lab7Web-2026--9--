<?= $this->include('template/header'); ?>

<article class="entry">
    <h2><?= $artikel['judul']; ?></h2>
    <p><small>Kategori: <strong><?= $kategori['nama_kategori'] ?? 'Umum'; ?></strong></small></p>
    <img src="<?= base_url('/gambar/' . $artikel['gambar']); ?>"
         alt="<?= $artikel['judul']; ?>">
    <p><?= $artikel['isi']; ?></p>
</article>

<?= $this->include('template/footer'); ?>