console.log("JS AKTIF");
// ================= VARIABEL =================
let isOpen = true;

const sidebar = document.querySelector("#sidebar");
const toggleBtn = document.querySelector("#toggleBtn");

const navHome = document.querySelector("#navHome");
const navMateri = document.querySelector("#navMateri");
const navKontak = document.querySelector("#navKontak");

const sideHome = document.querySelector("#sideHome");
const sideMateri = document.querySelector("#sideMateri");
const sideKontak = document.querySelector("#sideKontak");

const homeSection = document.querySelector("#homeSection");
const materiSection = document.querySelector("#materiSection");
const kontakSection = document.querySelector("#kontakSection");

const formSaya = document.querySelector("#formSaya");
const inputNama = document.querySelector("#nama");
const inputWarna = document.querySelector("#warna");
const teksWarna = document.querySelector("#teksWarna");

const btnPesan = document.querySelector("#btnPesan");
const hasil = document.querySelector("#hasil");

// ================= FUNGSI =================
function hideAllSections() {
    homeSection.style.display = "none";
    materiSection.style.display = "none";
    kontakSection.style.display = "none";
}

function showSection(section) {
    hideAllSections();

    if (section === materiSection) {
        section.style.display = "grid";
    } else {
        section.style.display = "grid";
    }
}

// ================= NAVIGASI =================
if (navHome) {
    navHome.addEventListener("click", function (e) {
        e.preventDefault();
        showSection(homeSection);
    });
}

if (navMateri) {
    navMateri.addEventListener("click", function (e) {
        e.preventDefault();
        showSection(materiSection);
    });
}

if (navKontak) {
    navKontak.addEventListener("click", function (e) {
        e.preventDefault();
        showSection(kontakSection);
    });
}

if (sideHome) {
    sideHome.addEventListener("click", function (e) {
        e.preventDefault();
        showSection(homeSection);
    });
}

if (sideMateri) {
    sideMateri.addEventListener("click", function (e) {
        e.preventDefault();
        showSection(materiSection);
    });
}

if (sideKontak) {
    sideKontak.addEventListener("click", function (e) {
        e.preventDefault();
        showSection(kontakSection);
    });
}

// ================= SIDEBAR =================
if (toggleBtn && sidebar) {
    toggleBtn.addEventListener("click", function () {
        sidebar.classList.toggle("collapsed");

        if (isOpen) {
            document.body.classList.remove("shift");
            document.body.classList.add("shift-collapsed");
        } else {
            document.body.classList.add("shift");
            document.body.classList.remove("shift-collapsed");
        }

        isOpen = !isOpen;
    });
}

// ================= EVENT CLICK =================
if (btnPesan && hasil) {
    btnPesan.addEventListener("click", function () {
        hasil.textContent = "web ini adalah tugas praktikum pemograman web!";
        hasil.style.color = "blue";
    });
}

// ================= VALIDASI FORM =================
if (formSaya) {
    formSaya.addEventListener("submit", function (e) {
        let nama = inputNama.value;

        if (nama === "") {
            e.preventDefault();
            alert("Nama tidak boleh kosong!");
        } else if (nama.length < 3) {
            e.preventDefault();
            alert("Nama minimal 3 karakter!");
        }
    });
}

// ================= DEFAULT =================
document.body.classList.add("shift");
showSection(homeSection);

// Gunakan event delegation agar lebih kuat
document.addEventListener("input", function (e) {
    // Memastikan yang digeser adalah input dengan ID 'warna'
    if (e.target && e.target.id === "warna") {
        const targetText = document.getElementById("teksWarna");
        if (targetText) {
            // Ubah warna secara langsung
            targetText.style.color = e.target.value;
            // Tambahan: tampilkan di console untuk memastikan JS jalan
            console.log("Warna berhasil diubah ke: " + e.target.value);
        }
    }
});