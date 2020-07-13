@section('navbar')
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar__brand navbar__mainLogo" href="/"></a>
          <ul class="navbar-nav ml-md-auto align-items-center">
            <li>
              <a class="btn btn-primary" href="/posts/new">投稿</a>
            </li>
            <li>
            <a class="nav-link commonNavIcon profile-icon" href="/users/{{ Auth::user()->id }}"></a>
            </li>
          </ul>
      </div>
    </nav>
@endsection
