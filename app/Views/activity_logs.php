<!-- Filepath: app/Views/activity_logs.php -->

<div class="pagetitle">
    <h1>Log Aktivitas</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <!-- Filter Username -->
                    <?php if (in_array($level, ['admin', 'superadmin', 'operator'])): ?>
                        <form method="GET" action="<?= base_url('/User/logActivitytab/') ?>" class="mb-4">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <label for="filter-username" class="form-label fw-semibold">Filter berdasarkan Username:</label>
                                    <select id="filter-username" name="username" class="form-select" onchange="this.form.submit()">
                                        <option value="">Semua Username</option>
                                        <?php foreach ($users as $user): ?>
                                            <option value="<?= esc($user['username']) ?>" <?= ($selectedUsername == $user['username']) ? 'selected' : '' ?>>
                                                <?= esc($user['username']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>

                    <!-- Kontrol Pagination -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <label for="rowsPerPage" class="me-2 fw-semibold">Baris per halaman:</label>
                            <select id="rowsPerPage" class="form-select d-inline-block" style="width: 80px;">
                                <option value="5" selected>5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                        <div>
                            <button class="btn btn-outline-primary btn-sm me-2" id="prevPage">Previous</button>
                            <button class="btn btn-outline-primary btn-sm" id="nextPage">Next</button>
                        </div>
                    </div>

                    <!-- Tabel Log -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Aksi</th>
                                    <th scope="col">IP Address</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody">
                                <?php if (!empty($logs)) : ?>
                                    <?php $no = 1; foreach ($logs as $log): ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= esc($log['timestamp']) ?></td>
                                            <td><?= esc($log['username']) ?></td>
                                            <td><?= esc($log['aksi']) ?></td>
                                            <td><?= esc($log['ip_address']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Tidak ada log aktivitas.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript Pagination -->
<script>
    const rowsPerPageSelect = document.getElementById('rowsPerPage');
    const userTableBody = document.getElementById('userTableBody');
    const prevPageButton = document.getElementById('prevPage');
    const nextPageButton = document.getElementById('nextPage');

    if (!rowsPerPageSelect || !userTableBody || !prevPageButton || !nextPageButton) {
        console.error('Pagination elements not found.');
    } else {
        let currentPage = 1;
        let rowsPerPage = parseInt(rowsPerPageSelect.value);
        let rows = Array.from(userTableBody.querySelectorAll('tr'));

        function displayRows() {
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            rows.forEach((row, index) => {
                row.style.display = index >= start && index < end ? '' : 'none';
            });

            prevPageButton.disabled = currentPage === 1;
            nextPageButton.disabled = end >= rows.length;
        }

        rowsPerPageSelect.addEventListener('change', () => {
            rowsPerPage = parseInt(rowsPerPageSelect.value);
            currentPage = 1;
            rows = Array.from(userTableBody.querySelectorAll('tr'));
            displayRows();
        });

        prevPageButton.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                displayRows();
            }
        });

        nextPageButton.addEventListener('click', () => {
            if ((currentPage * rowsPerPage) < rows.length) {
                currentPage++;
                displayRows();
            }
        });

        displayRows();
    }
</script>
