document.addEventListener("DOMContentLoaded", function () {
    // Event listener untuk tombol + dan -
    document.addEventListener("click", function (event) {
        let row = event.target.closest("tr");
        if (!row) return;

        let quantityInput = row.querySelector(".quantity");
        let hargaSatuan = parseInt(row.dataset.harga);
        let checkbox = row.querySelector(".check-item");

        if (event.target.classList.contains("decrement")) {
            let value = parseInt(quantityInput.value);
            if (value > 1) {
                quantityInput.value = value - 1;
            }
        }

        if (event.target.classList.contains("increment")) {
            let value = parseInt(quantityInput.value);
            quantityInput.value = value + 1;
        }

        updateTotalHarga();
    });

    // Event listener untuk checkbox produk
    document.addEventListener("change", function (event) {
        if (event.target.classList.contains("check-item")) {
            updateTotalHarga();
        }

        if (event.target.id === "select-all" || event.target.id === "select-all-footer") {
            let checked = event.target.checked;
            document.querySelectorAll(".check-item").forEach(item => {
                item.checked = checked;
            });

            // Sinkronkan kedua "Pilih Semua"
            document.querySelector("#select-all").checked = checked;
            document.querySelector("#select-all-footer").checked = checked;

            updateTotalHarga();
        }
    });

    function updateTotalHarga() {
        let totalHarga = 0;
        let totalProduk = 0;

        document.querySelectorAll(".check-item:checked").forEach(checkbox => {
            let row = checkbox.closest("tr");
            let quantity = parseInt(row.querySelector(".quantity").value);
            let hargaSatuan = parseInt(row.dataset.harga);

            totalHarga += hargaSatuan * quantity;
            totalProduk += quantity;
        });

        // Update tampilan total di checkout
        document.querySelector(".total-harga").textContent = `Rp ${totalHarga.toLocaleString('id-ID')}`;
        document.querySelector(".total-produk").textContent = totalProduk;
    }
});
