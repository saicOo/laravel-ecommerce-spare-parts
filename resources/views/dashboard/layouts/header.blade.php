<div class="header">
    <div class="header-content clearfix">

        <div class="header-right">

            <ul class="clearfix">
                <li class="icons d-none d-md-flex">
                    <a href="javascript:void(0)" class="window_fullscreen-x">
                        <i class="icon-frame"></i>
                    </a>
                </li>
                <li class="icons">
                    <a href="javascript:void(0)" class="">
                        <i class="icon-flag"></i>
                        <span class="badge badge-info">{{ app()->getLocale() == 'ar' ? 'ar' : 'en' }}</span>
                    </a>
                    <div class="drop-down dropdown-profile animated flipInX">
                        <div class="dropdown-content-body">
                            <ul>
                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li>
                                        <a rel="alternate" hreflang="{{ $localeCode }}"
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            {{ $properties['native'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="icons">
                    <div class="user-img c-pointer-x">
                        <span class="activity active"></span>
                        <img src="{{ asset('dashboard/assets/images/user/1.png') }}" height="40" width="40"
                            alt="avatar">
                    </div>
                    <div class="drop-down dropdown-profile animated flipInX">
                        <div class="dropdown-content-body">
                            <ul>
                                <li><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();"><i
                                            class="icon-key"></i> <span>{{ __('site.logout') }}</span></a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
