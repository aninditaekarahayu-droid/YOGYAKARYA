<?php header("Content-Type: text/css"); ?>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lato:wght@300;400;700&display=swap');
  /* ================================================
    VARIABEL WARNA & FONT
    ================================================ */
  :root {
    --cokelat-tua:    #3D1F0D;
    --cokelat-medium: #5C2E0E;
    --cokelat-navbar: #030303;
    --emas:           #C9A84C;
    --emas-terang:    #E2C97E;
    --putih:          #FFFFFF;
    --putih-krem:     #F5F0E8;
    --teks-gelap:     #2B1506;
    --teks-abu:       #6B5744;
    --font-judul:     'Playfair Display', serif;
    --font-isi:       'Lato', sans-serif;
    --radius:         12px;
    --radius-sm:      8px;
    --shadow:         0 4px 20px rgba(0,0,0,0.25);
  }

  /* ================================================
    RESET
    ================================================ */
  *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
  html { scroll-behavior: smooth; }
  body {
    font-family: var(--font-isi);
    background-color: var(--cokelat-tua);
    color: var(--putih);
    line-height: 1.7;
  }
  a { text-decoration: none; color: inherit; }
  img { max-width: 100%; display: block; }
  ul { list-style: none; }

  /* ================================================
    NAVBAR
    ================================================ */
  .navbar {
    background-color: var(--cokelat-navbar);
    position: sticky;
    top: 0;
    z-index: 999;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 40px;
    height: 56px;
  }

  .nav-logo {
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: var(--font-judul);
    font-size: 1.1rem;
    color: var(--emas);
    letter-spacing: 2px;
  }

  .nav-logo img { height: 36px; width: auto; }

  .nav-links { display: flex; gap: 28px; }

  .nav-links a {
    font-family: var(--font-isi);
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 1.5px;
    color: var(--putih);
    transition: color 0.2s;
  }

  .nav-links a:hover,
  .nav-links a.active { color: var(--emas); }

  .hamburger {
    display: none;
    font-size: 1.4rem;
    color: var(--putih);
    cursor: pointer;
    background: none;
    border: none;
  }

  /* ================================================
    HERO
    ================================================ */
  .hero {
    position: relative;
    height: 480px;
    background: url('images/Hero.png') center/cover no-repeat;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding-bottom: 64px;
    @media (max-width: 768px) {
    height: 260px;
    background-position: center center;
    background-size: cover;
  }
}
  }

  .hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(61,31,13,0.2) 0%, rgba(61,31,13,0.65) 100%);
  }

  .hero-content { position: relative; text-align: center; }

  /* ================================================
    BUTTONS
    ================================================ */
  .btn-jelajahi {
    display: inline-block;
    background-color: var(--emas);
    color: var(--teks-gelap);
    font-family: var(--font-isi);
    font-weight: 700;
    font-size: 0.85rem;
    letter-spacing: 3px;
    padding: 12px 48px;
    border-radius: var(--radius-sm);
    transition: background 0.2s, transform 0.15s;
  }
  .btn-jelajahi:hover { background-color: var(--emas-terang); transform: translateY(-2px); }

  .btn-selengkapnya {
    display: inline-block;
    background-color: var(--emas);
    color: var(--teks-gelap);
    font-family: var(--font-isi);
    font-weight: 700;
    font-size: 0.8rem;
    letter-spacing: 2px;
    padding: 10px 36px;
    border-radius: var(--radius-sm);
    transition: background 0.2s;
  }
  .btn-selengkapnya:hover { background-color: var(--emas-terang); }

  .btn-baca {
    display: block;
    text-align: center;
    color: var(--emas);
    font-family: var(--font-judul);
    font-style: italic;
    font-size: 0.95rem;
    padding: 12px 0 4px;
    border-top: 1px solid #e8e0d4;
    margin-top: 12px;
    transition: color 0.2s;
  }
  .btn-baca:hover { color: var(--emas-terang); }

  .btn-review {
    color: var(--emas);
    font-family: var(--font-judul);
    font-style: italic;
    font-size: 0.9rem;
    background: none;
    border: none;
    cursor: pointer;
    transition: color 0.2s;
  }
  .btn-review:hover { color: var(--emas-terang); }

  .btn-primary {
    display: inline-block;
    background-color: var(--emas);
    color: var(--teks-gelap);
    font-family: var(--font-isi);
    font-weight: 700;
    font-size: 0.85rem;
    letter-spacing: 1.5px;
    padding: 12px 32px;
    border-radius: var(--radius-sm);
    border: none;
    cursor: pointer;
    transition: background 0.2s, transform 0.15s;
  }
  .btn-primary:hover { background-color: var(--emas-terang); transform: translateY(-1px); }

  .btn-secondary {
    display: inline-block;
    background: transparent;
    color: var(--emas);
    font-family: var(--font-isi);
    font-size: 0.85rem;
    letter-spacing: 1px;
    padding: 10px 28px;
    border-radius: var(--radius-sm);
    border: 1.5px solid var(--emas);
    cursor: pointer;
    transition: all 0.2s;
    margin-left: 12px;
  }
  .btn-secondary:hover { background: var(--emas); color: var(--teks-gelap); }

  .btn-kembali {
    display: inline-block;
    color: var(--emas);
    font-size: 0.9rem;
    margin-bottom: 24px;
    transition: color 0.2s;
  }
  .btn-kembali:hover { color: var(--emas-terang); }

  .link-emas { color: var(--emas); text-decoration: underline; }

  /* ================================================
    SECTION UMUM
    ================================================ */
  .section { padding: 48px 80px; }

  .page-header { padding: 40px 80px 0; text-align: center; }

  .page-title {
    font-family: var(--font-judul);
    font-size: 2.2rem;
    color: var(--emas);
    letter-spacing: 4px;
    margin-bottom: 8px;
  }

  .section-title {
    font-family: var(--font-judul);
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--emas);
    letter-spacing: 2px;
    margin-bottom: 24px;
  }

  .section-center { text-align: center; margin-top: 28px; }

  .sejarah-text {
    color: var(--putih-krem);
    font-size: 0.95rem;
    max-width: 860px;
    line-height: 1.8;
  }

  /* ================================================
    CARD GRID BERANDA (thumbnail + label)
    ================================================ */
  .card-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }

  .card {
    background: var(--putih);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: transform 0.2s;
  }
  .card:hover { transform: translateY(-3px); }

  .card img { width: 100%; height: 180px; object-fit: cover; }

  .card-label {
    padding: 10px 14px;
    font-family: var(--font-isi);
    font-size: 0.9rem;
    color: var(--teks-gelap);
    font-weight: 700;
  }

  .card-produk-bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 12px 16px;
  border-top: 1px solid var(--border);
  background: var(--bg2);
  }

  .card-label-produk {
    font-family: var(--font-isi);
    font-size: 0.65rem;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--krem-muda);
  }

  /* ================================================
    CARD DESTINASI / WARISAN / KULINER
    ================================================ */
  .card-grid-destinasi {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 28px;
  }

  .card-destinasi {
    background: var(--putih);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: transform 0.2s;
  }
  .card-destinasi:hover { transform: translateY(-4px); }

  .card-img-wrap img { width: 100%; height: 220px; object-fit: cover; }

  .card-destinasi-body { padding: 16px 20px 20px; }

  .card-destinasi-judul {
    font-family: var(--font-judul);
    font-size: 1.1rem;
    color: var(--emas);
    margin-bottom: 10px;
  }

  .card-destinasi-desc {
    font-size: 0.9rem;
    color: var(--teks-abu);
    line-height: 1.6;
  }

  /* ================================================
    GAME — baris horizontal
    ================================================ */
  .card-game-row {
    display: flex;
    background: var(--putih);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    margin-bottom: 28px;
  }

  .card-game-img { flex: 0 0 320px; }

  .card-game-img img { width: 100%; height: 260px; object-fit: cover; }

  .card-game-nama {
    background: var(--cokelat-tua);
    color: var(--putih);
    font-family: var(--font-isi);
    font-weight: 700;
    font-size: 0.85rem;
    letter-spacing: 2px;
    padding: 8px 16px;
  }

  .card-game-desc {
    flex: 1;
    padding: 24px 28px;
    color: var(--teks-abu);
    font-size: 0.95rem;
    line-height: 1.7;
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .game-cara-main h4 {
    font-family: var(--font-judul);
    color: var(--emas);
    font-size: 1rem;
    margin-bottom: 8px;
  }

  .game-cara-main p {
    font-size: 0.9rem;
    color: var(--teks-abu);
    white-space: pre-line;
  }

  .game-info { font-size: 0.85rem; color: var(--teks-abu); }

  .btn-main-game {
    display: inline-block;
    background: var(--emas);
    color: var(--teks-gelap);
    font-weight: 700;
    font-size: 0.85rem;
    padding: 10px 24px;
    border-radius: var(--radius-sm);
    align-self: flex-start;
    transition: background 0.2s;
  }
  .btn-main-game:hover { background: var(--emas-terang); }

  /* ================================================
    REVIEW FORM
    ================================================ */
  .review-form-wrap {
    max-width: 680px;
    margin: 0 auto;
    background: var(--cokelat-medium);
    border-radius: var(--radius);
    padding: 36px 40px;
  }

  .input-review {
    display: block;
    width: 100%;
    background: var(--putih);
    border: none;
    border-radius: var(--radius-sm);
    padding: 14px 16px;
    font-family: var(--font-isi);
    font-size: 0.95rem;
    color: var(--teks-gelap);
    margin-bottom: 16px;
    outline: none;
    transition: box-shadow 0.2s;
  }
  .input-review:focus { box-shadow: 0 0 0 2px var(--emas); }
  .textarea-review { resize: vertical; min-height: 140px; }

  /* Bintang interaktif */
  .star-rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
    gap: 8px;
    margin-bottom: 16px;
  }
  .star-rating input { display: none; }
  .star-rating label {
    font-size: 2.2rem;
    color: rgba(255,255,255,0.25);
    cursor: pointer;
    transition: color 0.15s;
  }
  .star-rating label:hover,
  .star-rating label:hover ~ label,
  .star-rating input:checked ~ label { color: var(--emas); }

  .btn-submit-review { width: 100%; padding: 14px; font-size: 0.9rem; letter-spacing: 2px; }

  .pesan-sukses {
    background: rgba(201,168,76,0.15);
    border: 1px solid var(--emas);
    color: var(--emas);
    padding: 12px 16px;
    border-radius: var(--radius-sm);
    margin-bottom: 20px;
    font-size: 0.9rem;
  }

  .pesan-error {
    background: rgba(200,50,50,0.15);
    border: 1px solid #c85050;
    color: #f08080;
    padding: 12px 16px;
    border-radius: var(--radius-sm);
    margin-bottom: 20px;
    font-size: 0.9rem;
  }

  /* Daftar review */
  .review-list {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 12px;
  }

  .review-card {
    background: var(--cokelat-medium);
    border-radius: var(--radius);
    padding: 20px 24px;
    border: 1px solid rgba(201,168,76,0.15);
  }

  .review-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
  }

  .review-nama { font-weight: 700; color: var(--emas); font-size: 0.95rem; }

  .review-jenis {
    font-size: 0.75rem;
    background: rgba(201,168,76,0.15);
    color: var(--emas);
    padding: 2px 10px;
    border-radius: 20px;
  }

  .star-on  { color: var(--emas); font-size: 1rem; }
  .star-off { color: rgba(255,255,255,0.2); font-size: 1rem; }

  .review-komentar {
    font-size: 0.9rem;
    color: var(--putih-krem);
    line-height: 1.6;
    margin: 8px 0;
  }

  .review-tanggal { font-size: 0.78rem; color: rgba(255,255,255,0.4); }

  /* Preview review di beranda */
  .review-preview { display: flex; flex-direction: column; gap: 12px; }
  .review-item {
    background: var(--cokelat-medium);
    border-radius: var(--radius-sm);
    padding: 16px 20px;
  }
  .review-item .review-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 8px;
  }

  .review-item .review-stars {
    margin-bottom: 8px;
  }

  .review-item .review-tanggal {
    font-size: 0.7rem;
    color: rgba(240,230,211,0.3);
    margin-top: 8px;
    letter-spacing: 0.5px;
  }

  /* ================================================
    FAQ
    ================================================ */
  .faq-container {
    max-width: 820px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .faq-item {
    background: var(--cokelat-medium);
    border-radius: var(--radius);
    overflow: hidden;
    border: 1px solid rgba(201,168,76,0.1);
  }

  .faq-question {
    width: 100%;
    background: none;
    border: none;
    padding: 18px 24px;
    text-align: left;
    color: var(--emas);
    font-family: var(--font-isi);
    font-size: 0.95rem;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
  }

  .faq-icon { font-size: 0.7rem; transition: transform 0.3s; flex-shrink: 0; }

  .faq-answer {
    display: none;
    padding: 16px 24px 20px;
    color: var(--putih-krem);
    font-size: 0.92rem;
    line-height: 1.7;
    border-top: 1px solid rgba(201,168,76,0.1);
  }

  /* ================================================
    TENTANG
    ================================================ */
  .tentang-container {
    max-width: 900px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 28px;
  }

  .tentang-card {
    background: var(--putih);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
  }

  .tentang-card-inner { display: flex; }

  .tentang-img-wrap { flex: 0 0 280px; }
  .tentang-img-wrap img { width: 100%; height: 260px; object-fit: cover; }

  .tentang-info {
    flex: 1;
    padding: 28px 32px;
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .tentang-nama { font-family: var(--font-judul); font-size: 1.3rem; color: var(--teks-gelap); }
  .tentang-role { color: var(--emas); font-weight: 700; font-size: 0.9rem; letter-spacing: 1px; }
  .tentang-nim,
  .tentang-prodi { font-size: 0.85rem; color: var(--teks-abu); }
  .tentang-desc  { font-size: 0.9rem; color: var(--teks-abu); line-height: 1.7; margin-top: 8px; }

  .tentang-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  /* ================================================
    DETAIL HALAMAN
    ================================================ */
  .detail-section { max-width: 900px; margin: 0 auto; }

  .detail-img-wrap {
    border-radius: var(--radius);
    overflow: hidden;
    margin-bottom: 28px;
  }
  .detail-img-wrap img { width: 100%; max-height: 420px; object-fit: cover; }

  .detail-body { display: flex; flex-direction: column; gap: 14px; }

  .detail-judul { font-family: var(--font-judul); font-size: 2rem; color: var(--emas); }

  .detail-kategori {
    display: inline-block;
    background: rgba(201,168,76,0.15);
    color: var(--emas);
    font-size: 0.8rem;
    padding: 4px 14px;
    border-radius: 20px;
    border: 1px solid rgba(201,168,76,0.3);
  }

  .detail-lokasi { font-size: 0.9rem; color: rgba(255,255,255,0.6); }

  .detail-deskripsi { font-size: 0.95rem; color: var(--putih-krem); line-height: 1.8; }

  .detail-resep {
    background: var(--cokelat-medium);
    border-radius: var(--radius-sm);
    padding: 20px 24px;
    margin-top: 8px;
  }
  .detail-resep-judul { font-family: var(--font-judul); color: var(--emas); font-size: 1.1rem; margin-bottom: 10px; }

  .detail-cara-main {
    background: var(--cokelat-medium);
    border-radius: var(--radius-sm);
    padding: 20px 24px;
  }
  .detail-cara-main h3 { font-family: var(--font-judul); color: var(--emas); font-size: 1.1rem; margin-bottom: 10px; }
  .detail-cara-main p  { font-size: 0.9rem; color: var(--putih-krem); white-space: pre-line; line-height: 1.8; }

  /* ================================================
    FOOTER
    ================================================ */
  .footer {
    background: var(--cokelat-navbar);
    padding: 48px 80px 0;
    margin-top: 48px;
  }

  .footer-content {
    display: flex;
    gap: 60px;
    padding-bottom: 40px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
  }

  .footer-brand h3 {
    font-family: var(--font-judul);
    font-size: 1.2rem;
    color: var(--emas);
    letter-spacing: 2px;
    margin-bottom: 8px;
  }
  .footer-brand p { font-size: 0.85rem; color: rgba(255,255,255,0.5); }

  .footer-links h4 {
    font-size: 0.85rem;
    color: var(--emas);
    letter-spacing: 1px;
    margin-bottom: 12px;
  }
  .footer-links ul { display: flex; flex-direction: column; gap: 8px; }
  .footer-links a { font-size: 0.85rem; color: rgba(255,255,255,0.5); transition: color 0.2s; }
  .footer-links a:hover { color: var(--emas); }

  .footer-bottom {
    text-align: center;
    padding: 16px 0;
    font-size: 0.8rem;
    color: rgba(255,255,255,0.3);
  }

  /* ================================================
    ADMIN PANEL
    ================================================ */
  .login-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .login-box {
    background: var(--cokelat-medium);
    border-radius: var(--radius);
    padding: 40px 48px;
    width: 100%;
    max-width: 400px;
    text-align: center;
    box-shadow: var(--shadow);
  }
  .login-box h2 { font-family: var(--font-judul); color: var(--emas); font-size: 1.6rem; margin-bottom: 6px; }
  .login-box p  { color: rgba(255,255,255,0.5); font-size: 0.85rem; margin-bottom: 28px; }
  .login-box input {
    display: block; width: 100%;
    background: var(--putih); border: none;
    border-radius: var(--radius-sm);
    padding: 12px 16px; font-size: 0.95rem;
    color: var(--teks-gelap); margin-bottom: 14px; outline: none;
  }
  .login-box input:focus { box-shadow: 0 0 0 2px var(--emas); }
  .login-box .btn-primary { width: 100%; margin-top: 8px; }
  .login-box .error { color: #f08080; font-size: 0.85rem; margin-bottom: 14px; }

  .admin-page { display: flex; min-height: 100vh; background: #f4f1eb; }

  .admin-sidebar {
    width: 220px;
    background: var(--cokelat-navbar);
    padding: 28px 0;
    flex-shrink: 0;
    position: sticky;
    top: 0;
    height: 100vh;
  }
  .admin-sidebar h3 {
    font-family: var(--font-judul); color: var(--emas);
    font-size: 1rem; letter-spacing: 2px;
    padding: 0 24px 20px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
    margin-bottom: 8px;
  }
  .admin-sidebar nav { display: flex; flex-direction: column; }
  .admin-sidebar a {
    padding: 11px 24px; font-size: 0.85rem;
    color: rgba(255,255,255,0.6); transition: all 0.2s;
  }
  .admin-sidebar a:hover,
  .admin-sidebar a.active {
    background: rgba(201,168,76,0.1);
    color: var(--emas);
    border-left: 3px solid var(--emas);
  }

  .admin-content { flex: 1; padding: 36px 40px; color: var(--teks-gelap); }
  .admin-content h2 { font-family: var(--font-judul); font-size: 1.5rem; color: var(--cokelat-tua); margin-bottom: 24px; }

  .stats-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; margin-bottom: 32px; }
  .stat-card {
    background: var(--putih); border-radius: var(--radius-sm);
    padding: 20px 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border-left: 4px solid var(--emas);
  }
  .stat-card h3 { font-size: 2rem; color: var(--cokelat-tua); font-family: var(--font-judul); }
  .stat-card p  { font-size: 0.82rem; color: var(--teks-abu); margin-top: 4px; }

  .admin-form {
    background: var(--putih); border-radius: var(--radius);
    padding: 28px 32px; margin-bottom: 28px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
  }
  .admin-form h3 { font-family: var(--font-judul); color: var(--cokelat-tua); font-size: 1.1rem; margin-bottom: 20px; }
  .admin-form input[type="text"],
  .admin-form input[type="number"],
  .admin-form input[type="file"],
  .admin-form textarea,
  .admin-form select {
    display: block; width: 100%;
    border: 1px solid #ddd; border-radius: var(--radius-sm);
    padding: 10px 14px; font-size: 0.9rem;
    font-family: var(--font-isi); color: var(--teks-gelap);
    background: #fafafa; margin-bottom: 14px; outline: none;
    transition: border-color 0.2s;
  }
  .admin-form input:focus,
  .admin-form textarea:focus,
  .admin-form select:focus { border-color: var(--emas); }
  .admin-form textarea { min-height: 100px; resize: vertical; }
  .admin-form label { font-size: 0.85rem; color: var(--teks-abu); display: block; margin-bottom: 6px; }
  .admin-form img   { border-radius: var(--radius-sm); margin: 6px 0 12px; }

  .admin-table {
    width: 100%; border-collapse: collapse;
    background: var(--putih); border-radius: var(--radius);
    overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    font-size: 0.88rem;
  }
  .admin-table thead { background: var(--cokelat-tua); color: var(--emas); }
  .admin-table th { padding: 13px 16px; text-align: left; font-weight: 700; letter-spacing: 0.5px; }
  .admin-table td { padding: 12px 16px; border-bottom: 1px solid #f0ebe3; color: var(--teks-gelap); vertical-align: middle; }
  .admin-table tr:hover td { background: #faf6f0; }

  .btn-edit {
    display: inline-block; background: var(--emas);
    color: var(--teks-gelap); font-size: 0.78rem; font-weight: 700;
    padding: 5px 14px; border-radius: 4px; margin-right: 6px; transition: background 0.2s;
  }
  .btn-edit:hover { background: var(--emas-terang); }

  .btn-hapus {
    display: inline-block; background: #c0392b;
    color: var(--putih); font-size: 0.78rem; font-weight: 700;
    padding: 5px 14px; border-radius: 4px; transition: background 0.2s;
  }
  .btn-hapus:hover { background: #e74c3c; }

  .success {
    background: rgba(39,174,96,0.1); border: 1px solid #27ae60;
    color: #27ae60; padding: 10px 16px;
    border-radius: var(--radius-sm); margin-bottom: 16px; font-size: 0.88rem;
  }

  /* ================================================
    RESPONSIVE
    ================================================ */
  @media (max-width: 768px) {
    .navbar { padding: 0 20px; }
    .hamburger { display: block; }

    .nav-links {
      display: none;
      flex-direction: column;
      position: absolute;
      top: 56px; left: 0; right: 0;
      background: var(--cokelat-navbar);
      padding: 16px 24px;
      gap: 16px;
    }
    .nav-links.open { display: flex; }

    .section       { padding: 32px 20px; }
    .page-header   { padding: 28px 20px 0; }
    .page-title    { font-size: 1.6rem; }
    .section-title { font-size: 1.3rem; }
    .hero          { height: 320px; }

    .card-grid           { grid-template-columns: 1fr; }
    .card-grid-destinasi { grid-template-columns: 1fr; }
    .review-list         { grid-template-columns: 1fr; }
    .stats-grid          { grid-template-columns: repeat(2,1fr); }

    .card-game-row     { flex-direction: column; }
    .card-game-img     { flex: none; }
    .card-game-desc    { padding: 20px; }

    .tentang-card-inner  { flex-direction: column; }
    .tentang-img-wrap    { flex: none; }
    .tentang-img-wrap img { height: 220px; }

    .footer         { padding: 36px 20px 0; }
    .footer-content { flex-direction: column; gap: 28px; }

    .admin-page    { flex-direction: column; }
    .admin-sidebar { width: 100%; height: auto; position: relative; }
    .admin-content { padding: 20px; }
}