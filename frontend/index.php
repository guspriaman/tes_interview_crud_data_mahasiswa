<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mahasiswa</title>
</head>
<body>
    <h1>Data Mahasiswa</h1>
    <form id="formMahasiswa">
        <input type="hidden" id="id">
        <input type="text" id="nama" placeholder="Nama" required>
        <input type="text" id="nim" placeholder="NIM" required>
        <input type="text" id="jurusan" placeholder="Jurusan" required>
        <button type="submit">Simpan</button>
    </form>
    
    <h2>List Mahasiswa</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="tabelMahasiswa"></tbody>
    </table>

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
                                <button onclick="editMahasiswa(${m.id}, '${m.nama}', '${m.nim}', '${m.jurusan}')">Edit</button>
                                <button onclick="deleteMahasiswa(${m.id})">Hapus</button>
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
            }).then(() => {
                document.getElementById("formMahasiswa").reset();
                getMahasiswa();
            });
        });

        function editMahasiswa(id, nama, nim, jurusan) {
            document.getElementById("id").value = id;
            document.getElementById("nama").value = nama;
            document.getElementById("nim").value = nim;
            document.getElementById("jurusan").value = jurusan;
        }

        function deleteMahasiswa(id) {
            fetch(apiUrl, {
                method: "DELETE",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id })
            }).then(() => getMahasiswa());
        }

        getMahasiswa();
    </script>
</body>
</html>
