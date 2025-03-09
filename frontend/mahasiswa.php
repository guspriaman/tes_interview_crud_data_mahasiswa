<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Mahasiswa_baru</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="style.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h1 class="text-center mb-4">Data Mahasiswa</h1>

    <!-- Tombol Tambah Data -->
    <button class="btn btn-success mb-3" onclick="addMahasiswa_baru()">Tambah Data</button>

    <!-- Tabel Mahasiswa_baru -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Jurusan</th>
                <th>Jenis Kelamin</th> <!-- Tambahkan kolom gender -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="tabelMahasiswa_baru"></tbody>
    </table>

    <!-- Modal Form Edit/Tambah Mahasiswa_baru -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Edit Mahasiswa_baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formMahasiswa_baru">
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
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label><br>
                            <input type="radio" id="male" name="gender" value="Male" required>
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="Female" required>
                            <label for="female">Female</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        const apiUrl = "http://localhost/tes_interview_crud_data_mahasiswa/backend/api_mahasiswa.php";

        function getMahasiswa_baru() {
            fetch(apiUrl)
                .then(res => res.json())
                .then(data => {
                    let rows = "";
                    data.forEach(m => {
                        rows += `<tr>
                        <td>${m.nama}</td>
                        <td>${m.nim}</td>
                        <td>${m.jurusan}</td>
                        <td>${m.jenis_kelamin}</td> <!-- Sesuai dengan backend -->
                        <td>
                            <button class='btn btn-primary btn-sm' onclick="editMahasiswa_baru(${m.id}, '${m.nama}', '${m.nim}', '${m.jurusan}', '${m.jenis_kelamin}')">Edit</button>
                            <button class='btn btn-danger btn-sm' onclick="confirmDelete(${m.id})">Hapus</button>
                        </td>
                    </tr>`;
                    });
                    document.getElementById("tabelMahasiswa_baru").innerHTML = rows;
                });
        }

        document.getElementById("formMahasiswa_baru").addEventListener("submit", function(e) {
            e.preventDefault();
            let id = document.getElementById("id").value;
            let nama = document.getElementById("nama").value;
            let nim = document.getElementById("nim").value;
            let jurusan = document.getElementById("jurusan").value;
            let jenis_kelamin = document.querySelector('input[name="gender"]:checked').value; // Sesuaikan dengan backend
            let method = id ? "PUT" : "POST";

            fetch(apiUrl, {
                    method: method,
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id,
                        nama,
                        nim,
                        jurusan,
                        jenis_kelamin
                    }) // Sesuaikan dengan backend
                })
                .then(res => res.json())
                .then(response => {
                    alert(response.message);
                    document.getElementById("formMahasiswa_baru").reset();
                    getMahasiswa_baru();
                    bootstrap.Modal.getInstance(document.getElementById("editModal")).hide();
                });
        });

        function editMahasiswa_baru(id, nama, nim, jurusan, jenis_kelamin) {
            document.getElementById("modalTitle").innerText = "Edit Mahasiswa_baru";
            document.getElementById("id").value = id;
            document.getElementById("nama").value = nama;
            document.getElementById("nim").value = nim;
            document.getElementById("jurusan").value = jurusan;

            if (jenis_kelamin === "Male") {
                document.getElementById("male").checked = true;
            } else {
                document.getElementById("female").checked = true;
            }

            new bootstrap.Modal(document.getElementById("editModal")).show();
        }

        function addMahasiswa_baru() {
            document.getElementById("modalTitle").innerText = "Tambah Mahasiswa_baru";
            document.getElementById("formMahasiswa_baru").reset();
            document.getElementById("id").value = "";
            new bootstrap.Modal(document.getElementById("editModal")).show();
        }

        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus Mahasiswa_baru ini?")) {
                deleteMahasiswa_baru(id);
            }
        }

        function deleteMahasiswa_baru(id) {
            fetch(apiUrl, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id
                    })
                })
                .then(res => res.json())
                .then(response => {
                    alert(response.message);
                    getMahasiswa_baru();
                });
        }

        getMahasiswa_baru();
    </script>

    <script src="frontend/js/navbar.js"></script>
</body>
<?php include 'footer.php'; ?>

</html>