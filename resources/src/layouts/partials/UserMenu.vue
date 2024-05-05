<script>
  import sideBarData from '@/src/assets/json/sidebar.json';

  export default {
    data() {
      return {
        sideBarData: sideBarData,
        route_array: [],
        openMenuItem: null,
        openSubmenuOneItem: null,
      };
    },
    computed: {
      currentPath() {
        return this.$route.path;
      },
    },
    methods: {
      expandSubMenus(menu) {
        this.sideBarData.forEach((item) => {
          item.menu.forEach((subMenu) => {
            if (subMenu !== menu) {
              subMenu.showSubRoute = false;
            }
          });
        });
        menu.showSubRoute = !menu.showSubRoute;
      },
      updateRouteArray() {
        this.route_array = this.$route.path.split('/');
      },
      openMenu(menu) {
        this.openMenuItem = this.openMenuItem === menu ? null : menu;
      },
      openSubmenuOne(subMenus) {
        this.openSubmenuOneItem = this.openSubmenuOneItem === subMenus ? null : subMenus;
      },
    },
  };
</script>

<template>
  <ul>
    <template v-for="item in sideBarData" :key="item.title">
      <li class="submenu-open">
        <h6 class="submenu-hdr">
          {{ item.title }}
        </h6>
        <ul>
          <template v-for="menu in item.menu" :key="menu.menuValue">
            <li v-if="!menu.hasSubRoute" :class="{ active: $route.path === menu.route }">
              <router-link v-if="menu.route" :to="menu.route">
                <vue-feather v-if="menu.icon" :type="menu.icon" />
                <div v-else v-html="menu.customIcon" />
                <span>{{ menu.menuValue }} </span>
              </router-link>
            </li>
            <li v-else :class="{ submenu: true, subdrop: menu.showSubRoute }">
              <a
                href="javascript:void(0)"
                :class="{
                  subdrop: menu.showSubRoute,
                  active: route_array[1] === menu.active_link,
                }"
                @click="expandSubMenus(menu)"
              >
                <vue-feather :type="menu.icon" />
                <span>{{ menu.menuValue }}</span>
                <span class="menu-arrow" />
              </a>
              <ul :class="{ block: menu.showSubRoute, '!hidden': !menu.showSubRoute }">
                <template v-for="subMenu in menu.subMenus" :key="subMenu.id">
                  <li :class="{ active: currentPath === subMenu.active_link }">
                    <router-link
                      :to="subMenu.route"
                      class="sub-active"
                      :class="{ 'router-link-active': $route.path === subMenu.route }"
                    >
                      {{ subMenu.menuValue }}
                    </router-link>
                  </li>
                </template>
              </ul>
            </li>
            <li v-if="menu.hasSubRouteTwo" class="submenu">
              <a
                href="javascript:void(0);"
                @click="openMenu(menu)"
                :class="{
                  subdrop: openMenuItem === menu,
                  active: route_array[1] === menu.active_link,
                }"
              >
                <vue-feather :type="menu.icon" /><span>{{ menu.menuValue }}</span>
                <span class="menu-arrow" />
              </a>
              <ul
                :class="{
                  block: openMenuItem === menu,
                  '!hidden': openMenuItem !== menu,
                }"
              >
                <li v-for="subMenus in menu.subMenus" :key="subMenus.menuValue">
                  <template v-if="!subMenus.customSubmenuTwo">
                    <router-link :to="subMenus.route">
                      {{
                        subMenus.menuValue
                      }}
                    </router-link>
                  </template>
                  <template v-else-if="subMenus.customSubmenuTwo">
                    <li class="submenu submenu-two">
                      <a
                        href="javascript:void(0);"
                        @click="openSubmenuOne(subMenus)"
                        :class="{ subdrop: openSubmenuOneItem === subMenus }"
                      >
                        {{ subMenus.menuValue }}
                        <span class="menu-arrow inside-submenu" />
                      </a>
                      <ul
                        :class="{
                          block: openSubmenuOneItem === subMenus,
                          '!hidden': openSubmenuOneItem !== subMenus,
                        }"
                      >
                        <li
                          v-for="subMenuTwo in subMenus.subMenusTwo"
                          :key="subMenuTwo.menuValue"
                        >
                          <router-link :to="subMenuTwo.route">
                            {{
                              subMenuTwo.menuValue
                            }}
                          </router-link>
                        </li>
                      </ul>
                    </li>
                  </template>
                </li>
              </ul>
            </li>
          </template>
        </ul>
      </li>
    </template>
  </ul>
</template>
