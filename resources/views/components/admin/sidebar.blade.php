        <div class="app-menu">

            <!-- Sidenav Brand Logo -->
            <a href="index.html" class="bg-gray-900 logo-box">
                 <!-- Dark Brand Logo -->
                <div class="logo-dark">
                    <img src="{{ getSettingData('app_logo') != null? getSettingData('app_logo'): asset('assets/no-image.png') }}" class="logo-lg h-6" alt="Dark logo">
                    <img src="{{ getSettingData('app_logo') != null? getSettingData('app_logo'): asset('assets/no-image.png') }}" class="logo-sm" alt="Small logo">
                </div>
            </a>

            <!-- Sidenav Menu Toggle Button -->
            <button id="button-hover-toggle" class="absolute top-5 end-2 rounded-full p-1.5">
                <span class="sr-only">Menu Toggle Button</span>
                <i class="mgc_round_line text-xl"></i>
            </button>

            <!--- Menu -->
            <div class="bg-gray-900 srcollbar" data-simplebar>
                <ul class="menu" data-fc-type="accordion">
                    <li class="menu-title"></li>

                    <li class="menu-item">
                        <a href="{{ route('admin.dashboard') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_home_3_line"></i></span>
                            <span class="menu-text"> {{ __('Dashboard') }} </span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                            <span class="menu-icon"><i class="mgc_user_3_line"></i></span>
                            <span class="menu-text"> {{ __('Users') }} </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul class="sub-menu hidden">
                            <li class="menu-item">
                                <a href="{{ route('admin.users') }}" class="menu-link">
                                    <span class="menu-text">{{ __('Users List') }}</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="auth-register.html" class="menu-link">
                                    <span class="menu-text">{{ __('Role & Permission') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="menu-item">
                        <a href="{{ route('admin.goals') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_building_2_line"></i></span>
                            <span class="menu-text"> {{ __('Goals') }} </span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('admin.policy.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_document_line"></i></span>
                            <span class="menu-text">{{ __('Policy') }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('admin.services.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_server_line"></i></span>
                            <span class="menu-text">{{ __('Services') }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('admin.programmes.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_calendar_line"></i></span>
                            <span class="menu-text">{{ __('Programmes') }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('admin.events.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_clock_2_line"></i></span>
                            <span class="menu-text">{{ __('Events') }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('admin.partnerships.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_user_5_line"></i></span>
                            <span class="menu-text">{{ __('Partnerships') }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('admin.facilities.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_building_2_line"></i></span>
                            <span class="menu-text">{{ __('Facilities') }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('admin.research.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_search_line"></i></span>
                            <span class="menu-text">{{ __('Research') }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('admin.report.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_report_line"></i></span>
                            <span class="menu-text">{{ __('Report') }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('admin.news.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="mgc_news_line"></i></span>
                            <span class="menu-text">{{ __('News') }}</span>
                        </a>
                    </li>




                    <li class="menu-item">
                        <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                            <span class="menu-icon"><i class="mgc_box_3_line"></i></span>
                            <span class="menu-text"> {{ __('Settings') }} </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul class="sub-menu hidden">
                            <li class="menu-item">
                                <a href="{{ route('admin.profile.update') }}" class="menu-link">
                                    <span class="menu-text">{{ __('Profile') }}</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.general.settings') }}" class="menu-link">
                                    <span class="menu-text">{{ __('General Settings') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
