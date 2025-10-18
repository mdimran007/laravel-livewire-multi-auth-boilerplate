        <div class="app-menu">

            <!-- Sidenav Brand Logo -->
            <a href="index.html" class="logo-box">
                <!-- Light Brand Logo -->
                <div class="logo-light">
                    <img src="{{asset('assets/admin')}}/images/logo-light.png" class="logo-lg h-6" alt="Light logo">
                    <img src="{{asset('assets/admin')}}/images/logo-sm.png" class="logo-sm" alt="Small logo">
                </div>

                 <!-- Dark Brand Logo -->
                <div class="logo-dark">
                    <img src="{{asset('assets/admin')}}/images/logo-dark.png" class="logo-lg h-6" alt="Dark logo">
                    <img src="{{asset('assets/admin')}}/images/logo-sm.png" class="logo-sm" alt="Small logo">
                </div>
            </a>

            <!-- Sidenav Menu Toggle Button -->
            <button id="button-hover-toggle" class="absolute top-5 end-2 rounded-full p-1.5">
                <span class="sr-only">Menu Toggle Button</span>
                <i class="mgc_round_line text-xl"></i>
            </button>

            <!--- Menu -->
            <div class="srcollbar" data-simplebar>
                <ul class="menu" data-fc-type="accordion">
                    <li class="menu-title"></li>

                    <li class="menu-item">
                        <a href="index.html" class="menu-link">
                            <span class="menu-icon"><i class="mgc_home_3_line"></i></span>
                            <span class="menu-text"> Dashboard </span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                            <span class="menu-icon"><i class="mgc_user_3_line"></i></span>
                            <span class="menu-text"> Users </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul class="sub-menu hidden">
                            <li class="menu-item">
                                <a href="auth-login.html" class="menu-link">
                                    <span class="menu-text">Users List</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="auth-register.html" class="menu-link">
                                    <span class="menu-text">Role & Permission</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="menu-item">
                        <a href="index.html" class="menu-link">
                            <span class="menu-icon"><i class="mgc_building_2_line"></i></span>
                            <span class="menu-text"> Goals </span>
                        </a>
                    </li>


                    
                    <li class="menu-item">
                        <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                            <span class="menu-icon"><i class="mgc_box_3_line"></i></span>
                            <span class="menu-text"> Settings </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul class="sub-menu hidden">
                            <li class="menu-item">
                                <a href="pages-starter.html" class="menu-link">
                                    <span class="menu-text">Profile</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="pages-timeline.html" class="menu-link">
                                    <span class="menu-text">General Settings</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>