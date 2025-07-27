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
                option.value = provinsi[i].name; // Value diisi dengan NAMA
                option.setAttribute("data-id", provinsi[i].id); // Simpan ID di atribut data-id
                option.text = provinsi[i].name;
                provinsiSelect.add(option);
            }
        }
    };
    xhr.send();
}

// Fungsi untuk memuat daftar kabupaten/kota berdasarkan ID provinsi yang dipilih
function loadKabkot(select) {
    let id = select.options[select.selectedIndex].getAttribute("data-id");
    console.log("Provinsi terpilih:", id);

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
                option.value = kabkot[i].name; // Value diisi dengan NAMA
                option.setAttribute("data-id", kabkot[i].id); // Simpan ID di atribut data-id
                option.text = kabkot[i].name;
                kabkotSelect.add(option);
            }

            // Reset kecamatan saat provinsi berubah
            document.getElementById("kecamatan").innerHTML = '<option value="" disabled selected>--Pilih Kecamatan--</option>';
            document.getElementById("kelurahan").innerHTML = '<option value="" disabled selected>--Pilih Kelurahan--</option>';
        }
    };
    xhr.send();
}

// Fungsi untuk memuat daftar kecamatan berdasarkan ID kabupaten/kota yang dipilih
function loadKecamatan(select) {
    let id = select.options[select.selectedIndex].getAttribute("data-id");
    console.log("Kabupaten/Kota terpilih:", id);

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "/api/kecamatan/" + id);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let kecamatan = JSON.parse(xhr.responseText);
            let kecamatanSelect = document.getElementById("kecamatan");

            // Reset option awal
            kecamatanSelect.innerHTML = '<option value="" disabled selected>--Pilih Kecamatan--</option>';

            for (let i = 0; i < kecamatan.length; i++) {
                let option = document.createElement("option");
                option.value = kecamatan[i].name; // Value diisi dengan NAMA
                option.setAttribute("data-id", kecamatan[i].id); // Simpan ID di atribut data-id
                option.text = kecamatan[i].name;
                kecamatanSelect.add(option);
            }

            document.getElementById("kelurahan").innerHTML = '<option value="" disabled selected>--Pilih Kelurahan--</option>';
        }
    };
    xhr.send();
}

// Fungsi untuk memuat daftar kelurahan berdasarkan ID kecamatan yang dipilih
function loadKelurahan(select) {
    let id = select.options[select.selectedIndex].getAttribute("data-id");
    console.log("Kecamatan terpilih:", id);

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "/api/kelurahan/" + id);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let kelurahan = JSON.parse(xhr.responseText);
            let kelurahanSelect = document.getElementById("kelurahan");

            // Reset option awal
            kelurahanSelect.innerHTML = '<option value="" disabled selected>--Pilih Kelurahan--</option>';

            for (let i = 0; i < kelurahan.length; i++) {
                let option = document.createElement("option");
                option.value = kelurahan[i].name; // Value diisi dengan NAMA
                option.setAttribute("data-id", kelurahan[i].id); // Simpan ID di atribut data-id
                option.text = kelurahan[i].name;
                kelurahanSelect.add(option);
            }
        }
    };
    xhr.send();
}

// Panggil loadProvinsi() saat halaman selesai dimuat
document.addEventListener("DOMContentLoaded", function () {
    loadProvinsi();
});
