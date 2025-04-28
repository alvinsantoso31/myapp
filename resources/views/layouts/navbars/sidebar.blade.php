<div class="sidebar" data-image="{{ asset('light-bootstrap/img/sidebar-5.jpg') }}">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->
    <style>
        .sidebar .collapse.show {
            background: rgba(255, 255, 255, 0.05);
            padding: 0.5rem 0 0.5rem 1rem;
            border-left: 3px solid #fff;
        }

        .sidebar .nav .nav>.nav-item>a {
            color: #fefefe;
            font-weight: 500;
            padding-left: 1.5rem;
        }

        .sidebar .nav .nav>.nav-item.active>a {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 4px;
        }
    </style>
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text">
                {{ __('Creative Tim') }}
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item @if ($activePage == 'dashboard') active @endif">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#laravelExamples"
                    aria-expanded="{{ $activeButton == 'laravel' ? 'true' : 'false' }}">
                    <i>
                        <img src="{{ asset('light-bootstrap/img/laravel.svg') }}" style="width:25px">
                    </i>
                    <p>
                        {{ __('Master') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ $activeButton == 'laravel' ? 'show' : '' }}" id="laravelExamples">
                    <ul class="nav">
                        <li class="nav-item @if ($activePage == 'crew.index') active @endif">
                            <a class="nav-link" href="{{ URL('crew') }}">
                                <i class="nc-icon nc-single-02"></i>
                                <p>{{ __('Crew') }}</p>
                            </a>
                        </li>

                        <li class="nav-item @if ($activePage == 'event.index') active @endif">
                            <a class="nav-link" href="{{ URL('event') }}">
                                <i class="nc-icon nc-puzzle-10"></i>
                                <p>{{ __('History Event') }}</p>
                            </a>
                        </li>

                        <li class="nav-item @if ($activePage == 'jobdesk.index') active @endif">
                            <a class="nav-link" href="{{ URL('jobDesk') }}">
                                <i class="nc-icon nc-tag-content"></i>
                                <p>{{ __('Job desk') }}</p>
                            </a>
                        </li>

                        <li class="nav-item @if ($activePage == 'detail_events.index') active @endif">
                            <a class="nav-link" href="{{ URL('detailEvents') }}">
                                <i class="nc-icon nc-tag-content"></i>
                                <p>{{ __('Detail Event') }}</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#financeExamples"
                    aria-expanded="{{ $activeButton == 'finance' ? 'true' : 'false' }}">

                    <i class="nc-icon nc-money-coins">

                    </i>
                    <p>
                        {{ __('Finance') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ $activeButton == 'finance' ? 'show' : '' }}" id="financeExamples">

                    <ul class="nav">
                        <li class="nav-item @if ($activePage == 'rule_penggajian.index') active @endif">
                            <a class="nav-link" href="{{ URL('rulePenggajian') }}">
                                <i class="nc-icon nc-single-copy-04"></i>
                                <p>{{ __('Rule Penggajian') }}</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </li>
            <li class="nav-item @if ($activePage == 'dashboard') active @endif">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a class="nav-link text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nc-icon nc-button-power"></i>
                        logout
                    </a>
                </form>

            </li>

        </ul>
    </div>
</div>
