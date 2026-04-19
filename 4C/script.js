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
function tampilkanPesan(nama) {
    return "Halo, " + nama + "! Selamat belajar JavaScript 🚀";
}

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
navHome.addEventListener("click", function (e) {
    e.preventDefault();
    showSection(homeSection);
});

navMateri.addEventListener("click", function (e) {
    e.preventDefault();
    showSection(materiSection);
});

navKontak.addEventListener("click", function (e) {
    e.preventDefault();
    showSection(kontakSection);
});

sideHome.addEventListener("click", function (e) {
    e.preventDefault();
    showSection(homeSection);
});

sideMateri.addEventListener("click", function (e) {
    e.preventDefault();
    showSection(materiSection);
});

sideKontak.addEventListener("click", function (e) {
    e.preventDefault();
    showSection(kontakSection);
});

// ================= SIDEBAR =================
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

// ================= EVENT CLICK =================
if (btnPesan && hasil) {
    btnPesan.addEventListener("click", function () {
        hasil.textContent = "Tombol berhasil diklik!";
        hasil.style.color = "blue";
    });
}

// ================= VALIDASI FORM =================
if (formSaya) {
    formSaya.addEventListener("submit", function (e) {
        e.preventDefault();

        let nama = inputNama.value;

        if (nama === "") {
            alert("Nama tidak boleh kosong!");
        } else if (nama.length < 3) {
            alert("Nama minimal 3 karakter!");
        } else {
            hasil.textContent = tampilkanPesan(nama);
            hasil.style.color = "green";
        }
    });
}

// ================= WARNA INTERAKTIF =================
if (inputWarna && teksWarna) {
    inputWarna.addEventListener("input", function () {
        let warna = this.value;
        teksWarna.style.color = warna;

        document.querySelector("header").style.background =
            "linear-gradient(90deg, " + warna + ", #ec4899)";
    });

    teksWarna.addEventListener("click", function () {
        this.textContent = "Teks sudah diklik!";
    });
}

// ================= DEFAULT =================
document.body.classList.add("shift");
showSection(homeSection);