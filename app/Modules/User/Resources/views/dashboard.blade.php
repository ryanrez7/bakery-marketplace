<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda - Bakery Marketplace</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
  
  <!-- css -->
  <link rel="stylesheet" href="{{ asset('css/sidebar-user.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard-user.css') }}">
</head>
<body>

@include('user::components.sidebar')
  <main class="main">

    <form class="search" role="search" action="{{ route('dashboard') }}" method="GET">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <circle cx="11" cy="11" r="7"></circle>
        <line x1="21" y1="21" x2="16.5" y2="16.5"></line>
      </svg>
      <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari menu atau toko..." aria-label="Cari">
    </form>

    <section class="section">
      <div class="section-head">
        <h2 class="section-title">Pilihan Menu</h2>
        <a href="{{ route('menus.index') }}" class="see-all">
          Lihat Semua
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="10 8 14 12 10 16"></polyline>
          </svg>
        </a>
      </div>

      <div class="grid">
        @forelse($menus as $menu)
          <a href="{{ route('menus.show', $menu->id) }}" class="card">
            <img src="{{ asset('images/default-menu.jpg') }}" alt="{{ $menu->name }}" class="card-img">
            <h3 class="card-name">{{ $menu->name }}</h3>
            <p class="card-price">Rp. {{ number_format($menu->price, 0, ',', '.') }}</p>
            <p class="card-shop">{{ $menu->store->name ?? 'Toko' }}</p>
          </a>
        @empty
          <div style="grid-column: 1 / -1; text-align: center; padding: 20px; color: #777; font-style: italic;">
            Belum ada menu atau produk dari outlet saat ini.
          </div>
        @endforelse
      </div>
    </section>

    <!-- Toko -->
    <section class="section">
      <div class="section-head">
        <h2 class="section-title">Toko</h2>
        <a href="{{ route('stores.index') }}" class="see-all">
          Lihat Semua
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="10 8 14 12 10 16"></polyline>
          </svg>
        </a>
      </div>

      <div class="grid">
        @forelse($stores as $store)
          <a href="{{ route('stores.show', $store->id) }}" class="card">
            <img src="{{ asset('images/default-store.jpg') }}" alt="{{ $store->name }}" class="card-img">
            <h3 class="card-name">{{ $store->name }}</h3>
          </a>
        @empty
          <div style="grid-column: 1 / -1; text-align: center; padding: 20px; color: #777; font-style: italic;">
            Belum ada mitra toko yang terdaftar.
          </div>
        @endforelse
      </div>
    </section>

  </main>

</body>
</html>