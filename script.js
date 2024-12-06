document.getElementById("absensiForm").addEventListener("submit", async function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    // Kirim data ke server menggunakan Fetch API
    const response = await fetch("process.php", {
        method: "POST",
        body: formData,
    });
    const result = await response.json();

    if (result.success) {
        alert("Absensi berhasil!");
        const table = document.getElementById("absensiTable");
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${result.data.nama}</td>
            <td>${result.data.kelas}</td>
            <td><img src="${result.data.foto}" alt="Foto Siswa" width="50"></td>
            <td>${result.data.tanggal}</td>
        `;
        table.prepend(row);
        this.reset();
    } else {
        alert("Gagal menyimpan absensi.");
    }
});