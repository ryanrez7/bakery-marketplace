<form class="search" role="search" action="{{ $actionRoute }}" method="GET">
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    <circle cx="11" cy="11" r="7"></circle>
    <line x1="21" y1="21" x2="16.5" y2="16.5"></line>
  </svg>
  <input type="search" name="search" value="{{ request('search') }}" placeholder="Search..." aria-label="Cari">
</form>