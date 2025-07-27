// Fungsi untuk memuat daftar provinsi saat halaman dimuat
function loadProvinsi() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "/api/provinsi");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let provinsi = JSON.parse(xhr.responseText);
            let provinsiSelect = document.getElementById("provinsi");

            // Reset option awal
            provinsiSelect.innerHTML = '<option value="" disabled selected>--Pilih Provinsi--</option>';

            for (let i = 0; i < provinsi.length; i++) {
                let option = document.createElement("option");
                option.value = provinsi[i].id;
                option.text = provinsi[i].name;
                provinsiSelect.add(option);
            }
        }
    };
    xhr.send();
}

// Fungsi untuk memuat daftar kabupaten/kota berdasarkan ID provinsi yang dipilih
function loadKabkot(id) {

    console.log("provinsi :", id)

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "/api/kabkot/" + id);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let kabkot = JSON.parse(xhr.responseText);
            let kabkotSelect = document.getElementById("kabkot");

            // Reset option awal
            kabkotSelect.innerHTML = '<option value="" disabled selected>--Pilih Kota/Kabupaten--</option>';

            for (let i = 0; i < kabkot.length; i++) {
                let option = document.createElement("option");
                option.value = kabkot[i].id;
                option.text = kabkot[i].name;
                kabkotSelect.add(option);
            }
        }
    };
    xhr.send();
}

// Panggil loadProvinsi() saat halaman selesai dimuat
document.addEventListener("DOMContentLoaded", function () {
    loadProvinsi();
});
