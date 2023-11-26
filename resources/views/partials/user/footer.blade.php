<footer>
    <div class="container">
        <div class="footer-info">
            <div class="row">
                <div class="col-lg-4">
                    <h6 class="invisible">Tentang JDIH</h6>
                    <p>Dengan sosialisasi produk hukum yang efektif diharapkan mampu menciptakan masyarakat
                        Kabupaten
                        Bone Bolango Provinsi Gorontalo yang sadar Hukum.</p>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <h6>Kontak</h6>
                    <ul>
                        <li><img src="{{ asset('template_user/assets/img/icon/telephone.png') }} " alt="icon"> +62
                            81-234-567-890</li>
                        <li><img src="{{ asset('template_user/assets/img/icon/email.png') }} " alt="icon">
                            jdih@bonebolangokab.go.id</li>
                        <li>
                            <img src="{{ asset('template_user/assets/img/icon/location.png') }}" alt="icon">
                            Kompleks Kantor Bupati
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <h6>Statistik</h6>
                    <ul>
                        <li><img src="{{ asset('template_user/assets/img/icon/person.png') }} " alt="icon">
                            Pengunjung Bulan Ini
                            <p>{{ $totalVisitorMonth }}</p>
                        </li>
                        <li><img src="{{ asset('template_user/assets/img/icon/person-outline.png') }} " alt="icon">
                            Pengunjung Hari Ini
                            <p>{{ $totalVisitorToday }}</p>
                        </li>
                        <li><img src="{{ asset('template_user/assets/img/icon/multi-person.png') }} "
                                alt="icon">Total Pengunjung
                            <p>{{ $totalVisitor }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <hr style="color: grey; ">
    <div class="footer-copyright">
        <p>
            Copyright 2022 Bagian Hukum Setda Kabupaten Bone Bolango
            didukung oleh Diskominfo Bone Bolango
        </p>
    </div>
</footer>
