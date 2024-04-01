<script setup lang="ts">
import logo from '@/src/assets/img/logo/logo-login.png';

const toggleSidebar1 = () => {
    const body = document.body;
    body.classList.toggle("slide-nav");
};

const toggleSidebar = () => {
    const body = document.body;
    body.classList.toggle("mini-sidebar");
};

const initFullScreen = () => {
    document.body.classList.toggle("fullscreen-enable");
    if (
        !document.fullscreenElement &&
        !document.mozFullScreenElement &&
        !document.webkitFullscreenElement
    ) {
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
};

const isElementVisible = (element: HTMLElement) => {
    return element.offsetWidth > 0 || element.offsetHeight > 0;
};

const slideDownSubmenu = () => {
    const subdropPlusUl = document.getElementsByClassName('subdrop');
    for (let i = 0; i < subdropPlusUl.length; i++) {
        const submenu = subdropPlusUl[i].nextElementSibling;
        if (submenu && submenu.tagName.toLowerCase() === 'ul') {
            submenu.style.display = 'block';
        }
    }
};

const slideUpSubmenu = () => {
    const subdropPlusUl = document.getElementsByClassName('subdrop');
    for (let i = 0; i < subdropPlusUl.length; i++) {
        const submenu = subdropPlusUl[i].nextElementSibling;
        if (submenu && submenu.tagName.toLowerCase() === 'ul') {
            submenu.style.display = 'none';
        }
    }
};

// Event listener handler
const handleMouseover = (e: MouseEvent) => {
    e.stopPropagation();

    const body = document.body;
    const toggleBtn = document.getElementById('toggle_btn');

    if (body.classList.contains('mini-sidebar') && isElementVisible(toggleBtn as HTMLElement)) {
        const target = e.target.closest('.sidebar, .header-left');

        if (target) {
            body.classList.add('expand-menu');
            slideDownSubmenu();
        } else {
            body.classList.remove('expand-menu');
            slideUpSubmenu();
        }

        e.preventDefault();
    }
};

// Setup lifecycle hooks
onMounted(() => {
    document.addEventListener('mouseover', handleMouseover);
});

onUnmounted(() => {
    document.removeEventListener('mouseover', handleMouseover);
});
</script>


<template>
    <!-- Header -->
    <div class="header">
        <!-- Logo -->
        <div class="header-left active">
            <router-link to="/dashboard" class="logo logo-normal">
                <img :src="logo" alt="logo">
            </router-link>
            <router-link to="/dashboard" class="logo logo-white">
                <img :src="logo" alt="logo">
            </router-link>
            <router-link to="/dashboard" class="logo-small">
                <img :src="logo" alt="logo">
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
            <!-- maximize screen -->
            <li class="nav-item nav-item-box">
                <a href="javascript:void(0);" id="btnFullscreen" @click="initFullScreen">
                    <vue-feather type="maximize"></vue-feather>
                </a>
            </li>
            <!-- maximize screen -->

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
                                            <img alt="" src="">
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
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <router-link to="/activities">View all Notifications</router-link>
                    </div>
                </div>
            </li>
            <!-- /Notifications -->

            <!-- general settings -->
            <li class="nav-item nav-item-box">
                <router-link to="/settings/general-settings"><vue-feather type="settings"></vue-feather></router-link>
            </li>
            <!-- /general settings -->

            <!-- profile menu -->
            <li class="nav-item dropdown has-arrow main-drop">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                    <span class="user-info">
                        <span class="user-letter">
                            <img src="" alt="" class="img-fluid">
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
                            <span class="user-img"><img src="" alt="">
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
                        <router-link class="dropdown-item logout pb-0" to="/"><img src=""
                                class="me-2" alt="img">Logout</router-link>
                    </div>
                </div>
            </li>
            <!-- /profile menu -->
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
</template>
