<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Masuk — Momenta</title>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  /*
    ============================================================
    WARNA — samakan dengan LandingPage.blade.php kalau kamu
    ganti warna di sana, biar konsisten.
    ============================================================
  */
  :root{
    --navy:#0F1B3D;
    --blue:#1D4ED8;
    --blue-dark:#1739A8;
    --blue-soft:#EEF2FF;
    --bg:#F5F7FC;
    --white:#FFFFFF;
    --line:#E3E8F4;
    --ink:#101425;
    --ink-soft:#5B6178;
    --radius:16px;
  }
  *{box-sizing:border-box; margin:0; padding:0;}
  body{
    font-family:'Inter',sans-serif;
    background:var(--bg);
    color:var(--ink);
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:24px;
  }
  h1{font-family:'Space Grotesk',sans-serif;}

  .auth-card{
    display:flex;
    width:100%;
    max-width:960px;
    min-height:600px;
    background:var(--white);
    border-radius:24px;
    border:1px solid var(--line);
    box-shadow:0 30px 70px -30px rgba(15,27,61,.25);
    overflow:hidden;
  }

  /* ============================================================
     PANEL KIRI
     Untuk pasang foto asli (seperti contoh kamera di referensi):
     1. Hapus/kosongkan properti `background` di .auth-visual
     2. Ganti jadi:  background: url('{{ asset('images/login-cover.jpg') }}') center/cover no-repeat;
     3. Taruh file fotonya di public/images/login-cover.jpg
     Pola aperture di bawah ini otomatis nggak kepakai lagi
     kalau background-image sudah diisi.
     ============================================================ */
  .auth-visual{
    flex:1;
    position:relative;
    background:
      radial-gradient(circle at 30% 75%, rgba(29,78,216,.35), transparent 55%),
      linear-gradient(160deg, #0B1430, var(--navy) 60%, #142252);
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    padding:36px;
    min-width:320px;
  }
  .auth-visual-brand{
    display:flex; align-items:center; gap:10px;
    color:var(--white); font-family:'Space Grotesk',sans-serif;
    font-size:18px; font-weight:700;
  }
  .auth-visual-brand .mark{
    width:26px; height:26px; border-radius:7px; background:var(--white);
    position:relative; flex-shrink:0;
  }
  .auth-visual-brand .mark::before{
    content:""; position:absolute; left:50%; top:50%;
    width:11px; height:11px; transform:translate(-50%,-46%);
    background:var(--navy);
    clip-path:polygon(50% 0%, 0% 100%, 100% 100%);
  }

  /* pola "aperture" dekoratif — pengganti sementara sebelum ada foto */
  .aperture{
    position:absolute; inset:0; margin:auto;
    width:280px; height:280px;
    top:50%; left:50%; transform:translate(-50%,-50%);
    opacity:.5;
  }
  .aperture circle{fill:none; stroke:rgba(255,255,255,.18); stroke-width:1;}
  .aperture circle.accent{stroke:rgba(29,120,216,.55); stroke-width:1.5;}

  .auth-visual-quote{
    color:#C9D1EE; font-size:14.5px; line-height:1.6; max-width:320px;
  }
  .auth-visual-quote b{display:block; color:var(--white); font-size:15px; margin-bottom:6px;}

  /* ============================================================
     PANEL KANAN — FORM LOGIN
     ============================================================ */
  .auth-form{
    flex:1;
    padding:56px 48px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    min-width:320px;
  }
  .auth-form h1{
    font-size:30px; font-weight:700; color:var(--blue); letter-spacing:-.01em;
  }
  .auth-form .subtitle{
    margin-top:8px; color:var(--ink-soft); font-size:14.5px;
  }

  .field{margin-top:24px;}
  .field label{
    display:block; font-size:13.5px; font-weight:600; color:var(--ink);
    margin-bottom:8px;
  }
  .field-input{
    display:flex; align-items:center; gap:10px;
    border:1px solid var(--line); border-radius:10px;
    padding:11px 14px; background:var(--white);
    transition:border-color .15s ease;
  }
  .field-input:focus-within{border-color:var(--blue);}
  .field-input svg{width:17px; height:17px; stroke:var(--ink-soft); flex-shrink:0;}
  .field-input input{
    border:none; outline:none; flex:1; font-size:14.5px; color:var(--ink);
    font-family:'Inter',sans-serif; background:transparent;
  }
  .field-input input::placeholder{color:#A6ACC2;}
  .toggle-pass{cursor:pointer; background:none; border:none; padding:0; display:flex;}

  .field-row{
    display:flex; align-items:center; justify-content:space-between;
    margin-top:14px; font-size:13.5px;
  }
  .remember{display:flex; align-items:center; gap:8px; color:var(--ink-soft);}
  .remember input{width:15px; height:15px; accent-color:var(--blue);}
  .forgot{color:var(--blue); font-weight:600;}
  .forgot:hover{text-decoration:underline;}

  .btn{
    display:flex; align-items:center; justify-content:center; gap:8px;
    width:100%; padding:12px 20px; border-radius:10px;
    font-size:14.5px; font-weight:600; cursor:pointer;
    border:1px solid transparent; font-family:'Inter',sans-serif;
    transition:background .15s ease, transform .15s ease;
  }
  .btn-primary{
    background:var(--blue); color:var(--white); margin-top:22px;
    box-shadow:0 10px 24px -10px rgba(29,78,216,.55);
  }
  .btn-primary:hover{background:var(--blue-dark); transform:translateY(-1px);}
  .btn-outline{
    background:var(--white); color:var(--ink); border-color:var(--line);
  }
  .btn-outline:hover{border-color:var(--ink-soft);}
  .btn-outline svg{width:17px; height:17px;}

  .divider{
    display:flex; align-items:center; gap:12px;
    margin:20px 0; color:var(--ink-soft); font-size:12.5px;
  }
  .divider::before, .divider::after{
    content:""; flex:1; height:1px; background:var(--line);
  }

  .signup-hint{
    text-align:center; margin-top:24px; font-size:13.5px; color:var(--ink-soft);
  }
  .signup-hint a{color:var(--blue); font-weight:600;}
  .signup-hint a:hover{text-decoration:underline;}

  @media (max-width:760px){
    .auth-card{flex-direction:column; max-width:420px;}
    .auth-visual{min-height:200px;}
    .auth-form{padding:40px 28px;}
  }
</style>
</head>
<body>

<div class="auth-card">

  <div class="auth-visual">
    <div class="auth-visual-brand">
      <span class="mark"></span>Momenta
    </div>

    <svg class="aperture" viewBox="0 0 280 280">
      <circle cx="140" cy="140" r="130"/>
      <circle cx="140" cy="140" r="95" class="accent"/>
      <circle cx="140" cy="140" r="60"/>
      <circle cx="140" cy="140" r="26" class="accent"/>
    </svg>

    <div class="auth-visual-quote">
      <b>Setiap acara punya ceritanya sendiri.</b>
      Masuk untuk lihat jadwal booking dan galeri foto acara sekolahmu.
    </div>
  </div>

  <div class="auth-form">
    <h1>Selamat datang kembali</h1>
    <p class="subtitle">Masukkan detail akunmu untuk mengakses dashboard.</p>

    <form method="POST" action="{{ url('/login') }}">
      @csrf

      <div class="field">
        <label for="email">Alamat email</label>
        <div class="field-input">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16v16H4z"/><path d="m4 6 8 7 8-7"/></svg>
          <input type="email" id="email" name="email" placeholder="nama@contoh.com" value="{{ old('email') }}" required>
        </div>
      </div>

      <div class="field">
        <label for="password">Kata sandi</label>
        <div class="field-input">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="10" width="16" height="10" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
          <input type="password" id="password" name="password" placeholder="••••••••" required>
          <button type="button" class="toggle-pass" aria-label="Tampilkan kata sandi">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="stroke:var(--ink-soft)"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
      </div>

      <div class="field-row">
        <label class="remember">
          <input type="checkbox" name="remember">
          Ingat saya selama 30 hari
        </label>
        <a href="#" class="forgot">Lupa kata sandi?</a>
      </div>

      <button type="submit" class="btn btn-primary">Masuk</button>
    </form>

    <div class="divider">ATAU</div>

    <button type="button" class="btn btn-outline">
      <svg viewBox="0 0 24 24"><path fill="#4285F4" d="M23.5 12.3c0-.8-.1-1.6-.2-2.3H12v4.5h6.5c-.3 1.5-1.1 2.7-2.4 3.6v3h3.9c2.3-2.1 3.5-5.2 3.5-8.8Z"/><path fill="#34A853" d="M12 24c3.2 0 6-1.1 7.9-2.9l-3.9-3c-1.1.7-2.4 1.2-4 1.2-3.1 0-5.7-2.1-6.6-4.9H1.4v3.1C3.3 21.3 7.3 24 12 24Z"/><path fill="#FBBC05" d="M5.4 14.4c-.2-.7-.4-1.4-.4-2.2s.1-1.5.4-2.2V6.9H1.4C.5 8.5 0 10.2 0 12s.5 3.5 1.4 5.1l4-2.7Z"/><path fill="#EA4335" d="M12 4.8c1.7 0 3.3.6 4.5 1.8l3.4-3.4C17.9 1.2 15.2 0 12 0 7.3 0 3.3 2.7 1.4 6.9l4 2.7C6.3 6.9 8.9 4.8 12 4.8Z"/></svg>
      Masuk dengan Google
    </button>

    <p class="signup-hint">Belum punya akun? <a href="#">Daftar</a></p>
  </div>

</div>

</body>
</html>