<script setup>
  import logo from '@/src/assets/img/logo/logo-login.png';
  import profilThumbnail from '@/src/assets/img/profil_thumbnail.png';

  const toggleSidebar1 = () => {
    const body = document.body;
    body.classList.toggle('slide-nav');
  };

  const toggleSidebar = () => {
    const body = document.body;
    body.classList.toggle('mini-sidebar');
  };

  const initFullScreen = () => {
    document.body.classList.toggle('fullscreen-enable');
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

  const isElementVisible = (element) => {
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
  const handleMouseover = (e) => {
    e.stopPropagation();

    const body = document.body;
    const toggleBtn = document.getElementById('toggle_btn');

    if (body.classList.contains('mini-sidebar') && isElementVisible(toggleBtn)) {
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
      <a
        id="toggle_btn"
        href="javascript:void(0);"
        @click="toggleSidebar"
      >
        <vue-feather type="chevrons-left" />
      </a>
    </div>
    <!-- /Logo -->

    <a
      id="mobile_btn"
      class="mobile_btn"
      href="javascript:void(0);"
      @click="toggleSidebar1"
    >
      <span class="bar-icon">
        <span />
        <span />
        <span />
      </span>
    </a>

    <!-- Header Menu -->
    <ul class="flex user-menu">
      <!-- maximize screen -->
      <li class="nav-item nav-item-box">
        <a
          href="javascript:void(0);"
          id="btnFullscreen"
          @click="initFullScreen"
        >
          <vue-feather type="maximize" />
        </a>
      </li>
      <!-- maximize screen -->

      <!-- Notifications -->
      <li class="nav-item dropdown nav-item-box notification-box">
        <a-dropdown :trigger="['click']">
          <a-badge :count="2" @click.prevent>
            <a-avatar shape="square">
              <template #icon>
                <vue-feather type="bell" stroke="#67748e" />
              </template>
            </a-avatar>
          </a-badge>
          <template #overlay>
            <div class="dropdown-menu notifications bg-white">
              <div class="topnav-dropdown-header">
                <span class="notification-title">Notifications</span>
                <a href="javascript:void(0)" class="clear-noti"> Tout effacer </a>
              </div>
              <div class="noti-content">
                <ul class="notification-list">
                  <li class="notification-message">
                    <router-link to="/activities">
                      <div class="media flex">
                        <span class="avatar flex-shrink-0">
                          <img :src="profilThumbnail">
                        </span>
                        <div class="media-body flex-grow">
                          <p class="noti-details">
                            <span class="noti-title">John Doe</span> added new task
                            <span class="noti-title">Patient appointment booking</span>
                          </p>
                          <p class="noti-time">
                            <span class="notification-time">4 mins ago</span>
                          </p>
                        </div>
                      </div>
                    </router-link>
                  </li>
                </ul>
              </div>
              <div class="topnav-dropdown-footer">
                <router-link to="/activities">
                  Voir toutes les notifications
                </router-link>
              </div>
            </div>
          </template>
        </a-dropdown>
      </li>
      <!-- /Notifications -->

      <!-- profile menu -->
      <li class="nav-item dropdown has-arrow main-drop">
        <a-dropdown :trigger="['click']">
          <a class="dropdown-toggle nav-link userset" @click.prevent>
            <span class="user-info">
              <span class="user-letter">
                <img
                  :src="profilThumbnail"
                  alt="profil"
                  class="img-fluid"
                >
              </span>
              <span class="user-detail">
                <span class="user-name">John Smilga</span>
                <span class="user-role">Super Admin</span>
              </span>
            </span>
          </a>
          <template #overlay>
            <div class="dropdown-menu menu-drop-user bg-white">
              <div class="profilename">
                <div class="profileset">
                  <span class="user-img">
                    <img :src="profilThumbnail" alt="profil">
                    <span class="status online" />
                  </span>
                  <div class="profilesets">
                    <h6>John Smilga</h6>
                    <h5>Super Admin</h5>
                  </div>
                </div>
                <hr class="m-0">
                <router-link class="dropdown-item" to="/pages/profile">
                  <vue-feather class="me-2" type="user" />
                  Mon profil
                </router-link>
                <router-link class="dropdown-item" to="/settings/general-settings">
                  <vue-feather class="me-2" type="settings" />
                  Paramètres
                </router-link>
                <hr class="m-0">
                <router-link class="dropdown-item logout pb-0" to="/">
                  <vue-feather
                    class="me-2"
                    type="log-out"
                    stroke="red"
                  />
                  Déconnexion
                </router-link>
              </div>
            </div>
          </template>
        </a-dropdown>
      </li>
      <!-- /profile menu -->
    </ul>
    <!-- /Header Menu -->

    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
      <a-dropdown :trigger="['click']">
        <a class="nav-link dropdown-toggle" @click.prevent>
          <i class="fa fa-ellipsis-v" />
        </a>
        <template #overlay>
          <router-link class="dropdown-item" to="/pages/profile">
            Mon profil
          </router-link>
          <router-link
            class="dropdown-item"
            to="/settings/general-settings"
          >
            Paramètres
          </router-link>
          <router-link class="dropdown-item" to="/">
            Déconnexion
          </router-link>
        </template>
      </a-dropdown>
    </div>
    <!-- /Mobile Menu -->
  </div>
  <!-- /Header -->
</template>

<style scoped lang="scss">
  .notification-box :deep(.ant-avatar) {
    background-color: #f4f6f9 !important;
    width: 36px !important;
    height: 36px !important;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
  }

  .profilename {
    .user-img {
      .status {
        bottom: 10px;
      }
    }
  }

  .user-img {
    display: inline-block;
    position: relative;

    img {
      width: 38px;
      border-radius: 50%;
    }

    .status {
      border: 2px solid #fff;
      height: 10px;
      width: 10px;
      margin: 0;
      position: absolute;
      right: 0;
      bottom: 30px;
      border-radius: 50%;
      display: inline-block;
      background: #28c76f;
    }
  }

  .menu-drop-user {
    .dropdown-item {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      align-items: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      color: #67748e;
      padding: 7px 10px !important;

      svg {
        stroke-width: 1px;
        margin-right: 10px;
        width: 18px;
      }
    }

    .logout {
      color: #ff0000;
    }
  }
</style>
