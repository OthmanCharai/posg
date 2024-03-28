<template>
    <!-- Header -->
    <div class="header">
        <!-- Logo -->
        <div class="header-left active">
            <router-link to="/dashboard" class="logo logo-normal">
                <img src="./../../assets/img/logo.png" alt="">
            </router-link>
            <router-link to="/dashboard" class="logo logo-white">
                <img src="./../../assets/img/logo-white.png" alt="">
            </router-link>
            <router-link to="/dashboard" class="logo-small">
                <img src="./../../assets/img/logo-small.png" alt="">
            </router-link>
            <a id="toggle_btn" href="javascript:void(0);" @click="toggleSidebar">
                <vue-feather type="chevrons-left"></vue-feather>
            </a>
        </div>
        <!-- /Logo -->

        <a id="mobile_btn" class="mobile_btn" href="javascript:void(0);" @click="toggleSidebar1">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>

        <!-- Header Menu -->
        <ul class="nav user-menu">

            <!-- Search -->
            <li class="nav-item nav-searchinputs">
                <div class="top-nav-search">
                    <a href="javascript:void(0);" class="responsive-search">
                        <i class="fa fa-search"></i>
                    </a>
                    <form action="javascript:void(0);" class="dropdown">
                        <div class="searchinputs dropdown-toggle" id="dropdownMenuClickable" data-bs-toggle="dropdown"
                            data-bs-auto-close="false">
                            <input type="text" placeholder="Search">
                            <div class="search-addon">
                                <span><vue-feather type="x-circle" class="feather-14"></vue-feather></span>
                            </div>
                        </div>
                        <div class="dropdown-menu search-dropdown" aria-labelledby="dropdownMenuClickable">
                            <div class="search-info">
                                <h6><span><vue-feather type="search" class="feather-16"></vue-feather></span>Recent Searches
                                </h6>
                                <ul class="search-tags">
                                    <li><a href="javascript:void(0);">Products</a></li>
                                    <li><a href="javascript:void(0);">Sales</a></li>
                                    <li><a href="javascript:void(0);">Applications</a></li>
                                </ul>
                            </div>
                            <div class="search-info">
                                <h6><span><vue-feather type="help-circle" class="feather-16"></vue-feather></span>Help</h6>
                                <p>How to Change Product Volume from 0 to 200 on Inventory management</p>
                                <p>Change Product Name</p>
                            </div>
                            <div class="search-info">
                                <h6><span><vue-feather type="user" class="feather-16"></vue-feather></span>Customers</h6>
                                <ul class="customers">
                                    <li>
                                        <a href="javascript:void(0);">Aron Varu<img src="./../../assets/img/profiles/avator1.jpg"
                                                alt="" class="img-fluid"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Jonita<img src="./../../assets/img/profiles/avatar-01.jpg"
                                                alt="" class="img-fluid"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Aaron<img src="./../../assets/img/profiles/avatar-10.jpg"
                                                alt="" class="img-fluid"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <!-- /Search -->


            <!-- Select Store -->
            <li class="nav-item dropdown has-arrow main-drop select-store-dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link select-store" data-bs-toggle="dropdown">
                    <span class="user-info">
                        <span class="user-letter">
                            <img src="./../../assets/img/store/store-01.png" alt="Store Logo" class="img-fluid">
                        </span>
                        <span class="user-detail">
                            <span class="user-name">Select Store</span>
                        </span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="javascript:void(0);" class="dropdown-item">
                        <img src="./../../assets/img/store/store-01.png" alt="Store Logo" class="img-fluid"> Grocery Alpha
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item">
                        <img src="./../../assets/img/store/store-02.png" alt="Store Logo" class="img-fluid"> Grocery Apex
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item">
                        <img src="./../../assets/img/store/store-03.png" alt="Store Logo" class="img-fluid"> Grocery Bevy
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item">
                        <img src="./../../assets/img/store/store-04.png" alt="Store Logo" class="img-fluid"> Grocery Eden
                    </a>
                </div>
            </li>
            <!-- /Select Store -->

            <!-- Flag -->
            <li class="nav-item dropdown has-arrow flag-nav nav-item-box">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button">
                    <img src="./../../assets/img/flags/us.png" alt="Language" class="img-fluid">
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="javascript:void(0);" class="dropdown-item active">
                        <img src="./../../assets/img/flags/us.png" alt="" height="16"> English
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item">
                        <img src="./../../assets/img/flags/fr.png" alt="" height="16"> French
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item">
                        <img src="./../../assets/img/flags/es.png" alt="" height="16"> Spanish
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item">
                        <img src="./../../assets/img/flags/de.png" alt="" height="16"> German
                    </a>
                </div>
            </li>
            <!-- /Flag -->

            <li class="nav-item nav-item-box">
                <a href="javascript:void(0);" id="btnFullscreen" @click="initFullScreen">
                    <vue-feather type="maximize"></vue-feather>
                </a>
            </li>
            <li class="nav-item nav-item-box">
                <router-link to="/application/email">
                    <vue-feather type="mail"></vue-feather>
                    <span class="badge rounded-pill">1</span>
                </router-link>
            </li>
            <!-- Notifications -->
            <li class="nav-item dropdown nav-item-box">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <vue-feather type="bell"></vue-feather><span class="badge rounded-pill">2</span>
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                        <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            <li class="notification-message">
                                <router-link to="/activities">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img alt="" src="./../../assets/img/profiles/avatar-02.jpg">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span class="noti-title">John Doe</span> added
                                                new task <span class="noti-title">Patient appointment booking</span>
                                            </p>
                                            <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                            </p>
                                        </div>
                                    </div>
                                </router-link>
                            </li>
                            <li class="notification-message">
                                <router-link to="/activities">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img alt="" src="./../../assets/img/profiles/avatar-03.jpg">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span class="noti-title">Tarah Shropshire</span>
                                                changed the task name <span class="noti-title">Appointment booking
                                                    with payment gateway</span>
                                            </p>
                                            <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                            </p>
                                        </div>
                                    </div>
                                </router-link>
                            </li>
                            <li class="notification-message">
                                <router-link to="/activities">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img alt="" src="./../../assets/img/profiles/avatar-06.jpg">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span class="noti-title">Misty Tison</span>
                                                added <span class="noti-title">Domenic Houston</span> and <span
                                                    class="noti-title">Claire Mapes</span> to project <span
                                                    class="noti-title">Doctor available module</span>
                                            </p>
                                            <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                            </p>
                                        </div>
                                    </div>
                                </router-link>
                            </li>
                            <li class="notification-message">
                                <router-link to="/activities">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img alt="" src="./../../assets/img/profiles/avatar-17.jpg">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span class="noti-title">Rolland Webber</span>
                                                completed task <span class="noti-title">Patient and Doctor video
                                                    conferencing</span>
                                            </p>
                                            <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
                                        </div>
                                    </div>
                                </router-link>
                            </li>
                            <li class="notification-message">
                                <router-link to="/activities">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img alt="" src="./../../assets/img/profiles/avatar-13.jpg">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span>
                                                added new task <span class="noti-title">Private chat module</span>
                                            </p>
                                            <p class="noti-time"><span class="notification-time">2 days ago</span></p>
                                        </div>
                                    </div>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <router-link to="/activities">View all Notifications</router-link>
                    </div>
                </div>
            </li>
            <!-- /Notifications -->

            <li class="nav-item nav-item-box">
                <router-link to="/settings/general-settings"><vue-feather type="settings"></vue-feather></router-link>
            </li>
            <li class="nav-item dropdown has-arrow main-drop">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                    <span class="user-info">
                        <span class="user-letter">
                            <img src="./../../assets/img/profiles/avator1.jpg" alt="" class="img-fluid">
                        </span>
                        <span class="user-detail">
                            <span class="user-name">John Smilga</span>
                            <span class="user-role">Super Admin</span>
                        </span>
                    </span>
                </a>
                <div class="dropdown-menu menu-drop-user">
                    <div class="profilename">
                        <div class="profileset">
                            <span class="user-img"><img src="./../../assets/img/profiles/avator1.jpg" alt="">
                                <span class="status online"></span></span>
                            <div class="profilesets">
                                <h6>John Smilga</h6>
                                <h5>Super Admin</h5>
                            </div>
                        </div>
                        <hr class="m-0">
                        <router-link class="dropdown-item" to="/pages/profile"> <vue-feather class="me-2"
                                type="user"></vue-feather> My
                            Profile</router-link>
                        <router-link class="dropdown-item" to="/settings/general-settings"><vue-feather class="me-2"
                                type="settings"></vue-feather>Settings</router-link>
                        <hr class="m-0">
                        <router-link class="dropdown-item logout pb-0" to="/"><img src="./../../assets/img/icons/log-out.svg"
                                class="me-2" alt="img">Logout</router-link>
                    </div>
                </div>
            </li>
        </ul>
        <!-- /Header Menu -->

        <!-- Mobile Menu -->
        <div class="dropdown mobile-user-menu">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <router-link class="dropdown-item" to="/pages/profile">My Profile</router-link>
                <router-link class="dropdown-item" to="/settings/general-settings">Settings</router-link>
                <router-link class="dropdown-item" to="/">Logout</router-link>
            </div>
        </div>
        <!-- /Mobile Menu -->
    </div>
    <!-- /Header -->

    <side-settings></side-settings>
</template>

<script>
export default {
    data() {
        return {};
    },
    mounted() {
        this.initMouseoverListener();
    },
    methods: {
        toggleSidebar1() {
            const body = document.body;
            body.classList.toggle("slide-nav");
        },
        toggleSidebar() {
            const body = document.body;
            body.classList.toggle("mini-sidebar");
        },
        initFullScreen() {
            document.body.classList.toggle("fullscreen-enable");
            if (
                !document.fullscreenElement &&
                /* alternative standard method */
                !document.mozFullScreenElement &&
                !document.webkitFullscreenElement
            ) {
                // current working methods
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            } else {
                if (document.cancelFullScreen) {
                    document.cancelFullScreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                }
            }
        },

        initMouseoverListener() {
            document.addEventListener('mouseover', this.handleMouseover);
        },
        handleMouseover(e) {
            e.stopPropagation();

            const body = document.body;
            const toggleBtn = document.getElementById('toggle_btn');

            if (body.classList.contains('mini-sidebar') && this.isElementVisible(toggleBtn)) {
                const target = e.target.closest('.sidebar, .header-left');

                if (target) {
                    body.classList.add('expand-menu');
                    this.slideDownSubmenu();
                } else {
                    body.classList.remove('expand-menu');
                    this.slideUpSubmenu();
                }

                e.preventDefault();
            }
        },
        isElementVisible(element) {
            return element.offsetWidth > 0 || element.offsetHeight > 0;
        },
        slideDownSubmenu() {
            const subdropPlusUl = document.getElementsByClassName('subdrop');
            for (let i = 0; i < subdropPlusUl.length; i++) {
                const submenu = subdropPlusUl[i].nextElementSibling;
                if (submenu && submenu.tagName.toLowerCase() === 'ul') {
                    submenu.style.display = 'block';
                }
            }
        },
        slideUpSubmenu() {
            const subdropPlusUl = document.getElementsByClassName('subdrop');
            for (let i = 0; i < subdropPlusUl.length; i++) {
                const submenu = subdropPlusUl[i].nextElementSibling;
                if (submenu && submenu.tagName.toLowerCase() === 'ul') {
                    submenu.style.display = 'none';
                }
            }
        },
    },
    beforeUnmount() {
        document.removeEventListener('mouseover', this.handleMouseover);
    },
};
</script>