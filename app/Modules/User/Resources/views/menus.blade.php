
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pilihan Menu - Bakery Marketplace</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/sidebar-user.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard-user.css') }}">
  <link rel="stylesheet" href="{{ asset('css/menus.css') }}">
</head>

<body>

  @include('user::components.sidebar')

  <main class="main">

    <form class="search" role="search" action="{{ route('menus.index') }}" method="GET">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <circle cx="11" cy="11" r="7"></circle>
        <line x1="21" y1="21" x2="16.5" y2="16.5"></line>
      </svg>

      <input
        type="search"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search..."
        aria-label="Cari"
      >
    </form>

    <section class="section">
      <div class="section-head">
        <h1 class="section-title">Pilihan Menu</h1>
      </div>

      <div class="list">

        @forelse($menus as $menu)

          <a href="{{ route('menus.show', $menu->id) }}" class="item">

            <img
              src="{{ $menu->image ? asset('storage/' . $menu->image) : asset('images/soft-cookies.jpg') }}"
              alt="{{ $menu->nama_produk }}"
              class="item-img"
            >

            <div class="item-info">

              <h2 class="item-name">
                {{ $menu->nama_produk }} - {{ $menu->toko->nama_toko ?? 'Toko' }}
              </h2>

              <p class="item-price">
                Rp. {{ number_format($menu->harga, 0, ',', '.') }}
              </p>

              <p class="item-address">
                {{ $menu->toko->alamat ?? 'Alamat toko' }}
              </p>

            </div>
          </a>

        @empty

          <p style="padding: 20px; text-align: center;">
            Belum ada menu yang tersedia.
          </p>

        @endforelse

      </div>
    </section>

    <!-- Paginasi -->
    <nav class="pagination" aria-label="Halaman">

      <a
        href="{{ $menus->previousPageUrl() ?? '#' }}"
        class="page-btn"
        aria-label="Sebelumnya"
      >
        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="15 5 8 12 15 19"></polyline>
        </svg>
      </a>

      <ul class="page-numbers">

        @foreach($menus->getUrlRange(1, $menus->lastPage()) as $page => $url)

          <li>
            <a
              href="{{ $url }}"
              class="{{ $menus->currentPage() == $page ? 'active' : '' }}"
              @if($menus->currentPage() == $page) aria-current="page" @endif
            >
              {{ $page }}
            </a>
          </li>

        @endforeach

      </ul>

      <a
        href="{{ $menus->nextPageUrl() ?? '#' }}"
        class="page-btn"
        aria-label="Berikutnya"
      >
        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="9 5 16 12 9 19"></polyline>
        </svg>
      </a>

    </nav>

  </main>

</body>
</html>
