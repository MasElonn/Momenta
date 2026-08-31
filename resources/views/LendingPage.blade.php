<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Momenta — Galeri &amp; Booking Fotografer Acara Sekolah</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
  /*
    ============================================================
    WARNA — edit nilai HEX di bawah ini untuk ganti tampilan.
    Semua elemen di halaman ini pakai var(--nama-variabel),
    jadi cukup ganti di satu tempat ini.
    ============================================================
  */
  :root{
    /* Navy — teks judul besar, latar footer CTA, latar navbar dashboard gelap */
    --navy:#0F1B3D;

    /* Blue — tombol utama, link aktif, ikon, aksen highlight judul */
    --blue:#1D4ED8;

    /* Blue Dark — warna tombol biru saat hover */
    --blue-dark:#1739A8;

    /* Blue Soft — latar kotak ikon (kalender, lokasi, dll) */
    --blue-soft:#EEF2FF;

    /* Background — latar belakang halaman */
    --bg:#F5F7FC;

    /* White — warna kartu & tombol outline */
    --white:#FFFFFF;

    /* Line — garis/border tipis pemisah elemen */
    --line:#E3E8F4;

    /* Ink — warna teks utama */
    --ink:#101425;

    /* Ink Soft — warna teks sekunder yang lebih pudar */
    --ink-soft:#5B6178;

    /* Mint — badge "Terjadwal", centang fitur, tag "Populer" */
    --mint:#0FA968;

    /* Mint Soft — latar belakang lembut di belakang badge hijau */
    --mint-soft:#E7F8EF;

    /* Radius — bukan warna, tapi ikut di sini biar gampang diatur juga */
    --radius:16px;
  }
  *{box-sizing:border-box; margin:0; padding:0;}
  html{scroll-behavior:smooth;}
  body{
    font-family:'Inter',sans-serif;
    background:var(--bg);
    color:var(--ink);
    -webkit-font-smoothing:antialiased;
  }
  h1,h2,h3,.brand{font-family:'Space Grotesk',sans-serif;}
  .mono{font-family:'JetBrains Mono',monospace;}
  a{text-decoration:none; color:inherit;}
  img{display:none;} /* no images used in this design */

  .wrap{max-width:1180px; margin:0 auto; padding:0 32px;}

  /* NAV */
  nav{
    position:sticky; top:0; z-index:50;
    background:rgba(245,247,252,0.85);
    backdrop-filter:blur(10px);
    border-bottom:1px solid var(--line);
  }
  .navbar{display:flex; align-items:center; justify-content:space-between; padding:18px 32px;}
  .brand{display:flex; align-items:center; gap:10px; font-size:20px; font-weight:700; color:var(--navy);}
  .brand-mark{
    width:30px; height:30px; border-radius:8px;
    background:var(--navy);
    position:relative;
    flex-shrink:0;
  }
  .brand-mark::before{
    content:"";
    position:absolute; left:50%; top:50%;
    width:12px; height:12px;
    transform:translate(-50%,-46%);
    background:var(--white);
    clip-path:polygon(50% 0%, 0% 100%, 100% 100%);
  }
  .nav-links{display:flex; gap:36px; font-size:14.5px; font-weight:500; color:var(--ink-soft);}
  .nav-links a:hover{color:var(--navy);}
  .nav-cta{display:flex; align-items:center; gap:14px;}

  .btn{
    display:inline-flex; align-items:center; justify-content:center; gap:8px;
    padding:11px 22px; border-radius:10px;
    font-size:14.5px; font-weight:600;
    cursor:pointer; border:1px solid transparent;
    transition:transform .15s ease, box-shadow .15s ease, background .15s ease;
    white-space:nowrap;
  }
  .btn-primary{background:var(--blue); color:var(--white); box-shadow:0 8px 20px -8px rgba(29,78,216,.55);}
  .btn-primary:hover{background:var(--blue-dark); transform:translateY(-1px);}
  .btn-ghost{background:transparent; color:var(--navy); border-color:var(--line);}
  .btn-ghost:hover{border-color:var(--blue); color:var(--blue);}
  .btn-dark{background:var(--navy); color:var(--white);}
  .btn-dark:hover{background:#152a5e;}
  .btn-block{width:100%;}

  /* HERO */
  .hero{padding:88px 0 60px;}
  .hero-grid{display:grid; grid-template-columns:1.05fr .95fr; gap:56px; align-items:center;}
  .eyebrow{
    display:inline-flex; align-items:center; gap:8px;
    background:var(--mint-soft); color:var(--mint);
    font-size:12.5px; font-weight:600; letter-spacing:.02em;
    padding:6px 12px; border-radius:999px; margin-bottom:20px;
  }
  .eyebrow::before{content:""; width:6px; height:6px; border-radius:50%; background:var(--mint);}
  .hero h1{
    font-size:46px; line-height:1.12; font-weight:700; color:var(--navy);
    letter-spacing:-0.01em;
  }
  .hero h1 span{color:var(--blue);}
  .hero p{
    margin-top:20px; font-size:16.5px; line-height:1.65; color:var(--ink-soft);
    max-width:480px;
  }
  .hero-actions{display:flex; gap:14px; margin-top:32px; flex-wrap:wrap;}
  /* Signature: booking ticket card */
  .ticket{
    background:var(--white); border-radius:var(--radius);
    border:1px solid var(--line);
    box-shadow:0 30px 60px -30px rgba(15,27,61,.25);
    overflow:hidden;
  }
  .ticket-top{padding:22px 24px 20px; display:flex; justify-content:space-between; align-items:flex-start;}
  .ticket-id{font-size:12px; color:var(--ink-soft);}
  .ticket-id b{display:block; color:var(--navy); font-size:13.5px; margin-top:2px;}
  .badge{
    background:var(--mint-soft); color:var(--mint);
    font-size:11.5px; font-weight:600; padding:5px 10px; border-radius:999px;
  }
  .ticket-body{padding:0 24px 22px;}
  .ticket-row{display:flex; gap:12px; align-items:flex-start; padding:12px 0; border-top:1px dashed var(--line);}
  .ticket-row:first-child{border-top:none;}
  .row-icon{
    width:34px; height:34px; border-radius:9px; background:var(--blue-soft);
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
  }
  .row-icon svg{width:16px; height:16px; stroke:var(--blue);}
  .row-label{font-size:11.5px; color:var(--ink-soft); text-transform:uppercase; letter-spacing:.03em;}
  .row-value{font-size:14.5px; font-weight:600; color:var(--navy); margin-top:2px;}
  .ticket-cut{
    position:relative; height:1px; background:transparent;
  }
  .ticket-foot{
    background:var(--navy); padding:20px 24px; display:flex; justify-content:space-between; align-items:center;
  }
  .ticket-foot .lbl{font-size:11.5px; color:#AAB4D6;}
  .ticket-foot .val{font-family:'Space Grotesk',sans-serif; font-size:20px; color:var(--white); font-weight:700; margin-top:2px;}
  .ticket-foot .btn{padding:9px 16px; font-size:13px;}

  /* SECTIONS shared */
  section{padding:80px 0;}
  .section-head{max-width:600px; margin:0 auto 48px; text-align:center;}
  .kicker{
    font-size:12.5px; font-weight:600; letter-spacing:.06em; text-transform:uppercase;
    color:var(--blue); margin-bottom:12px;
  }
  .section-head h2{font-size:32px; color:var(--navy); font-weight:700; letter-spacing:-.01em;}
  .section-head p{margin-top:14px; color:var(--ink-soft); font-size:15.5px; line-height:1.6;}

  /* HOW IT WORKS */
  .steps{display:grid; grid-template-columns:repeat(3,1fr); gap:24px;}
  .step-card{
    background:var(--white); border:1px solid var(--line); border-radius:var(--radius);
    padding:28px 26px;
  }
  .step-num{
    font-family:'JetBrains Mono',monospace; font-size:13px; color:var(--blue);
    background:var(--blue-soft); width:36px; height:36px; border-radius:10px;
    display:flex; align-items:center; justify-content:center; font-weight:600; margin-bottom:18px;
  }
  .step-card h3{font-size:17px; color:var(--navy); margin-bottom:8px; font-weight:600;}
  .step-card p{font-size:14.5px; color:var(--ink-soft); line-height:1.6;}

  /* FEATURES row */
  .features{display:grid; grid-template-columns:repeat(4,1fr); gap:20px;}
  .feature{
    background:var(--white); border:1px solid var(--line); border-radius:14px; padding:22px;
  }
  .feature .row-icon{margin-bottom:14px;}
  .feature h4{font-size:14.5px; color:var(--navy); font-weight:600; margin-bottom:6px;}
  .feature p{font-size:13px; color:var(--ink-soft); line-height:1.55;}

  /* PRICING */
  .pricing-bg{background:var(--white); border-top:1px solid var(--line); border-bottom:1px solid var(--line);}
  .plans{display:grid; grid-template-columns:repeat(3,1fr); gap:24px; align-items:stretch;}
  .plan{
    border:1px solid var(--line); border-radius:var(--radius);
    padding:32px 28px; background:var(--bg);
    display:flex; flex-direction:column;
    position:relative;
  }
  .plan.featured{
    background:var(--navy); border-color:var(--navy); color:var(--white);
    transform:scale(1.03);
    box-shadow:0 30px 60px -25px rgba(15,27,61,.4);
  }
  .plan-tag{
    position:absolute; top:-13px; left:28px;
    background:var(--mint); color:var(--white);
    font-size:11.5px; font-weight:600; padding:5px 12px; border-radius:999px;
  }
  .plan h3{font-size:18px; font-weight:600; margin-bottom:6px;}
  .plan .plan-desc{font-size:13.5px; color:var(--ink-soft); margin-bottom:22px;}
  .plan.featured .plan-desc{color:#AAB4D6;}
  .plan .price{font-family:'Space Grotesk',sans-serif; font-size:34px; font-weight:700; color:var(--navy);}
  .plan.featured .price{color:var(--white);}
  .price span{font-size:14px; font-weight:500; color:var(--ink-soft);}
  .plan.featured .price span{color:#AAB4D6;}
  .plan-list{list-style:none; margin:26px 0 28px; flex-grow:1;}
  .plan-list li{
    display:flex; gap:10px; align-items:flex-start;
    font-size:14px; color:var(--ink-soft); padding:8px 0;
  }
  .plan.featured .plan-list li{color:#D6DBEE;}
  .plan-list li svg{width:16px; height:16px; stroke:var(--mint); flex-shrink:0; margin-top:2px;}
  .plan.featured .plan-list li svg{stroke:#5FE3A8;}
  .plan-edit-note{
    font-family:'JetBrains Mono',monospace; font-size:10.5px; color:#B8BFD6;
    margin-top:-16px; margin-bottom:16px;
  }
  .plan:not(.featured) .plan-edit-note{color:#AEB4C9;}

  /* CTA band */
  .cta-band{
    background:var(--navy); border-radius:24px; margin:0 32px;
    padding:56px 48px; display:flex; align-items:center; justify-content:space-between; gap:32px;
    flex-wrap:wrap;
  }
  .cta-band h2{color:var(--white); font-size:28px; font-weight:700; max-width:420px;}
  .cta-band p{color:#AAB4D6; margin-top:10px; font-size:14.5px; max-width:420px;}
  .cta-actions{display:flex; gap:14px;}

  /* FOOTER */
  footer{padding:48px 0 32px;}
  .footer-grid{display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;}
  .footer-links{display:flex; gap:28px; font-size:13.5px; color:var(--ink-soft);}
  .footer-links a:hover{color:var(--navy);}
  .copyright{font-size:13px; color:var(--ink-soft);}

  @media (max-width:900px){
    .hero-grid{grid-template-columns:1fr;}
    .steps{grid-template-columns:1fr;}
    .features{grid-template-columns:repeat(2,1fr);}
    .plans{grid-template-columns:1fr;}
    .plan.featured{transform:none;}
    .nav-links{display:none;}
    .hero h1{font-size:34px;}
    .cta-band{flex-direction:column; align-items:flex-start;}
  }
</style>
</head>
<body>

<nav>
  <div class="navbar">
    <div class="brand"><span class="brand-mark"></span>Momenta</div>
    <div class="nav-links">
      <a href="#cara-kerja">Cara Kerja</a>
      <a href="#fitur">Fitur</a>
      <a href="#harga">Paket</a>
    </div>
    <div class="nav-cta">
      <a href="{{ url('/Login') }}" class="btn btn-ghost">Masuk</a>
      <a href="{{ url('/dash') }}" class="btn btn-primary">Dashboard</a>
    </div>
  </div>
</nav>

<header class="hero">
  <div class="wrap hero-grid">
    <div>
      <div class="eyebrow">Untuk acara sekolah</div>
      <h1>Atur fotografer,<br>simpan hasilnya,<br><span>bagikan ke orang tua.</span></h1>
      <p>Panitia tinggal pilih tanggal dan paket, fotografer datang sesuai jadwal, lalu hasil fotonya langsung muncul di galeri. Nggak perlu lagi kirim-kirim file lewat WhatsApp.</p>
      <div class="hero-actions">
        <a href="{{ url('/dash') }}" class="btn btn-primary">Buka Dashboard</a>
        <a href="#" class="btn btn-ghost">Daftar Gratis</a>
      </div>
    </div>

    <div class="ticket">
      <div class="ticket-top">
        <div class="ticket-id">Booking ID<b class="mono">#MMT-2026-9042</b></div>
        <span class="badge">Terjadwal</span>
      </div>
      <div class="ticket-body">
        <div class="ticket-row">
          <div class="row-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg></div>
          <div><div class="row-label">Tanggal Sesi</div><div class="row-value">Kamis, 12 Nov 2026</div></div>
        </div>
        <div class="ticket-row">
          <div class="row-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg></div>
          <div><div class="row-label">Lokasi</div><div class="row-value">Aula Sekolah, Gerbang Utama</div></div>
        </div>
        <div class="ticket-row">
          <div class="row-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg></div>
          <div><div class="row-label">Fotografer</div><div class="row-value">Muhammad Atif</div></div>
        </div>
      </div>
      <div class="ticket-foot">
        <div><div class="lbl">Paket Dipilih</div><div class="val">Rp 750.000</div></div>
        <a href="{{ url('/dash') }}" class="btn btn-primary">Lihat Detail</a>
      </div>
    </div>
  </div>
</header>

<section id="cara-kerja">
  <div class="wrap">
    <div class="section-head">
      <div class="kicker">Cara Kerja</div>
      <h2>Dari booking sampai galeri</h2>
      <p>Prosesnya sama untuk acara apa pun, dari rapat kelas sampai wisuda.</p>
    </div>
    <div class="steps">
      <div class="step-card">
        <div class="step-num mono">01</div>
        <h3>Pilih paket &amp; jadwal</h3>
        <p>Tentukan tanggal, lokasi, dan paket yang paling pas buat acaramu.</p>
      </div>
      <div class="step-card">
        <div class="step-num mono">02</div>
        <h3>Fotografer datang</h3>
        <p>Datang tepat waktu, motret sepanjang acara berlangsung.</p>
      </div>
      <div class="step-card">
        <div class="step-num mono">03</div>
        <h3>Galeri siap dibagikan</h3>
        <p>Foto yang sudah diedit masuk ke galeri, tinggal bagikan link-nya ke siswa dan orang tua.</p>
      </div>
    </div>
  </div>
</section>

<section id="fitur">
  <div class="wrap">
    <div class="section-head">
      <div class="kicker">Fitur</div>
      <h2>Yang bisa panitia lakukan di sini</h2>
    </div>
    <div class="features">
      <div class="feature">
        <div class="row-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg></div>
        <h4>Jadwal Sesi</h4>
        <p>Atur tanggal dan lokasi sesi foto tanpa bentrok.</p>
      </div>
      <div class="feature">
        <div class="row-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg></div>
        <h4>Galeri Online</h4>
        <p>Hasil foto tersusun rapi per acara dan siap diunduh.</p>
      </div>
      <div class="feature">
        <div class="row-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg></div>
        <h4>Fotografer Terverifikasi</h4>
        <p>Pilih fotografer berdasarkan lokasi dan pengalaman acara sekolah.</p>
      </div>
      <div class="feature">
        <div class="row-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg></div>
        <h4>Status Booking</h4>
        <p>Lihat progres booking, dari diajukan sampai selesai.</p>
      </div>
    </div>
  </div>
</section>

<section id="harga" class="pricing-bg">
  <div class="wrap" style="padding:80px 0;">
    <div class="section-head">
      <div class="kicker">Harga</div>
      <h2>Paket yang bisa disesuaikan</h2>
      <p>Contoh paket di bawah masih bisa kamu ubah nama, isi, dan harganya sesuai kebutuhan.</p>
    </div>
    <div class="plans">
      <div class="plan">
        <h3>Paket Dasar</h3>
        <p class="plan-desc">Untuk acara kelas kecil</p>
        <div class="price">Rp 500rb<span>/sesi</span></div>
        <ul class="plan-list">
          <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>60 menit sesi foto</li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>15 foto hasil edit</li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>1 fotografer</li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>Galeri online 30 hari</li>
        </ul>
        <a href="#" class="btn btn-ghost btn-block">Pilih Paket</a>
      </div>

      <div class="plan featured">
        <div class="plan-tag">Paling Populer</div>
        <h3>Paket Populer</h3>
        <p class="plan-desc">Untuk wisuda &amp; perpisahan</p>
        <div class="price">Rp 750rb<span>/sesi</span></div>
        <ul class="plan-list">
          <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>90 menit sesi foto</li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>25 foto hasil edit</li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>1 fotografer + asisten</li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>Galeri online 90 hari</li>
        </ul>
        <a href="#" class="btn btn-primary btn-block">Pilih Paket</a>
      </div>

      <div class="plan">
        <h3>Paket Premium</h3>
        <p class="plan-desc">Untuk acara besar sekolah</p>
        <div class="price">Rp 1.2jt<span>/sesi</span></div>
        <ul class="plan-list">
          <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>3 jam sesi foto</li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>60 foto hasil edit</li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>2 fotografer</li>
          <li><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7 9 18l-5-5"/></svg>Galeri online tanpa batas</li>
        </ul>
        <a href="#" class="btn btn-ghost btn-block">Pilih Paket</a>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="cta-band">
    <div>
      <h2>Ada acara sekolah bulan depan?</h2>
      <p>Daftar, lalu langsung pilih fotografer dan tanggalnya.</p>
    </div>
    <div class="cta-actions">
      <a href="#" class="btn btn-primary">Daftar Sekarang</a>
      <a href="{{ url('/dash') }}" class="btn btn-ghost" style="border-color:#2A3766; color:#fff;">Buka Dashboard</a>
    </div>
  </div>
</section>

<footer>
  <div class="wrap footer-grid">
    <div class="brand" style="font-size:16px;"><span class="brand-mark" style="width:24px;height:24px;"></span>Momenta</div>
    <div class="footer-links">
      <a href="#cara-kerja">Cara Kerja</a>
      <a href="#fitur">Fitur</a>
      <a href="#harga">Harga</a>
    </div>
    <div class="copyright">© 2026 Momenta.</div>
  </div>
</footer>

</body>
</html>