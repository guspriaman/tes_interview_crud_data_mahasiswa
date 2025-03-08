
<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Mahasiswa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h1 class="text-center mb-4">Data Mahasiswa</h1>
    
    <!-- Tabel Mahasiswa -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="tabelMahasiswa"></tbody>
    </table>
    
    <!-- Modal Form Edit Mahasiswa -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formMahasiswa">
                        <input type="hidden" id="id">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" id="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" id="nim" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jurusan</label>
                            <input type="text" id="jurusan" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        const apiUrl = "http://localhost/tes_interview_crud_data_mahasiswa/backend/api.php";
        
        function getMahasiswa() {
            fetch(apiUrl)
                .then(res => res.json())
                .then(data => {
                    let rows = "";
                    data.forEach(m => {
                        rows += `<tr>
                            <td>${m.nama}</td>
                            <td>${m.nim}</td>
                            <td>${m.jurusan}</td>
                            <td>
                                <button class='btn btn-primary btn-sm' onclick="editMahasiswa(${m.id}, '${m.nama}', '${m.nim}', '${m.jurusan}')">Edit</button>
                                <button class='btn btn-danger btn-sm' onclick="confirmDelete(${m.id})">Hapus</button>
                            </td>
                        </tr>`;
                    });
                    document.getElementById("tabelMahasiswa").innerHTML = rows;
                });
        }

        document.getElementById("formMahasiswa").addEventListener("submit", function(e) {
            e.preventDefault();
            let id = document.getElementById("id").value;
            let nama = document.getElementById("nama").value;
            let nim = document.getElementById("nim").value;
            let jurusan = document.getElementById("jurusan").value;
            let method = id ? "PUT" : "POST";

            fetch(apiUrl, {
                method: method,
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id, nama, nim, jurusan })
            }).then(res => res.json())
              .then(response => {
                  alert(response.message);
                  document.getElementById("formMahasiswa").reset();
                  getMahasiswa();
                  bootstrap.Modal.getInstance(document.getElementById("editModal")).hide();
              });
        });

        function editMahasiswa(id, nama, nim, jurusan) {
            document.getElementById("id").value = id;
            document.getElementById("nama").value = nama;
            document.getElementById("nim").value = nim;
            document.getElementById("jurusan").value = jurusan;
            new bootstrap.Modal(document.getElementById("editModal")).show();
        }

        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus mahasiswa ini?")) {
                deleteMahasiswa(id);
            }
        }

        function deleteMahasiswa(id) {
            fetch(apiUrl, {
                method: "DELETE",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id })
            }).then(res => res.json())
              .then(response => {
                  alert(response.message);
                  getMahasiswa();
              });
        }

        getMahasiswa();
    </script>
</body>
<?php include 'footer.php'; ?>
</html>
