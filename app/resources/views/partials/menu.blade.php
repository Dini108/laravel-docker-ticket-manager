<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("systemCalendar") }}"
                   class="nav-link {{ request()->is('system-calendar') || request()->is('system-calendar/*') ? 'active' : '' }}">
                    <i class="nav-icon fa-fw fas fa-calendar">

                    </i>
                    {{ trans('global.eventCalendar') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("tickets.index") }}"
                   class="nav-link {{ request()->is('tickets') || request()->is('tickets/*') ? 'active' : '' }}">
                    <i class="fa fa-ticket nav-icon">

                    </i>
                    {{ trans('cruds.ticket.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("users.index") }}"
                   class="nav-link {{ request()->is('users') || request()->is('users/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-user nav-icon">

                    </i>
                    {{ trans('cruds.user.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("performers.index") }}"
                   class="nav-link {{ request()->is('performers') || request()->is('performers/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-user nav-icon">

                    </i>
                    {{ trans('cruds.performer.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("places.index") }}"
                   class="nav-link {{ request()->is('places') || request()->is('places/*') ? 'active' : '' }}">
                    <i class="fa fa-map-marker nav-icon">

                    </i>
                    {{ trans('cruds.place.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("events.index") }}"
                   class="nav-link {{ request()->is('events') || request()->is('events/*') ? 'active' : '' }}">
                    <i class="fa fa-music nav-icon">

                    </i>
                    {{ trans('cruds.event.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"
                   onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>
    </nav>
</div>
