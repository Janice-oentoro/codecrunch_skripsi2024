<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
            <a class="navbar-brand text-light fw-bold" href="/">
                <img src="{{ asset('storage/images/code_crunch_no_text.png') }}" alt="" width="30" height="30" class="d-inline-block align-text-top">
                Code Crunch
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                <li class="nav-item active">
                    <a class="nav-link text-light fw-bold" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fw-bold" href="/about">About</a>
                </li>

                @if(Auth::check())
                    @if(Auth::user()->role == "admin")
                    <li class="nav-item">
                        <a class="nav-link text-light fw-bold" href="/requestlist">Requests</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-light fw-bold" href="/userlist">Users</a>
                    </li>
                    @endif
                
                    @if(Auth::user()->role == "user" || Auth::user()->role == "consultant")
                    <li class="nav-item">
                        <a class="nav-link text-light fw-bold" href="/consultation">Consultation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light fw-bold" href="/transactionhistory">Transaction</a>
                    </li>            
                    @endif   
                
                <li class="nav-item">
                    <a class="nav-link text-light fw-bold" href="/chatify">Chat</a>
                </li>

                @endif
                </ul>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-light fw-bold" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-light fw-bold" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown text-light fw-bold" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->role == "consultant" || Auth::user()->role == "user")
                                    <a class="dropdown-item text-dark fw-bold" href="/editprofile">Edit Profile</a>
                                    @endif

                                    @if(Auth::user()->role == "consultant")
                                    <a class="dropdown-item text-dark fw-bold" href="/feedback">Feedback</a>
                                    @endif

                                    <a class="dropdown-item text-dark fw-bold" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
            </div>
    </div>
</nav>
