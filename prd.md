# Product Requirements Document (PRD)

## HR Assessment Test System

| Informasi | Detail |
| --- | --- |
| Status | Draft v1.0 |
| Produk | HR Assessment Test System |
| Platform | Web application responsif |
| Bahasa utama | Bahasa Indonesia |
| Teknologi | Laravel, MySQL, Laravel Sanctum, Tailwind CSS, Vite |

## 1. Ringkasan Produk

HR Assessment Test System adalah aplikasi web untuk mengelola proses asesmen kandidat secara end-to-end: mulai dari pengelolaan pengguna, pembuatan bank soal dan paket tes, penyelenggaraan sesi, pengerjaan tes menggunakan token, penilaian jawaban essay, hingga pelaporan hasil.

Sistem memiliki empat peran utama:

| Peran | Peran utama |
| --- | --- |
| Super Admin | Mengelola pengguna dan konfigurasi sistem. |
| HR Admin | Mengelola soal, paket tes, sesi tes, peserta, dan laporan. |
| Candidate | Masuk menggunakan token undangan dan mengerjakan tes. |
| Reviewer | Menilai jawaban essay dan memberikan skor akhir. |

Alur inti produk adalah: Super Admin membuat akun HR, HR Admin menyiapkan kategori dan soal, menyusun paket tes serta sesi tes, mengimpor kandidat dan mengirim token undangan, kandidat mengerjakan tes, Reviewer memeriksa jawaban essay, lalu HR Admin menghasilkan laporan asesmen.

## 2. Latar Belakang dan Masalah

Proses asesmen rekrutmen yang dikerjakan melalui spreadsheet, formulir terpisah, dan komunikasi manual rentan terhadap kesalahan data, sulit dipantau secara real-time, serta memperlambat pengolahan nilai. Produk ini menjadi pusat data asesmen agar pelaksanaan tes terstruktur, aman, terukur, dan mudah diaudit.

## 3. Tujuan Produk

1. Memusatkan pengelolaan soal, kandidat, sesi, dan hasil asesmen dalam satu aplikasi.
2. Memungkinkan kandidat mengikuti tes mandiri melalui tautan/token unik.
3. Mendukung penilaian otomatis untuk soal objektif dan penilaian manual untuk soal essay.
4. Menyediakan status progres dan laporan hasil yang dapat diekspor oleh HR Admin.
5. Menerapkan kontrol akses berbasis peran agar setiap pengguna hanya dapat mengakses fungsi yang relevan.

### Indikator Keberhasilan Awal

- HR Admin dapat membuat dan menjalankan satu sesi tes tanpa bantuan teknis.
- Kandidat dapat memulai, melanjutkan selama sesi aktif, dan mengirimkan tes dengan token valid.
- Nilai objektif dihitung otomatis saat pengumpulan jawaban.
- Reviewer dapat menyelesaikan penilaian essay dan menerbitkan skor akhir.
- HR Admin dapat mengunduh laporan hasil sesi dalam format CSV/XLSX/PDF.

## 4. Ruang Lingkup

### Dalam Ruang Lingkup (MVP)

- Autentikasi dan otorisasi untuk Super Admin, HR Admin, dan Reviewer.
- Akses kandidat melalui tautan undangan dan token unik.
- Manajemen pengguna, profil perusahaan, dan konfigurasi sistem dasar.
- Manajemen kategori soal, bank soal, paket tes, sesi tes, dan kandidat.
- Jenis soal pilihan ganda dan essay.
- Pengaturan durasi, jadwal, batas akses, dan passing grade per paket/sesi.
- Penilaian otomatis pilihan ganda dan penilaian manual essay.
- Dashboard operasional, monitoring progres, laporan sesi/kandidat, serta ekspor data.

### Di Luar Ruang Lingkup MVP

- Integrasi ATS, SSO perusahaan, payroll, atau HRIS pihak ketiga.
- Proctoring berbasis kamera/AI, perekaman layar, dan deteksi kecurangan tingkat lanjut.
- Tes adaptif atau pengacakan berbasis algoritma psikometrik.
- Pembayaran, multi-tenant billing, dan aplikasi mobile native.
- Pembuatan soal otomatis dengan AI.

## 5. Pengguna dan Hak Akses

### 5.1 Super Admin

Super Admin bertanggung jawab atas administrasi dan konfigurasi sistem.

| Fitur | Kebutuhan |
| --- | --- |
| Login dan dashboard | Masuk dengan email dan kata sandi; melihat ringkasan pengguna dan aktivitas sistem. |
| Manajemen pengguna | Membuat, mengubah, menonaktifkan/mengaktifkan, dan menetapkan peran user HR Admin, Reviewer, atau Super Admin lain. |
| Pengaturan sistem | Mengelola profil perusahaan, konfigurasi email, konfigurasi sistem, dan konfigurasi backup. |
| Audit dasar | Melihat riwayat aktivitas penting seperti pembuatan pengguna, perubahan status akun, dan perubahan konfigurasi. |

Super Admin tidak perlu mengelola materi atau hasil tes sehari-hari, kecuali bila akses administratif diperlukan.

### 5.2 HR Admin

HR Admin menjalankan seluruh operasional asesmen.

| Modul | Kebutuhan |
| --- | --- |
| Dashboard | Melihat jumlah paket, sesi aktif, kandidat, status pengerjaan, dan hasil yang menunggu penilaian. |
| Kategori soal | Membuat, mengubah, dan menghapus kategori soal. Kategori aktif dapat dipakai pada bank soal. |
| Bank soal | Membuat, mengubah, menduplikasi, mengarsipkan, mengimpor, dan mengekspor soal. |
| Paket tes | Membuat paket, memilih soal, mengatur urutan/pengacakan, durasi, passing grade, dan status paket. |
| Kandidat | Menambah manual, impor file, melihat data kandidat, riwayat tes, dan status undangan. |
| Sesi tes | Membuat sesi dari paket, menetapkan jadwal, menambahkan kandidat, mengirim/menghasilkan token, memantau progres, dan menutup sesi. |
| Laporan | Melihat dashboard laporan, laporan kandidat dan sesi, lalu mengekspor hasil. |

HR Admin hanya dapat mengubah data asesmen yang berada dalam cakupan organisasinya. Untuk MVP satu perusahaan, seluruh HR Admin berada dalam satu cakupan perusahaan.

### 5.3 Candidate

Candidate tidak memiliki akun administratif. Kandidat masuk melalui tautan undangan dan token yang dikaitkan dengan sesi tes.

| Tahap | Kebutuhan |
| --- | --- |
| Membuka undangan | Kandidat membuka tautan undangan yang diterima. |
| Verifikasi token | Kandidat memasukkan token; sistem memvalidasi status, jadwal, dan batas penggunaan token. |
| Instruksi | Kandidat melihat nama tes, durasi, aturan, serta tombol mulai tes. |
| Mengerjakan | Kandidat menjawab soal dengan navigasi berikutnya/sebelumnya, daftar nomor soal, indikator jawaban, dan timer. |
| Menyimpan | Jawaban disimpan otomatis dan dapat disimpan ulang saat navigasi. |
| Mengirim | Kandidat mengonfirmasi pengiriman. Sistem menolak perubahan setelah tes dikirim. |
| Selesai | Kandidat melihat konfirmasi bahwa tes telah berhasil dikirim. |

### 5.4 Reviewer

Reviewer memeriksa jawaban essay yang telah dikirim kandidat.

| Fitur | Kebutuhan |
| --- | --- |
| Login dan dashboard | Melihat jumlah jawaban essay yang menunggu penilaian, sedang dinilai, dan selesai. |
| Review jawaban essay | Melihat pertanyaan, jawaban kandidat, panduan/rubrik, serta skor maksimal. |
| Penilaian manual | Mengisi skor tiap jawaban essay dan catatan penilaian. |
| Catatan reviewer | Menyimpan catatan internal yang dapat dilihat HR Admin sesuai hak akses. |
| Skor akhir | Memfinalkan penilaian ketika semua jawaban essay kandidat telah diberi nilai. |

Reviewer tidak dapat mengubah soal, paket, kandidat, jadwal sesi, atau jawaban kandidat.

## 6. Alur Pengguna Utama

### 6.1 Alur Persiapan dan Pelaksanaan Tes

1. Super Admin membuat akun HR Admin dan Reviewer, lalu mengatur konfigurasi dasar sistem.
2. HR Admin membuat kategori soal.
3. HR Admin menambahkan atau mengimpor soal ke bank soal.
4. HR Admin membuat paket tes, memilih soal, mengatur durasi, dan menentukan passing grade.
5. HR Admin membuat sesi dari paket tes dan menentukan waktu mulai/akhir.
6. HR Admin menambahkan atau mengimpor kandidat ke sesi.
7. Sistem membuat token unik untuk setiap kandidat; HR Admin mengirim atau membagikan undangan.
8. Kandidat membuka undangan, memvalidasi token, membaca instruksi, dan memulai tes.
9. Kandidat menyimpan jawaban selama tes dan mengirimkan tes sebelum waktu habis.
10. Sistem menghitung nilai soal objektif secara otomatis.
11. Reviewer menilai jawaban essay dan memfinalkan skor.
12. HR Admin melihat dan mengekspor laporan hasil asesmen.

### 6.2 Status Sesi Tes

| Status | Arti | Transisi yang diizinkan |
| --- | --- | --- |
| Draft | Sesi masih disiapkan dan belum dapat diakses kandidat. | Dijadwalkan, dibatalkan. |
| Dijadwalkan | Sesi memiliki jadwal tetapi belum berlangsung. | Aktif, dibatalkan. |
| Aktif | Kandidat dengan token valid dapat memulai atau melanjutkan tes. | Selesai, ditutup manual, dibatalkan. |
| Selesai | Waktu sesi telah berakhir; pengumpulan otomatis dapat diproses. | Dalam penilaian. |
| Dalam penilaian | Ada jawaban essay yang belum difinalkan. | Final. |
| Final | Seluruh nilai telah dihitung/difinalkan dan hasil siap dilaporkan. | Diarsipkan. |
| Dibatalkan/Diarsipkan | Sesi tidak aktif dan hanya dapat dilihat sebagai riwayat. | Tidak ada untuk MVP. |

## 7. Kebutuhan Fungsional

### 7.1 Autentikasi dan Otorisasi

- Sistem menyediakan halaman login untuk Super Admin, HR Admin, dan Reviewer.
- Sistem menggunakan Laravel Sanctum untuk autentikasi sesi/API sesuai kebutuhan arsitektur aplikasi.
- Kata sandi harus disimpan dalam bentuk hash dan tidak pernah ditampilkan kembali.
- Setiap route, API, dan aksi dibatasi menggunakan middleware serta policy berbasis peran.
- Pengguna yang dinonaktifkan tidak dapat masuk atau memakai sesi autentikasi aktif setelah sesi kedaluwarsa/diinvalidasi.
- Sistem menyediakan logout yang mengakhiri sesi autentikasi.

### 7.2 Manajemen Pengguna dan Konfigurasi

- Super Admin dapat membuat user dengan nama, email, peran, dan status aktif.
- Email harus unik dalam sistem.
- Super Admin dapat mengubah data user dan peran, dengan perlindungan agar akun Super Admin terakhir tidak dapat dinonaktifkan.
- **Profil Perusahaan:** Minimal menyimpan nama perusahaan, logo opsional, alamat, nomor telepon, situs web, dan zona waktu.
- **Konfigurasi Email:** Mengatur pengiriman notifikasi/undangan. Pengaturan teknis (SMTP password) disimpan aman melalui `.env`. Antarmuka (UI) hanya mengelola *Nama Pengirim Global* dan fitur opsi *Toggle* untuk secara dinamis menambahkan nama HR yang sedang *login* (contoh: "Rizky (Tim Rekrutmen)").
- **Keamanan & Akses:** Mengatur durasi kedaluwarsa sesi (dalam menit), opsi (*toggle*) wajib menggunakan kata sandi kuat untuk akun baru, serta batas maksimal percobaan login untuk mencegah serangan *brute force*.
- **Konfigurasi Backup:** Mengatur jadwal pencadangan data otomatis (Harian, Mingguan, Bulanan), waktu pelaksanaan backup (jam), retensi data backup, dan opsi pemrosesan *backup* secara manual ("Backup Sekarang").

### 7.3 Kategori dan Bank Soal

- Kategori memiliki nama, deskripsi opsional, dan status aktif.
- Soal memiliki kategori, tipe, pertanyaan, skor maksimal, status, dan pembuat.
- Tipe soal MVP:
  - Pilihan ganda: minimal dua opsi, satu jawaban benar, dan skor otomatis.
  - Essay: instruksi jawaban, skor maksimal, rubrik/panduan penilaian opsional, dan skor manual oleh Reviewer.
- HR Admin dapat melihat pratinjau soal sebelum digunakan dalam paket.
- Soal yang sudah digunakan oleh sesi tidak boleh dihapus permanen; gunakan status arsip/nonaktif agar integritas riwayat terjaga.
- Impor/ekspor bank soal menggunakan template CSV/XLSX yang tervalidasi, termasuk pelaporan baris yang gagal diimpor.

### 7.4 Paket Tes

- Paket tes memiliki nama, deskripsi, status, durasi, passing grade, dan daftar soal.
- HR Admin dapat memilih satu atau beberapa soal yang aktif ke dalam paket.
- Paket menyimpan urutan soal; sistem juga mendukung opsi pengacakan urutan soal untuk kandidat.
- Skor maksimal paket dihitung dari total skor maksimal soal di dalam paket.
- Paket yang telah dipakai pada sesi harus memiliki versi/salinan konfigurasi yang tidak berubah jika bank soal diperbarui setelahnya.
- Paket hanya dapat digunakan untuk membuat sesi bila memiliki minimal satu soal aktif.

### 7.5 Kandidat dan Undangan

- Data kandidat minimal mencakup nama lengkap, email, nomor telepon opsional, dan identitas/referensi kandidat opsional.
- HR Admin dapat menambah kandidat satuan atau melalui impor CSV/XLSX.
- Kandidat dapat ditugaskan ke satu atau beberapa sesi sesuai kebutuhan rekrutmen.
- Sistem menghasilkan token acak, unik, dan sulit ditebak per kandidat per sesi.
- Token menyimpan masa berlaku sesuai jadwal sesi dan tidak boleh dapat digunakan untuk sesi lain.
- HR Admin dapat membuat ulang token; token lama otomatis tidak valid.
- Status undangan minimal: belum dikirim, terkirim, dibuka, dimulai, dikumpulkan, kedaluwarsa, dan dibatalkan.

### 7.6 Sesi Tes dan Monitoring

- Sesi tes dibangun dari satu paket tes dan memiliki nama, jadwal mulai, jadwal akhir, status, serta kandidat peserta.
- HR Admin dapat mengatur instruksi khusus sesi dan apakah kandidat boleh melihat hasil (default: tidak).
- Sistem menolak kandidat memulai tes sebelum waktu mulai atau setelah waktu akhir.
- HR Admin dapat melihat progres per kandidat: belum mulai, sedang mengerjakan, dikumpulkan, waktu habis, dan status penilaian.
- HR Admin dapat menutup sesi secara manual; kandidat yang belum selesai diproses sesuai aturan pengumpulan otomatis.
- Perubahan paket setelah sesi dibuat tidak mengubah daftar soal yang sudah terkunci pada sesi tersebut.

### 7.7 Pengerjaan Tes Kandidat

- Kandidat wajib memasukkan token valid sebelum melihat instruksi dan soal.
- Timer mundur menggunakan batas waktu efektif yang lebih dahulu tercapai antara durasi paket dan jadwal akhir sesi.
- Kandidat dapat berpindah ke soal berikutnya/sebelumnya serta memilih nomor soal dari panel navigasi.
- Navigasi menampilkan status soal: belum dijawab, sudah dijawab, dan soal aktif.
- Jawaban kandidat disimpan otomatis saat input berubah dengan mekanisme tahan gagal (retry) yang aman; tombol simpan manual dapat disediakan sebagai pelengkap.
- Kandidat dapat memperbarui jawaban sampai tes dikirim atau waktu habis.
- Saat timer habis, sistem melakukan pengumpulan otomatis atas jawaban yang sudah tersimpan.
- Sebelum pengumpulan manual, kandidat melihat ringkasan jumlah soal terjawab/belum terjawab dan konfirmasi akhir.
- Setelah pengumpulan, halaman tes menjadi hanya-baca dan kandidat melihat halaman selesai.

### 7.8 Penilaian dan Skor

- Nilai pilihan ganda dihitung otomatis berdasarkan jawaban benar dan bobot/skor soal.
- Jawaban kosong bernilai nol kecuali kebijakan negatif/parsial ditambahkan pada versi berikutnya.
- Reviewer dapat menyimpan draft nilai essay sebelum memfinalkan.
- Reviewer tidak boleh memberi skor di bawah nol atau melebihi skor maksimal soal.
- Sistem mencatat skor, catatan, waktu penilaian, dan reviewer yang memberikan nilai.
- Skor akhir kandidat adalah gabungan skor objektif dan skor essay yang telah difinalkan.
- Status hasil adalah `menunggu_penilaian` bila terdapat essay yang belum selesai dinilai, dan `final` setelah seluruh komponen nilai selesai.
- Kelulusan dihitung terhadap passing grade paket yang disalin ke sesi, bila passing grade diaktifkan.

### 7.9 Pelaporan

- HR Admin dapat melihat ringkasan sesi: jumlah kandidat, status pengerjaan, rata-rata nilai, distribusi kelulusan, dan jumlah hasil menunggu penilaian.
- Laporan kandidat memuat identitas kandidat, sesi, waktu mulai/kumpul, skor objektif, skor essay, skor akhir, status hasil, dan status lulus/gagal.
- Laporan sesi memuat metrik agregat dan daftar kandidat.
- HR Admin dapat memfilter laporan minimal berdasarkan sesi, status pengerjaan, status penilaian, dan rentang tanggal.
- Sistem menyediakan ekspor CSV/XLSX untuk daftar kandidat dan laporan hasil sesuai filter yang diterapkan.
- Skor akhir yang telah difinalkan harus konsisten antara dashboard, detail kandidat, dan file ekspor.

## 8. Aturan Bisnis dan Validasi

1. Hanya Super Admin yang dapat membuat atau mengubah peran pengguna administratif.
2. Hanya HR Admin yang dapat membuat kategori, soal, paket, kandidat, dan sesi.
3. Hanya Reviewer yang dapat memberikan atau memfinalkan penilaian essay.
4. Token berlaku untuk satu kandidat dan satu sesi; token tidak dapat dipakai ulang setelah tes dikumpulkan.
5. Satu kandidat hanya memiliki satu attempt aktif per sesi pada MVP.
6. Jawaban dan konfigurasi soal yang telah digunakan harus dipertahankan sebagai snapshot agar laporan historis tidak berubah.
7. Kandidat tidak dapat mengakses pertanyaan atau jawaban sebelum token dan waktu sesi valid.
8. Sesi hanya dapat diaktifkan bila memiliki paket dan minimal satu kandidat terdaftar.
9. Kandidat hanya dapat mengumpulkan tes sekali; HR Admin tidak dapat mengubah jawaban kandidat setelah pengumpulan.
10. Hasil akhir tidak boleh berstatus final bila masih ada jawaban essay yang belum dinilai.
11. Semua waktu sistem disimpan dalam UTC dan ditampilkan sesuai zona waktu perusahaan/sesi yang dikonfigurasi.

## 9. Data Utama

| Entitas | Data penting | Relasi utama |
| --- | --- | --- |
| User | nama, email, password hash, peran, status | Membuat data dan/atau menilai jawaban. |
| Role | nama peran, hak akses | Dimiliki oleh User. |
| Company Setting | profil perusahaan, zona waktu, pengaturan email | Konfigurasi global aplikasi MVP. |
| Question Category | nama, deskripsi, status | Memiliki banyak Question. |
| Question | tipe, isi, opsi, jawaban benar, skor maksimal, rubrik, status | Milik kategori; dipakai oleh paket/snapshot sesi. |
| Test Package | nama, durasi, passing grade, status, versi | Memiliki banyak soal melalui Package Question. |
| Test Session | paket snapshot, jadwal, instruksi, status | Memiliki banyak Session Candidate dan attempt. |
| Candidate | identitas dan kontak kandidat | Mengikuti banyak sesi. |
| Invitation | token hash, status, masa berlaku, waktu dikirim/dibuka | Menghubungkan Candidate dan Test Session. |
| Test Attempt | waktu mulai/kumpul, status, nilai objektif/essay/akhir | Milik kandidat dan sesi. |
| Answer | snapshot soal, jawaban kandidat, status penilaian, skor, catatan | Milik Test Attempt. |
| Review | reviewer, waktu, skor, catatan, status final | Berkaitan dengan jawaban essay. |
| Audit Log | aktor, aksi, entitas, perubahan, waktu | Riwayat aktivitas administratif penting. |

## 10. Kebutuhan Non-Fungsional

### Keamanan

- Gunakan HTTPS pada lingkungan produksi.
- Simpan password menggunakan hashing bawaan Laravel yang aman.
- Simpan token undangan dalam bentuk hash; tampilkan token plaintext hanya saat dibuat/dikirim bila diperlukan.
- Terapkan CSRF protection untuk web session dan rate limiting pada login, validasi token, serta endpoint penyimpanan jawaban.
- Validasi dan sanitasi semua input; gunakan authorization policy pada aksi sensitif.
- Catat audit log untuk aksi administratif utama dan finalisasi nilai.

### Kinerja dan Keandalan

- Halaman dashboard dan daftar utama ditargetkan merespons dalam ≤ 3 detik pada beban operasional normal.
- Penyimpanan jawaban kandidat ditargetkan terkonfirmasi dalam ≤ 2 detik pada koneksi normal.
- Mekanisme autosave harus idempoten agar retry tidak membuat jawaban ganda.
- Timer dan batas pengumpulan harus divalidasi oleh server; browser hanya menjadi tampilan pendukung.
- Email undangan dan ekspor besar dijalankan melalui Laravel Queue agar tidak menghambat antarmuka pengguna.

### Pengalaman Pengguna dan Aksesibilitas

- Antarmuka responsif untuk desktop, tablet, dan ponsel; pengerjaan tes diprioritaskan nyaman pada desktop dan tablet.
- Gunakan Tailwind CSS untuk sistem desain yang konsisten.
- Setiap aksi destruktif/final memiliki dialog konfirmasi dan pesan status yang jelas.
- Form memiliki label, indikator validasi, dan dapat digunakan dengan keyboard secara wajar.
- Kandidat selalu dapat melihat waktu tersisa dan status jawaban tanpa kehilangan konteks soal aktif.

### Observabilitas dan Backup

- Error aplikasi dicatat menggunakan logging Laravel tanpa menyimpan password, token plaintext, atau jawaban sensitif secara tidak perlu.
- Super Admin dapat mengatur kebijakan backup; implementasi produksi minimal mencakup backup database terjadwal dan prosedur pemulihan terdokumentasi.

## 11. Kebutuhan Teknis

| Area | Keputusan |
| --- | --- |
| Backend | Laravel versi stabil yang didukung saat implementasi dimulai. |
| Database | MySQL dengan foreign key, index pada token/status/sesi/kandidat, dan migration Laravel. |
| Autentikasi | Laravel Sanctum untuk autentikasi aplikasi web/API; middleware dan policy untuk RBAC. |
| Frontend | Blade atau SPA/inertia-compatible view di atas Laravel, Tailwind CSS, dan Vite. Pilihan pendekatan UI diputuskan sebelum sprint implementasi. |
| Background job | Laravel Queue untuk email undangan, pembuatan ekspor, dan pekerjaan terjadwal yang relevan. |
| Notifikasi | Email untuk undangan kandidat dan, bila dibutuhkan, pemberitahuan hasil penilaian. |
| File | Laravel Storage untuk logo perusahaan dan berkas impor/ekspor, dengan validasi tipe dan ukuran. |

### Prinsip API

- Endpoint API mengikuti versi, misalnya `/api/v1`.
- Response menggunakan format JSON yang konsisten dengan status HTTP yang sesuai.
- API administratif memerlukan token/session Sanctum dan otorisasi per peran.
- Endpoint kandidat menggunakan token undangan yang divalidasi secara ketat, dengan akses minimum terhadap data sesi.
- Endpoint kritis: autentikasi, pengguna, kategori, soal, paket, sesi, kandidat, undangan, attempt/jawaban, review, dan laporan/ekspor.

## 12. Kriteria Penerimaan MVP

### Super Admin

- [ ] Dapat membuat HR Admin dan Reviewer, mengubah statusnya, serta menetapkan peran.
- [ ] Dapat memperbarui profil perusahaan dan konfigurasi dasar.
- [ ] User yang dinonaktifkan tidak dapat login.

### HR Admin

- [ ] Dapat membuat kategori, soal pilihan ganda, dan soal essay.
- [ ] Dapat membuat paket berisi soal, durasi, dan passing grade.
- [ ] Dapat membuat sesi terjadwal, menambahkan kandidat, dan menghasilkan token unik.
- [ ] Dapat melihat progres kandidat dan status setiap hasil.
- [ ] Dapat mengunduh laporan kandidat/sesi dalam CSV atau XLSX.

### Candidate

- [ ] Token valid membuka instruksi hanya pada jadwal sesi yang diizinkan.
- [ ] Kandidat dapat menjawab, berpindah nomor soal, dan jawaban tersimpan sebelum submit.
- [ ] Timer habis menyebabkan jawaban tersimpan dikumpulkan otomatis.
- [ ] Kandidat tidak dapat mengubah jawaban setelah submit atau waktu habis.

### Reviewer

- [ ] Dapat melihat antrean jawaban essay yang ditugaskan/tersedia untuk dinilai.
- [ ] Dapat mengisi nilai dan catatan dalam rentang skor yang valid.
- [ ] Finalisasi nilai essay memperbarui skor akhir kandidat dan status hasil bila seluruh penilaian selesai.

### Sistem

- [ ] Soal objektif dihitung otomatis secara benar saat attempt dikumpulkan.
- [ ] Role-based access mencegah akses lintas peran terhadap aksi sensitif.
- [ ] Snapshot paket/soal membuat hasil sesi lama tetap konsisten setelah bank soal diubah.
- [ ] Semua aksi utama menampilkan validasi dan pesan kegagalan yang dapat dipahami pengguna.

## 13. Risiko dan Mitigasi

| Risiko | Dampak | Mitigasi |
| --- | --- | --- |
| Koneksi kandidat terputus saat tes | Jawaban hilang atau kandidat panik. | Autosave, retry idempoten, dan status penyimpanan yang jelas. |
| Token tersebar ke pihak lain | Akses tes tidak sah. | Token acak berentropi tinggi, masa berlaku, satu attempt, rate limiting, dan regenerasi token. |
| Perubahan soal memengaruhi hasil lama | Laporan historis tidak akurat. | Snapshot soal dan paket saat sesi dibuat/attempt dimulai. |
| Penilaian essay terlambat | Hasil belum bisa dirilis. | Dashboard antrean Reviewer, status penilaian, dan filter prioritas sesi. |
| Waktu browser dimanipulasi | Pengumpulan melewati batas. | Server menjadi sumber kebenaran untuk waktu dan finalisasi attempt. |

## 14. Tahapan Implementasi yang Disarankan

1. Fondasi: proyek Laravel, database, Sanctum, RBAC, layout Tailwind/Vite, dan audit log dasar.
2. Administrasi: manajemen pengguna, profil perusahaan, kategori, serta bank soal.
3. Operasional HR: paket tes, kandidat, impor, sesi, dan token undangan.
4. Pengalaman kandidat: validasi token, instruksi, timer, autosave, navigasi, dan submit otomatis/manual.
5. Review dan laporan: penilaian essay, skor akhir, dashboard monitoring, ekspor CSV/XLSX.
6. Hardening: pengujian role/authorization, uji alur timer, rate limiting, queue, backup, dan uji penerimaan.

## 15. Keputusan yang Perlu Ditetapkan Sebelum Implementasi

- Apakah setiap sesi dapat memiliki lebih dari satu Reviewer atau cukup satu Reviewer per jawaban/kandidat?
- Apakah skor akhir merupakan total poin mentah atau nilai persentase 0–100?
- Apakah kandidat boleh melanjutkan tes dari perangkat lain selama token masih valid?
- Apakah hasil/kelulusan perlu ditampilkan kepada kandidat setelah finalisasi?
- Apa format dan field baku untuk impor kandidat serta bank soal?
- Apakah jawaban essay harus melalui proses moderasi/approval kedua sebelum nilai final?

