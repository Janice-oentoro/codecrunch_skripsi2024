<x-layout>
    <div class="register-body">
        <div class="register-container">
            <div class="register-image-container">
                <img src="{{ asset('storage/images/signup_illus 1.png') }}" alt="Placeholder Image">
            </div>
            <div class="register-form-container">
            <h3 class="row mb-3 justify-content-center"
            style="font-weight: bold; color: white;">REGISTER</h3>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div>
                        <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div>
                        <input id="phone" type="text" placeholder="Phone Number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <select class="form-select" id="role" name="role" required focus>
                            <option value="" disabled selected>Role</option>
                            <option value="user">User</option>
                            <option value="consultant">Consultant</option>
                        </select>
                    </div>

                    <a class="mb-3" href="" data-bs-toggle="modal" data-bs-target="#termsandconditions">Terms and Conditions</a>

                    <div class="register-button">
                        <button type="submit" class="form-control">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- TERMS AND CONDITIONS MODAL --> 
<!-- ADD CONSULTATION MODAL -->
<div class="modal fade" id="termsandconditions" tabindex="-1" aria-labelledby="termsandconditions" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="termsandconditions">Terms and Conditions</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
            <p>
            SYARAT DAN KETENTUAN PENGGUNAAN CODECRUNCH
            </p>
            <p>
            MOHON UNTUK MEMBACA SELURUH SYARAT DAN KETENTUAN PENGGUNAAN CODECRUNCH SERTA KEBIJAKAN PRIVASI 
            CODECRUNCH DENGAN CERMAT DAN SEKSAMA SEBELUM MENGGUNAKAN SETIAP FITUR DAN/ATAU LAYANAN YANG TERSEDIA DALAM 
            PLATFORM CODECRUNCH. 
            </p>
            <p>
            Berikut adalah Syarat dan Ketentuan Penggunaan Platform CodeCrunch ("Syarat dan Ketentuan") berisi semua 
            peraturan dan ketentuan yang secara otomatis mengikat ketika Anda melakukan kunjungan, mengunduh, memasang, 
            menggunakan Platform CodeCrunch dan/atau menikmati semua fitur dan fasilitas yang disediakan pada Platform 
            CodeCrunch. Silakan membaca dengan seksama seluruh konten Syarat dan Ketentuan untuk dapat memahami batasan 
            hak dan kewajiban Anda sebagai Pengguna Platform CodeCrunch. Bilamana tidak setuju dengan konten Syarat dan 
            Ketentuan ini, Anda dapat berhenti mengakses Platform CodeCrunch.
            </p>
            <p>
            Syarat dan Ketentuan ini dapat Kami perbaharui dari waktu ke waktu. Pembaruan tersebut akan berlaku setelah 
            Kami tampilkan pada Platform CodeCrunch. Tanggung jawab Anda untuk meninjau Syarat dan Ketentuan secara berkala. 
            Keberlanjutan Anda atas penggunaan Platform CodeCrunch setelah adanya setiap pembaharuan tersebut, secara 
            otomatis mengikat Anda. 
            </p>
            <p>
            Apabila Anda tidak setuju terhadap salah satu, sebagian, atau seluruh isi yang tertuang dalam Syarat dan Ketentuan ini, Anda 
            dapat berhenti mengakses Platform CodeCrunch.
            </p>
            <p>
            1. DEFINISI
<br>•	CodeCrunch atau Kami adalah PT x suatu perseroan terbatas yang didirikan berdasarkan hukum negara Republik Indonesia, beralamat di Jl. x
<br>•	Afiliasi merupakan (i) pihak pengendali dari; (ii) anak perusahaan dari; atau (iii) pihak-pihak yang berada di bawah satu kendali PT x.
<br>•	Layanan CodeCrunch terdiri dari fitur-fitur seperti Chat dengan IT Expert, Buat Janji Video Call, dan Layanan Home yang ditawarkan kepada Pengguna melalui Platform CodeCrunch yang dapat Kami tambahkan, ubah dan/atau perbaharui dari waktu ke waktu yang diatur pada Pasal 6 Syarat dan Ketentuan ini. 
<br>•	Platform CodeCrunch adalah sistem yang ada di halaman situs web dengan alamat domain https://codecrunch.site/ yang dikelola oleh CodeCrunch. 
<br>•	Pengguna atau Anda adalah setiap orang atau badan hukum yang menggunakan dan menikmati semua fitur dan fasilitas yang disediakan pada Platform CodeCrunch dan/atau Layanan CodeCrunch.
<br>•	Catatan Expert adalah catatan hasil sesi percakapan dengan Penyedia Layanan dan saran-saran terkait dengan kondisi Pengguna. 
<br>•	Harga Layanan adalah tarif atas Layanan CodeCrunch yang tercantum pada Platform CodeCrunch yang akan ditanggung oleh Pengguna termasuk namun tidak terbatas pada Biaya Layanan, dan biaya-biaya lain yang ditetapkan CodeCrunch. Untuk menghindari keraguan, Harga Layanan yang tercantum pada Platform CodeCrunch sudah termasuk Pajak Pertambahan Nilai (“PPN”).
<br>•	Biaya Layanan adalah biaya atas penyediaan layanan yang akan diperoleh oleh Penyedia Layanan yang dalam hal ini ditetapkan oleh CodeCrunch dan/atau Penyedia Layanan dan ditanggung oleh Pengguna. 

            </p>
            <p>
            2. KETENTUAN UMUM
<br>•	Platform CodeCrunch berfungsi sebagai sarana untuk menghubungkan Pengguna, Penyedia Layanan, sebagaimana yang ditentukan oleh CodeCrunch dari waktu ke waktu. 
<br>•	Pengguna memahami bahwa kerjasama antara CodeCrunch dan Penyedia Layanan bukan merupakan hubungan karyawan, akan tetapi hubungan kerja sama yang dijalin berdasarkan profesionalisme. CodeCrunch tidak mempekerjakan Penyedia Layanan dan CodeCrunch tidak bertanggung jawab atas tindakan, kecerobohan, kelalaian, dan/atau kelengahan Penyedia Layanan dalam memberikan Layanan CodeCrunch. Platform CodeCrunch merupakan layanan informasi dan komunikasi online yang disediakan oleh CodeCrunch.
<br>•	Platform CodeCrunch memungkinkan Anda untuk mengirimkan permintaan atas Layanan CodeCrunch kepada Penyedia Layanan. Penyedia Layanan memiliki kebijakan sendiri dan kewenangan penuh untuk menerima atau menolak setiap permintaan Anda atas Layanan CodeCrunch. Jika Penyedia Layanan menerima permintaan Anda, Platform CodeCrunch akan memberitahu Anda dan memberikan informasi mengenai Penyedia Layanan, termasuk nomor pesanan dan kemampuan untuk menghubungi Penyedia Layanan melalui telepon. 
<br>•	Setiap fitur dan/atau Layanan CodeCrunch yang tersedia pada Platform CodeCrunch dapat diperbarui atau diubah sesuai dengan kebutuhan dan perkembangan Platform CodeCrunch. 
            </p>

            <p>
            3. KEBIJAKAN PRIVASI
<br>•	Anda dapat menggunakan Platform CodeCrunch dengan terlebih dahulu melakukan pendaftaran yang disertai pemberian informasi data pribadi Anda, termasuk namun tidak terbatas pada nama lengkap, alamat email, nomor ponsel Anda, dan setiap informasi Anda yang akurat dan dapat dipertanggungjawabkan secara hukum sebagaimana diminta dalam Platform CodeCrunch (“Data Pribadi”). Data Pribadi yang diproses akan dikumpulkan, disimpan, diolah, digunakan dan dibagikan oleh Kami dan/atau Penyedia Layanan untuk pemberian Layanan CodeCrunch dan untuk tujuan lain yang telah diatur dalam Kebijakan Privasi (“Kebijakan Privasi”), yang merupakan bagian yang tidak terpisahkan dari Syarat dan Ketentuan ini dan dapat Kami perbarui dari waktu ke waktu. Anda sebagai Pengguna mengerti dan setuju bahwa Syarat dan Ketentuan ini merupakan perjanjian dalam bentuk elektronik dan tindakan Anda menekan tombol ‘daftar’ saat pembukaan akun di Platform CodeCrunch atau tombol ‘masuk’ saat akan mengakses akun Anda merupakan persetujuan aktif Anda untuk mengikatkan diri dalam perjanjian dengan Kami sehingga keberlakuan Syarat dan Ketentuan ini dan Kebijakan Privasi adalah sah dan mengikat secara hukum dan terus berlaku sepanjang penggunaan Platform CodeCrunch dan Layanan CodeCrunch oleh Anda. 
<br>•	Jika Anda menggunakan Platform CodeCrunch atas nama individu selain diri Anda sendiri, Anda menyatakan bahwa Anda diberi wewenang oleh individu tersebut untuk bertindak atas nama individu tersebut dan bahwa individu tersebut mengakui praktik dan kebijakan yang diuraikan dalam Kebijakan Privasi.
<br>•	Anda tidak akan mengajukan tuntutan atau keberatan apapun terhadap keabsahan dari Syarat dan Ketentuan ini atau Kebijakan Privasi yang dibuat dalam bentuk elektronik.
<br>•	Anda mengerti dan setuju bahwa Ketentuan Penggunaan ini merupakan perjanjian dalam bentuk elektronik dan tindakan Anda menekan tombol ‘daftar’ saat pembukaan akun atau tombol ‘masuk’ saat akan mengakses akun Anda merupakan persetujuan aktif Anda untuk mengikatkan diri dalam perjanjian dengan Kami sehingga keberlakuan Ketentuan Penggunaan ini dan Pemberitahuan Privasi adalah sah dan mengikat secara hukum dan terus berlaku sepanjang penggunaan Aplikasi CodeCrunch dan Layanan CodeCrunch oleh Anda. 
            </p>

            <p>
            4. KETENTUAN PENGGUNAAN PLATFORM CODECRUNCH
<br>•	Dengan senang hati Kami mempersilahkan Anda mendaftar sebagai Pengguna Platform CodeCrunch, setelah memenuhi persyaratan umum berikut:
<br>•	Anda adalah individu yang memiliki hak untuk mengadakan perjanjian yang mengikat berdasarkan hukum Negara Republik Indonesia dan bahwa Anda telah berusia minimal 21 (dua puluh satu) tahun atau sudah menikah dan tidak berada di bawah perwalian atau pengampuan;
<br>•	Jika Anda berusia di bawah 21 (dua puluh satu) tahun dan belum menikah, Anda menyatakan dan menjamin bahwa Anda telah memperoleh izin dari orang tua atau wali hukum Anda, kecuali Anda menyatakan sebaliknya. Dengan memberikan persetujuan, orang tua atau wali hukum Anda setuju untuk bertanggung jawab atas: (i) semua tindakan Anda terkait akses ke dan penggunaan Platform CodeCrunch dan/atau Layanan CodeCrunch; (ii) biaya apa pun terkait penggunaan Anda atas Layanan CodeCrunch apa pun; dan (iii) kepatuhan Anda terhadap Syarat dan Ketentuan ini;
<br>•	Anda adalah badan hukum/badan usaha dengan legalitas sebagaimana disyaratkan oleh Kami dan hukum dan peraturan yang berlaku di wilayah hukum yang sah. Jika Anda mendaftarkan atas nama suatu badan usaha, Anda juga menyatakan bahwa Anda berwenang untuk bertindak untuk dan atas nama badan hukum tersebut dan untuk mengadakan dan mengikatkan badan hukum/entitas tersebut pada Syarat dan Ketentuan; 
<br>•	Anda menyatakan bukan individu dan/atau badan hukum yang dilarang oleh hukum negara Republik Indonesia untuk menerima atau menggunakan Layanan CodeCrunch;
<br>•	Anda menyatakan bahwa perjanjian dengan CodeCrunch, tidak melanggar ketentuan, perjanjian, hak dan kewajiban lainnya dengan suatu pihak ketiga; dan/atau
<br>•	Anda menyatakan bahwa semua informasi dan/atau dokumen yang Anda isi atau sampaikan kepada CodeCrunch adalah akurat, benar, lengkap, terkini, dan sesuai.
<br>•	Kami memiliki hak untuk setiap saat melakukan pemeriksaan terkait kebenaran, keabsahan informasi atau dokumen yang diserahkan kepada CodeCrunch atau Platform CodeCrunch. Bilamana ditemukan penipuan atau ketidaksesuaian berdasarkan penilaian independen, CodeCrunch berhak mengakhiri, membatalkan, atau memblokir akses dan keanggotaan Anda pada Platform CodeCrunch maupun Layanan CodeCrunch. 
<br>•	Anda tidak diperkenankan untuk membahayakan, menyalahgunakan, mengubah atau memodifikasi Platform CodeCrunch dengan cara apa pun. Kami dapat menutup, membatalkan akun Anda dan/atau melarang Anda untuk menggunakan Platform CodeCrunch lebih lanjut jika Anda tidak mematuhi Syarat dan Ketentuan ini. 
<br>•	Anda akan menggunakan Platform CodeCrunch hanya untuk tujuan mendapatkan Layanan CodeCrunch, dan tidak akan menyalahgunakan atau menggunakan Platform CodeCrunch untuk aktivitas yang bertentangan dengan hukum, termasuk namun tidak terbatas kepada tindak pidana pencucian uang, pencurian, penggelapan, terorisme maupun penipuan. Anda juga sepakat bahwa Anda tidak akan melakukan pemesanan palsu melalui Platform CodeCrunch dan tidak akan melakukan perbuatan melawan hukum melalui Platform CodeCrunch.
<br>•	Anda mengetahui dan setuju bahwa setiap informasi dalam bentuk apapun, termasuk namun tidak terbatas pada video, audio, gambar atau tulisan yang ada dalam Platform CodeCrunch memiliki hak atas kekayaan intelektual (termasuk namun tidak terbatas kepada hak atas merek dan hak cipta) masing-masing. Anda tidak diperbolehkan untuk menggunakan, mengubah, memfasilitasi, menyebarluaskan dan/atau memutilasi hak atas kekayaan intelektual tersebut tanpa izin dari pemilik hak atas kekayaan intelektual tersebut sebagaimana diatur dalam peraturan perundang-undangan yang berlaku.
<br>•	Pada saat mengakses dan menggunakan Platform CodeCrunch termasuk setiap fitur dan layanannya, Anda tidak diperkenankan untuk:
<br>•	mengalihkan akun Anda di Platform CodeCrunch kepada pihak lain tanpa persetujuan terlebih dahulu dari Kami;
<br>•	menyebarkan virus, spam atau teknologi sejenis lainnya yang dapat merusak dan/atau merugikan Platform CodeCrunch dan pengguna Platform CodeCrunch lainnya;
<br>•	memasukkan atau memindahkan fitur pada Platform CodeCrunch tanpa persetujuan dari Kami;
<br>•	menempatkan informasi atau aplikasi lain yang melanggar hak kekayaan intelektual pihak lain di dalam Platform CodeCrunch;
<br>•	mengambil atau mengumpulkan Data Pribadi dari pengguna Platform CodeCrunch lain, termasuk tetapi tidak terbatas pada alamat surel, tanpa persetujuan dari Pengguna terkait;
<br>•	menggunakan Platform CodeCrunch untuk hal-hal yang dilarang berdasarkan hukum dan undang-undang yang berlaku; dan
<br>•	menggunakan Platform CodeCrunch untuk mendistribusikan iklan atau materi lainnya.
<br>•	Anda mengetahui dan menyetujui bahwa Harga Layanan yang tercantum pada Platform CodeCrunch dapat mengalami perubahan sesuai dengan kebijakan Penyedia Layanan dan/atau CodeCrunch. Anda diharapkan untuk melakukan pemeriksaan terhadap Harga Layanan sebelum menggunakan Layanan CodeCrunch terkait, apabila Anda sudah menggunakan Layanan CodeCrunch tersebut, Anda secara otomatis setuju dengan Harga Layanan yang tercantum selama periode penggunaan Layanan CodeCrunch tersebut. 
<br>•	Platform CodeCrunch memiliki tautan dengan situs-situs yang dioperasikan oleh pihak ketiga. Tautan tersebut tersedia untuk kenyamanan Anda dan hanya akan digunakan untuk menyediakan akses ke situs pihak ketiga dan bukan untuk tujuan lainnya. Kualitas, isi maupun informasi dari Produk atau layanan tersebut akan disediakan oleh situs yang dioperasikan oleh pihak ketiga.
<br>•	Apabila Anda memiliki kendala atas layanan yang diberikan dalam Platform CodeCrunch, Anda dapat menghubungi Layanan Pengaduan Konsumen yang telah Kami sediakan dalam Platform CodeCrunch untuk dapat membantu menangani kendala Anda. Layanan Pengaduan Konsumen Kami akan membantu menangani kendala yang Anda alami. Anda memahami dan menyetujui bahwa Layanan Pengaduan Konsumen yang Kami sediakan hanya bersifat membantu atas kendala yang Anda alami.
            </p>
            <p>
            5. AKUN CODECRUNCH
<br>•	Akun CodeCrunch Anda hanya dapat digunakan oleh Anda dan tidak bisa dialihkan kepada orang lain dan/atau pihak ketiga dengan keadaan dan/atau alasan apapun. Anda memiliki tanggung jawab atas setiap penggunaan akun Anda dalam Platform CodeCrunch. Kami berhak menolak untuk memfasilitasi pesanan jika Kami mengetahui atau mempunyai alasan yang cukup sesuai dengan kebijakan internal Kami untuk menduga bahwa Anda telah mengalihkan atau membiarkan akun Anda digunakan oleh orang lain.
<br>•	CodeCrunch dapat menghentikan dan/atau membatasi proses registrasi atau penggunaan Platform CodeCrunch yang dilakukan oleh Pengguna jika ditemukan pelanggaran atas Syarat dan Ketentuan ini dan/atau peraturan perundang-undangan yang berlaku.
<br>•	Keamanan dan kerahasiaan akun CodeCrunch Anda, termasuk nama terdaftar, nomor telepon genggam terdaftar, serta kode verifikasi yang dihasilkan dan dikirim oleh sistem Kami sepenuhnya merupakan tanggung jawab pribadi Anda. Semua kerugian dan risiko yang ada akibat kelalaian Anda menjaga keamanan dan kerahasiaan sebagaimana disebutkan ditanggung oleh Anda sendiri. Dalam hal demikian, Kami akan menganggap setiap penggunaan atau pesanan yang dilakukan melalui akun Anda sebagai permintaan yang sah dari Anda.
<br>•	Apabila Anda tidak memiliki kontrol atas akun Anda oleh sebab apa pun, maka Anda diharuskan untuk melaporkannya kepada Kami. Apabila terjadi penyalahgunaan akun Anda oleh pihak ketiga mana pun sebelum pelaporan terjadi, maka penggunaan akun pada periode tersebut akan menjadi tanggung jawab Anda sepenuhnya.
<br>•	Kami tidak bertanggung jawab atas segala risiko yang dapat timbul atas hal-hal terkait keamanan nomor ponsel terdaftar, termasuk namun tidak terbatas apabila nomor ponsel tersebut didaur ulang (recycle) oleh operator seluler.
<br>•	Segera beritahukan Kami jika Anda mengetahui atau menduga bahwa akun Anda telah digunakan tanpa sepengetahuan dan persetujuan Anda. Kami akan melakukan tindakan yang Kami anggap perlu dan dapat Kami lakukan terhadap penggunaan tanpa persetujuan tersebut.
            </p>
            <p>
            6. LAYANAN CODECRUNCH
<br>•	Fitur Chat Dengan IT Expert
<br>•	Fitur Chat dengan IT Expert memfasilitasi para Penyedia Layanan untuk berinteraksi dengan Pengguna melalui video call, voice call maupun chat yang dapat diakses melalui Platform CodeCrunch dengan ketentuan sebagai berikut:
<br>•	Pengguna dapat menghubungi Penyedia Layanan ketika Penyedia Layanan berstatus online.
<br>•	Pengguna dapat membatalkan Fitur Chat dengan IT Expert yang sudah ditunjuk dengan Penyedia Layanan maksimum 45 (empat puluh lima) menit sebelum jadwal dimulai. 
<br>•	Penyedia Layanan dapat membatalkan Fitur Chat dengan IT Expert maksimum 30 (tiga puluh) menit sebelum jadwal yang ditunjuk Pengguna.
<br>•	Jika Anda tidak hadir pada jadwal yang sudah Anda tentukan, maka Anda menyetujui bahwa dana yang telah Anda bayarkan tidak dapat dikembalikan.
<br>•	Jika Penyedia Layanan tidak hadir pada jadwal yang telah Anda tentukan dalam waktu maksimum 10 (sepuluh) menit setelah jadwal yang seharusnya maka Kami akan mengembalikan dana Anda sesuai dengan prosedur yang berlaku.
<br>•	Kami akan mengirimkan pemberitahuan terkait janji jadwal yang Anda tentukan melalui push notification pada perangkat elektronik Anda. Untuk dapat menerima push notification yang Kami kirimkan, maka Anda harus mengaktifkan push notification tersebut. 
<br>•	Kami akan berupaya semaksimal mungkin agar Penyedia Layanan yang terdaftar pada Platform CodeCrunch dapat memberikan tanggapan atas pertanyaan Anda sesegera mungkin. 
<br>•	Layanan CodeCrunch tidak bersifat memaksa ataupun mengikat. Keputusan untuk menggunakan Layanan CodeCrunch melalui Platform CodeCrunch sepenuhnya berada di tangan Anda. Platform CodeCrunch hanya merupakan fasilitator interaksi antara Penyedia Layanan dan Pengguna.
<br>•	Anda memahami bahwa Anda perlu memberikan informasi dan menjelaskan gejala atau keluhan fisik yang Anda alami secara lengkap, jelas dan akurat ketika melakukan percakapan dengan Penyedia Layanan.
            </p>
            <p>
            7. TRANSAKSI PENGGUNA
<br>•	Saldo CodeCrunch
<br>•	Saldo CodeCrunch didapatkan hanya dari pengembalian dana atas transaksi yang tidak berhasil pada Platform CodeCrunch. 
<br>•	Untuk menghindari keraguan, Saldo CodeCrunch tidak dapat di top-up.
<br>•	Saldo CodeCrunch tidak dapat dipindahtangankan atau diuangkan dalam bentuk apapun.
<br>•	Metode pembayaran
<br>•	Untuk dapat bertransaksi pada Platform CodeCrunch, Pengguna dapat menggunakan berbagai metode pembayaran yang tersedia pada Platform CodeCrunch. Apabila memiliki dana yang cukup pada Saldo CodeCrunch, Pengguna dapat menggunakan Saldo CodeCrunch untuk bertransaksi. 
<br>•	Pengguna sepakat bahwa CodeCrunch dapat melakukan penangguhan segala transaksi yang berasal dari akun Pengguna apabila CodeCrunch menemukan dan/atau mengidentifikasi transaksi yang mencurigakan, indikasi kecurangan atau jenis transaksi yang tidak sah lainnya berdasarkan kebijakan CodeCrunch yang berlaku.
<br>•	Pengguna memahami dan menyetujui bahwa batas waktu pengajuan keluhan atas transaksi maksimum 7 (tujuh) hari kalender setelah transaksi yang dilakukan Pengguna melalui Platform CodeCrunch diselesaikan.
            </p>
            <p>
            8. KETENTUAN TRANSAKSI
<br>•	Fitur Chat 
<br>•	Fitur Chat dengan IT Expert
<br>•	Pengguna akan dikenakan tarif dengan jumlah tertentu untuk dapat menggunakan Fitur Chat dengan IT Expert. 
<br>•	Apabila memerlukan video call maupun voice call dengan Penyedia Layanan, Pengguna perlu menginformasikan terlebih dahulu kepada Penyedia Layanan terkait dan akan tergantung pada ketersediaan masing-masing Penyedia Layanan pada saat dihubungi.
<br>•	Saldo CodeCrunch akan terpotong secara langsung terhitung saat layar percakapan sudah muncul di layar ponsel dan saat Pengguna sudah terhubung dengan Penyedia Layanan. Satu sesi percakapan dengan Penyedia Layanan terhitung mulai dari 30 (tiga puluh) menit sampai dengan 1 (satu) jam dari sesi percakapan dimulai atau hingga Pengguna atau Pengguna Layanan mengakhiri sesi percakapan. 
<br>•	Saat menghubungi IT Expert melalui percakapan, Pengguna dapat mengirimkan gambar kepada Penyedia Layanan yang berkaitan dengan format PNG, JPG, dan Bitmap. 
<br>•	Setelah sesi selesai, Penyedia Layanan dapat memberikan Catatan Expert.
<br>•	Penyedia Layanan dapat melakukan follow up kepada Pengguna untuk mengecek kondisi masalah Pengguna setelah dilakukannya sesi.
<br>•	Transaksi tidak dapat dibatalkan setelah sesi berakhir atau selesai dilakukan.
<br>•	CodeCrunch dapat memblokir atau membatalkan akun Pengguna apabila terdapat penyalahgunaan Fitur Chat pada akun Pengguna. 
<br>•	Ketepatan serta keakuratan Penyedia Layanan dalam memberi solusi akan bergantung pada informasi yang diberikan oleh Pengguna. Setiap isi dan/atau pernyataan-pernyataan dalam percakapan yang dilakukan oleh Pengguna dengan Penyedia Layanan menggunakan fitur video call, voice call, chat, Catatan Expert, pada Platform CodeCrunch. 
            </p>
            <p>
            9. HAK ATAS KEKAYAAN INTELEKTUAL
<br>•	CodeCrunch adalah pemegang hak lisensi atas nama, ikon, dan logo “CodeCrunch” serta seluruh fitur yang terdapat pada Platform CodeCrunch, yang mana merupakan hak cipta dan merek dagang yang dilindungi undang-undang Republik Indonesia. Pengguna dilarang untuk menggunakan, memodifikasi, dan/atau memasang nama, ikon, logo, atau merek tersebut tanpa persetujuan tertulis dari CodeCrunch. 
<br>•	PT. Dompet Anak Bangsa adalah pemilik tunggal atas nama, ikon, dan logo “GOPAY”, serta pemegang hak kekayaan intelektual yang sah atas nama, ikon dan logo “GOPAY”, yang merupakan hak cipta dan merek yang dilindungi undang-undang. Pengguna tidak dapat menggunakan, mengubah, atau memasang nama, ikon, logo, atau merek tersebut tanpa persetujuan tertulis dari PT. Dompet Anak Bangsa.
<br>•	Seluruh hak atas kekayaan intelektual yang terdapat dalam Platform CodeCrunch berdasarkan hukum negara Republik Indonesia, termasuk dalam hal ini adalah kepemilikan hak kekayaan intelektual atas seluruh source code Platform CodeCrunch dan hak kekayaan intelektual terkait Platform CodeCrunch. Untuk itu, Pengguna dilarang untuk melakukan pelanggaran atas hak kekayaan intelektual yang terdapat pada Platform CodeCrunch ini, termasuk melakukan modifikasi, karya turunan, mengadaptasi, menyalin, menjual, membuat ulang, meretas, menjual, dan/atau mengeksploitasi Platform CodeCrunch termasuk penggunaan Platform CodeCrunch atas akses yang tidak sah, meluncurkan program otomatis atau script, atau segala program apapun yang mungkin menghambat operasi dan/atau kinerja Platform CodeCrunch, atau dengan cara apapun memperbanyak atau menghindari struktur navigasi atau presentasi dari Platform CodeCrunch atau isinya.
<br>•	Pengguna hanya diperbolehkan untuk menggunakan Platform CodeCrunch semata-mata untuk kebutuhan pribadi dan tidak dapat dialihkan. 
<br>•	CodeCrunch dapat mengambil tindakan hukum terhadap setiap pelanggaran yang dilakukan oleh Anda terkait dengan hak kekayaan intelektual terkait Platform CodeCrunch.
            </p>
            <p>
            10. VERIFIKASI DATA PRIBADI
<br>•	Sehubungan dengan verifikasi identitas untuk tujuan penggunaan Platform CodeCrunch, Data Pribadi Anda berupa data demografi dan/atau biometrik akan diperiksa kesesuaiannya, oleh PT Indonesia Digital Identity (“VIDA”) sebagai mitra Kami, dengan data yang tercatat pada sistem instansi pemerintahan yang berhak mengeluarkan identitas tersebut. Apabila Data Pribadi Anda terverifikasi kesesuaiannya, maka VIDA sebagai Penyelenggara Sertifikasi Elektronik tersertifikasi oleh <br>•	Kementerian Telekomunikasi dan Informasi, akan menerbitkan sertifikat elektronik sebagai bukti bahwa Data Pribadi Anda telah diverifikasi dan sesuai dengan data yang tercatat pada sistem instansi yang berhak mengeluarkan identitas tersebut. Anda akan menggunakan sertifikat elektronik tersebut untuk membubuhkan tanda tangan digital untuk menandatangani dokumen Subscriber Agreement VIDA atau Syarat dan Ketentuan ini. Oleh karenanya, Anda menjamin keakuratan Data Pribadi yang Anda sediakan dan setuju atas pemrosesan Data Pribadi Anda tersebut untuk tujuan penerbitan sertifikat elektronik serta layanan lain yang melekat pada sertifikat elektronik yang dilakukan oleh VIDA termasuk tanda tangan digital tersebut.
<br>•	Anda telah membaca, memahami, dan setuju untuk terikat pada syarat dan ketentuan layanan Penyelenggara Sertifikasi Elektronik yang terdapat pada Perjanjian Kepemilikan Sertifikat Elektronik (Subscriber Agreement), Kebijakan Privasi PSrE (CA Privacy Policy), serta Pernyataan Penyelenggaraan Sertifikasi Elektronik (Certification Practice Statement) VIDA yang dapat diakses melalui https://repo.vida.id
<br>•	Anda dengan ini menyatakan telah membaca, memahami, dan menyetujui syarat dan ketentuan layanan Penyelenggara Sertifikasi Elektronik serta menjamin keakuratan Data Pribadi Anda untuk diproses lebih lanjut oleh VIDA sebagai mitra dari CodeCrunch untuk keperluan penerbitan dan pengelolaan Sertifikat Elektronik.
            </p>
            <p>
            11. IKLAN
<br>•	Platform CodeCrunch dapat memuat iklan mengenai Produk dan/atau layanan yang disediakan oleh pihak ketiga (“Iklan”). Seluruh informasi mengenai Iklan disediakan oleh pihak ketiga. CodeCrunch tidak memberikan dukungan (endorsement) atas Iklan mana pun. Komunikasi atau transaksi Pengguna dengan pihak ketiga dan setiap syarat, ketentuan, jaminan atau pernyataan yang terkait dengan transaksi tersebut semata–mata merupakan hubungan antara Pengguna dengan pihak ketiga tersebut.
<br>•	Apabila pada Iklan yang ditampilkan oleh pihak ketiga terdapat tautan yang mengarahkan Anda ke domain lain, yang tidak berada di bawah kendali CodeCrunch. CodeCrunch tidak bertanggung jawab melakukan pemeriksaan, peninjauan atau penjaminan keakuratan yang ditawarkan melalui tautan. Untuk kenyamanan Anda, Anda disarankan untuk memeriksa ulang, memperhatikan, dan mempertimbangkan secara independen keabsahan tautan.
<br>•	Kami akan sangat senang jika Anda dapat membantu menginformasikan kepada Kami jika ada kecurigaan. 
            </p>
            <p>
            12. PEMBERITAHUAN <br>
Semua pemberitahuan atau permintaan kepada Anda akan dianggap sudah diterima oleh Anda jika dan bila: 
<br>•	Pengguna dapat menunjukkan bahwa pemberitahuan tersebut, baik dalam bentuk fisik maupun elektronik, telah dikirimkan kepada Pengguna; atau
<br>•	CodeCrunch telah memasang pemberitahuan tersebut di Platform CodeCrunch yang dapat diakses oleh umum.
            </p>
            <p>
            13. FUNGSI PLATFORM
<br>CodeCrunch senantiasa melakukan upaya untuk menjaga Platform CodeCrunch ini berfungsi dan berjalan lancar. Perlu diketahui bahwa Platform CodeCrunch dan/atau fitur Layanan CodeCrunch dapat sewaktu-waktu tidak tersedia yang disebabkan oleh berbagai alasan, termasuk namun tidak terbatas pada keperluan pemeliharaan atau masalah teknis, dan situasi ini berada di luar kuasa CodeCrunch. 
            </p>
            <p>
            14. PEMBEKUAN AKUN
<br>Pengguna tidak akan menggunakan Platform CodeCrunch pada perangkat atau sistem operasi yang telah dimodifikasi diluar perangkat atau konfigurasi sistem operasi dan konfigurasi Kami. Hal ini mencakup perangkat yang telah melalui proses “rooted” atau “jail-broken”. Perangkat rooted atau jail-broken adalah perangkat yang telah dibebaskan dari pembatasan yang dikenakan oleh penyedia layanan perangkat dan yang dimanufaktur tanpa persetujuan penyedia layanan perangkat. Penggunaan Platform CodeCrunch pada perangkat rooted atau jail-broken dapat mengkompromisasi keamanan dan berujung pada transaksi penipuan.
<br>CodeCrunch tidak bertanggung jawab atas pengunduhan dan penggunaan Platform CodeCrunch pada perangkat rooted atau jail-broken dan risiko penggunaan Pengguna terhadap perangkat rooted atau jail-broken sepenuhnya adalah risiko Pengguna. Pengguna mengerti dan setuju bahwa CodeCrunch tidak bertanggung jawab atas segala kehilangan atau setiap konsekuensi lain yang diderita atau disebabkan oleh Anda sebagai akibat dari penggunaan Platform CodeCrunch pada perangkat rooted atau jail-broken dan CodeCrunch mempunyai diskresi untuk menghentikan penggunaan Pengguna terhadap Platform CodeCrunch pada perangkat rooted atau jail-broken dan memblokir perangkat rooted atau jail-broken untuk menggunakan Platform CodeCrunch.
            </p>
            <p>
            15. LAYANAN PENGADUAN KONSUMEN
<br>PT x
<br>Jl. x
<br>admin@codecrunch.com
<br>Direktorat Jenderal Perlindungan Konsumen dan Tertib Niaga
<br>Kementerian Perdagangan Republik Indonesia
<br>+6281282345230 (WhatsApp)
            </p>
            <p>
            16. PENGHAPUSAN AKUN
<br>•	Anda dapat melakukan penghapusan akun Anda dengan mengakses fitur ‘Hapus Akun Saya’ yang tersedia pada Platform CodeCrunch.
<br>•	Anda dapat menghapus profil yang dibuat di bawah akun Anda dengan mengakses langsung pada setiap profil yang ingin Anda hapus.
<br>•	Dalam hal penghapusan profil sebagaimana dimaksud pada poin 2 di atas, tergantung pada alasan penghapusan yang Anda pilih, informasi dan data yang terdapat pada profil yang dihapus akan:
<br>•	Dihapus secara permanen; atau
<br>•	Disatukan dengan data yang disimpan pada profil lainnya yang berada di bawah akun Anda.
<br>•	Dengan tunduk pada poin 1 dan 3 di atas, Anda memahami bahwa setelah akun Anda atau profil manapun yang dibuat di bawah akun Anda dihapus, maka akun Anda atau profil manapun yang dibuat di bawah akun Anda (termasuk seluruh riwayat transaksi dan seluruh layanan di dalamnya) akan terhapus selamanya dan tidak dapat dipulihkan kembali oleh Anda karena alasan apa pun.
<br>•	Akun Anda dapat dibekukan untuk sementara waktu atau dapat dibekukan secara permanen karena hal-hal, termasuk namun tidak terbatas pada, sebagai berikut: 
<br>•	Laporan Anda bahwa akun Anda digunakan atau diduga digunakan atau disalahgunakan oleh orang lain; 
<br>•	Laporan Anda bahwa ponsel atau tablet pribadi Anda hilang, dicuri atau diretas;
<br>•	CodeCrunch mengetahui atau mempunyai alasan yang cukup untuk menduga bahwa akun Anda telah dialihkan atau digunakan oleh orang lain; 
<br>•	CodeCrunch mengetahui atau dengan alasan yang cukup menduga bahwa telah terjadi hal-hal yang menurut pandangan CodeCrunch telah atau dapat merugikan CodeCrunch, Pengguna, Penyedia Layanan dan/atau pihak lainnya; 
<br>•	Pengguna mengetahui atau dengan alasan yang cukup menduga bahwa Pengguna telah mendaftar atau masuk dalam banyak akun dalam satu perangkat untuk tujuan melanggaran Syarat dan Ketentuan ini, Kebijakan Privasi dan/atau hukum yang berlaku di Indonesia;
<br>•	Sistem Kami mendeteksi adanya tindakan yang tidak wajar dari penggunaan akun Anda atau adanya kewajiban berdasarkan Syarat dan Ketentuan, dan/atau Kebijakan Privasi yang tidak dipenuhi oleh Anda; 
<br>•	Pengguna telah meninggal dunia, ditempatkan di bawah perwalian atau pengampuan atau mengalami ketidakmampuan lainnya yang menjadikan Pengguna tidak cakap hukum berdasarkan peraturan perundang-undangan yang berlaku; 
<br>•	Penggunaan Platform CodeCrunch atau Layanan CodeCrunch oleh Anda atau pihak lain (yang menggunakan akun Anda) dengan cara yang bertentangan dengan Syarat dan Ketentuan ini, Kebijakan Privasi dan/atau peraturan perundang-undangan yang berlaku; dan/atau 
<br>•	Perintah untuk pembekuan akun, baik sementara atau permanen, yang diterbitkan oleh institusi pemerintah atau moneter terkait atau berdasarkan perintah pengadilan yang diterbitkan sesuai dengan peraturan perundang-undangan yang berlaku.
<br>•	Jika akun Anda dibekukan dan Anda memiliki bukti yang jelas bahwa akun Anda seharusnya tidak dibekukan, Anda dapat membuat Laporan kepada Kami untuk menyampaikan bukti-bukti tersebut. Setelah melakukan pemeriksaan lebih lanjut terhadap Laporan Anda, Kami akan, atas kebijakan Kami sepenuhnya, menentukan untuk mengakhiri atau melanjutkan pembekuan terhadap akun Anda. Pembekuan tidak akan diteruskan secara tidak wajar apabila Kami memutuskan bahwa hal-hal yang mengakibatkan terjadinya pembekuan telah diselesaikan.
            </p>
            <p>
            17. KOMUNIKASI ELEKTRONIK
<br>Ketika Anda menggunakan Layanan CodeCrunch, Anda setuju untuk berkomunikasi dengan CodeCrunch secara elektronik termasuk namun tidak terbatas melalui email, pesan singkat, telepon, media sosial, obrolan langsung, dan/atau pusat pesan. Segala bentuk komunikasi elektronik dapat diberitahukan, diungkapkan, dan digunakan sebagai bukti sebagaimana diatur oleh undang-undang dan peraturan Republik Indonesia yang berlaku tentang komunikasi elektronik.
            </p>
            <p>
            18. KETENTUAN SOFTWARE CODECRUNCH
<br>Untuk memberikan layanan terbaik kepada Anda, Kami sesekali akan melakukan pembaruan ke aplikasi Layanan CodeCrunch secara otomatis tergantung pada jenis layanan atau dengan persetujuan Anda untuk memperbarui aplikasi Kami. 
            </p>
            <p>
            19. KEBIJAKAN DAN PERUBAHAN 
<br>Kami setiap saat memiliki hak untuk melakukan perubahan pada situs, kebijakan, ketentuan layanan, dan Syarat dan Ketentuan dan selanjutnya dikirimkan kepada Anda di media yang Kami sediakan. Semua perubahan, penambahan, penghapusan, modifikasi dan lainnya yang Kami lakukan terkait layanan akan secara otomatis berlaku dalam 1x24 jam setelah diunduh dan diumumkan CodeCrunch. Harap untuk selalu membaca dan mengetahui pemberitahuan yang Kami sampaikan melalui media CodeCrunch.
            </p>
            <p>
            20. BAHASA
<br>Syarat dan Ketentuan ini dibuat dalam 2 (dua) bahasa, bahasa Indonesia dan bahasa Inggris. Dalam hal terjadi perbedaan penafsiran, maka versi bahasa Indonesia dinyatakan berlaku.
            </p>
            <p>
            21. PERNYATAAN JAMINAN DAN PELEPASAN TANGGUNG JAWAB
<br>Layanan CodeCrunch dan semua informasi, konten, bahan, Produk (termasuk perangkat lunak) dan layanan lainnya termasuk atau yang tersedia melalui Layanan CodeCrunch disediakan oleh CodeCrunch "apa adanya" dan "sebagaimana tersedia", kecuali secara tertulis dinyatakan lain. CodeCrunch tidak membuat pernyataan atau jaminan dalam bentuk apapun, tersurat maupun tersirat, untuk pengoperasian Layanan CodeCrunch, atau informasi, konten, bahan, Produk (termasuk software) atau layanan lain termasuk di dalam atau disediakan melalui Layanan CodeCrunch, kecuali secara tertulis dinyatakan lain. Anda secara tegas menyetujui bahwa penggunaan Layanan CodeCrunch merupakan risiko Anda sendiri.
<br>Selama diizinkan oleh hukum yang berlaku, CodeCrunch menolak semua jaminan lisan atau tertulis, termasuk namun tidak terbatas pada, jaminan lisan yang dapat diperjualbelikan dan kesesuaian untuk tujuan tertentu. CodeCrunch tidak menjamin Layanan CodeCrunch, informasi, konten, bahan, Produk (termasuk perangkat lunak) CodeCrunch atau layanan lainnya termasuk dalam atau tersedia untuk Anda melalui Layanan CodeCrunch, server CodeCrunch atau komunikasi elektronik yang dikirim CodeCrunch bebas dari virus atau komponen berbahaya lainnya. CodeCrunch tidak bertanggung jawab atas kerusakan yang timbul karena penggunaan Layanan CodeCrunch, atau informasi, konten, bahan, Produk (termasuk perangkat lunak) atau layanan lain yang termasuk dalam atau tersedia untuk Anda melalui Layanan CodeCrunch, termasuk namun tidak terbatas pada kerusakan langsung, tidak langsung, insidental, kausal, atau lainnya kecuali dinyatakan secara tertulis.
<br>CodeCrunch tidak bertanggung jawab atas kelalaian yang terbukti disebabkan oleh Pengguna Platform CodeCrunch dalam pengelolaan akun Pengguna Platform CodeCrunch, yang termasuk namun tidak terbatas pada pemberian kata sandi atau informasi lain apapun terkait dengan akun Pengguna Platform CodeCrunch kepada pihak lain manapun berdasarkan alasan apapun, yang menyebabkan Pengguna Platform CodeCrunch mengalami kehilangan akses, kendali dan/atau kepemilikan atas akun Pengguna Platform CodeCrunch terhadap Platform CodeCrunch. Tanggung jawab tersebut juga termasuk pada kelalaian, kesengajaan atau kealpaan Pengguna Platform CodeCrunch dalam hal terjadinya pemberian setiap informasi terkait akun Pengguna Platform CodeCrunch melalui akses tautan pihak ketiga di luar kendali CodeCrunch. 
<br>Dalam hal Pengguna mengalami kehilangan akses, kendali dan/atau kepemilikan atas akun Pengguna terhadap Platform CodeCrunch, maka Pengguna dapat segera melaporkan kepada CodeCrunch dan CodeCrunch dengan upaya terbaiknya akan memberi bantuan dan dukungan untuk mengembalikan akses, kendali dan/atau kepemilikan atas akun Pengguna yang hilang tersebut. Pengguna Platform CodeCrunch memahami dan sepakat bahwa tidak ada jaminan tersirat apapun yang diberikan oleh CodeCrunch sehubungan dengan keberhasilan bantuan dan dukungan atas usaha pengembalian akses, kendali dan/atau kepemilikan atas akun tersebut. Apabila diperlukan, Pengguna dapat melaporkan kepada pejabat yang berwenang untuk dapat ditindaklanjuti secara hukum yang berlaku dan akan membebaskan CodeCrunch dari segala bentuk tuntutan dan ganti rugi yang dialami oleh Pengguna berdasarkan klausul ini.
<br>Dalam hal terjadi ketidaksesuaian antara Syarat dan Ketentuan dengan ketentuan terkait lainnya yang disediakan oleh CodeCrunch, sepanjang tentang persyaratan yang sifatnya umum, maka Syarat & Ketentuan ini akan tetap berlaku.
            </p>
            <p>
            22. HUKUM YANG BERLAKU DAN PENYELESAIAN SENGKETA
<br>•	Syarat dan Ketentuan ini diatur berdasarkan hukum dan ketentuan Negara Republik Indonesia.
<br>•	Apabila terjadi perselisihan atau perbedaan pendapat yang disebabkan atau yang timbul sehubungan dengan pelaksanaan Syarat dan Ketentuan ini (“Sengketa”), maka Para Pihak sepakat akan menyelesaikan secara musyawarah untuk mufakat, atau melakukan langkah-langkah damai melalui musyawarah mufakat sejak munculnya Sengketa.
<br>•	Apabila Sengketa tidak dapat diselesaikan melalui musyawarah mufakat dalam kurun waktu 30 (tiga puluh) hari kalender sejak Sengketa diberitahukan oleh salah satu Pihak ke Pihak lainnya, maka Para Pihak sepakat untuk menyelesaikan Sengketa secara final melalui Arbitrase yang diselenggarakan oleh Badan Arbitrase Nasional Indonesia (“BANI”) sesuai dengan ketentuan-ketentuan BANI yang berlaku pada saat itu mengenai prosedur arbitrase. Arbitrase akan dipimpin oleh 1 (satu) orang arbiter yang ditunjuk oleh Ketua BANI dan dilaksanakan di DKI Jakarta, Indonesia, menggunakan bahasa Indonesia. Putusan arbitrase akan dianggap sebagai putusan yang berkekuatan hukum tetap, mengikat dan tidak dapat digugat kembali dan tidak ada satu Pihak pun yang dapat memulai suatu persidangan atau memasukan suatu gugatan di pengadilan manapun sehubungan dengan sengketa yang timbul dari dan sehubungan dengan Syarat dan Ketentuan ini.
<br>•	Para Pihak sepakat untuk tidak melaksanakan dan/atau meneruskan proses di pengadilan atas Sengketa yang timbul atas atau sehubungan dengan Syarat dan Ketentuan ini.
            </p>
            </div>
        </div>
    </div>
</div>

</x-layout>
