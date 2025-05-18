<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Playstation</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f1f2f6;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .add-button {
            display: inline-block;
            margin-bottom: 30px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .add-button:hover {
            background-color: #2980b9;
        }

        .hp-card {
            background-color: #ffffff;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 20px;
            margin-bottom: 25px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .hp-card img {
            max-width: 100%;
            border-radius: 10px;
            object-fit: cover;
        }

        .hp-card h3 {
            margin: 0;
            font-size: 20px;
            color: #2c3e50;
        }

        .hp-card p {
            margin: 0;
            font-size: 15px;
            color: #555;
        }

        .harga {
            font-weight: bold;
            font-size: 16px;
            color: #27ae60;
        }

        .actions {
            margin-top: 15px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .actions a,
        .actions button {
            padding: 10px 14px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            color: white;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .pesan {
            background-color: #27ae60;
        }

        .pesan:hover {
            background-color: #219150;
        }

        .tukar {
            background-color: #3498db;
        }

        .tukar:hover {
            background-color: #2980b9;
        }

        .edit {
            background-color: #f39c12;
        }

        .edit:hover {
            background-color: #d68910;
        }

        .hapus {
            background-color: #e74c3c;
        }

        .hapus:hover {
            background-color: #c0392b;
        }

        #modal-edit-hp {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        #edit-hp-content {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            min-width: 350px;
            max-width: 90vw;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }

        #close-modal-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 18px;
            cursor: pointer;
        }

        @media screen and (max-width: 768px) {
            .actions {
                flex-direction: column;
                align-items: stretch;
            }

            .hp-card {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Playstation</h1>

        <!-- Tombol Tambah -->
        <?php if (session()->get('level') === 'superadmin' || session()->get('level') === 'admin'): ?>
            <a href="<?= base_url('/Hp/tambahHp'); ?>" class="add-button">+ Tambah HP</a>
        <?php endif; ?>

        <!-- Daftar HP -->
        <?php foreach ($hpList as $hp): ?>
        <div class="hp-card">
            <img src="<?= base_url('uploads/' . $hp['foto_hp']); ?>" alt="Foto <?= $hp['merk']; ?>">

            <h3><?= esc($hp['merk']); ?> (<?= esc($hp['tahun']); ?>)</h3>
            <p>Kondisi: <?= esc($hp['kondisi']); ?></p>
            <p class="harga">Harga: Rp<?= number_format($hp['harga'], 0, ',', '.'); ?></p>
            <p>Deskripsi: <?= esc($hp['deskripsi']); ?></p>

            <div class="actions">
                <a href="<?= base_url('/Keranjang/pesan/' . $hp['id_hp']); ?>" class="pesan">Pesan</a>

                <?php if (session()->get('level') === 'superadmin' || session()->get('level') === 'admin'): ?>
                    <a href="<?= base_url('/Hp/editHp/' . $hp['id_hp']); ?>" class="edit">Edit</a>
                    <form action="<?= base_url('/Hp/hapusHp/' . $hp['id_hp']); ?>" method="post" style="display:inline;">
                        <button type="submit" class="hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus HP ini?')">Hapus</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Modal Edit -->
    <div id="modal-edit-hp">
        <div id="edit-hp-content">
            <button id="close-modal-btn" onclick="closeEditModal()">&times;</button>
        </div>
    </div>

    <script>
        function openEditModal(id_hp) {
            document.getElementById('modal-edit-hp').style.display = 'flex';
            document.getElementById('edit-hp-content').innerHTML =
                '<button id="close-modal-btn" onclick="closeEditModal()">&times;</button>';

            fetch('<?= base_url('/Hp/editHp') ?>/' + id_hp)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('edit-hp-content').innerHTML += html;
                });
        }

        function closeEditModal() {
            document.getElementById('modal-edit-hp').style.display = 'none';
            document.getElementById('edit-hp-content').innerHTML =
                '<button id="close-modal-btn" onclick="closeEditModal()">&times;</button>';
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.edit').forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const id_hp = this.href.split('/').pop();
                    openEditModal(id_hp);
                });
            });
        });
    </script>
</body>
</html>
