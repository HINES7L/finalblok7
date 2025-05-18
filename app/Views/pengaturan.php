<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Pengaturan Aplikasi</h5>
        </div>
        <div class="card-body">
            <form action="<?= base_url('/Pengaturan/simpan_pengaturan') ?>" method="post" enctype="multipart/form-data">
                
                <!-- Judul Aplikasi -->
                <div class="mb-4">
                    <label for="judul" class="form-label fw-semibold">Judul Aplikasi:</label>
                    <input type="text" name="judul" id="judul" value="<?= esc($pengaturan->judul ?? '') ?>" class="form-control" required>
                </div>

                <!-- Logo Header Saat Ini -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Logo Header Saat Ini:</label><br>
                    <?php if (!empty($pengaturan->logo) && file_exists(FCPATH . 'uploads/' . $pengaturan->logo)): ?>
                        <img src="<?= base_url('uploads/' . $pengaturan->logo) ?>" alt="Logo Header" class="img-thumbnail" style="max-height: 100px;">
                    <?php else: ?>
                        <p class="text-muted fst-italic">Tidak ada logo header</p>
                    <?php endif; ?>
                </div>

                <!-- Upload Logo Header Baru -->
                <div class="mb-4">
                    <label for="logo" class="form-label fw-semibold">Unggah Logo Header Baru:</label>
                    <input type="file" name="logo" id="logo" accept="image/*" class="form-control">
                </div>

                <!-- Favicon Saat Ini -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Logo Favicon Saat Ini:</label><br>
                    <?php if (!empty($pengaturan->logo_web) && file_exists(FCPATH . 'uploads/' . $pengaturan->logo_web)): ?>
                        <img src="<?= base_url('uploads/' . $pengaturan->logo_web) ?>" alt="Favicon" class="img-thumbnail" style="max-height: 50px;">
                    <?php else: ?>
                        <p class="text-muted fst-italic">Tidak ada favicon</p>
                    <?php endif; ?>
                </div>

                <!-- Upload Favicon Baru -->
                <div class="mb-4">
                    <label for="logo_web" class="form-label fw-semibold">Unggah Logo Favicon Baru:</label>
                    <input type="file" name="logo_web" id="logo_web" accept="image/*" class="form-control">
                </div>

                <!-- Tombol Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan Pengaturan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
