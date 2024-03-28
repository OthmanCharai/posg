<template>
    <layout-header></layout-header>
    <layout-sidebar></layout-sidebar>
    <div class="page-wrapper">
      <div class="content">
        <div class="page-header">
          <div class="add-item d-flex">
            <div class="page-title">
              <h4>User List</h4>
              <h6>Manage Your Users</h6>
            </div>
          </div>
          <ul class="table-top-head">
            <li>
              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"
                ><img src="" alt="img"
              /></a>
            </li>
            <li>
              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"
                ><img src="" alt="img"
              /></a>
            </li>
            <li>
              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"
                ><i data-feather="printer" class="printer"></i
              ></a>
            </li>
            <li>
              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"
                ><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i
              ></a>
            </li>
            <li>
              <a
                ref="collapseHeader"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="Collapse"
                @click="toggleCollapse"
              >
                <i data-feather="chevron-up" class="feather-chevron-up"></i>
              </a>
            </li>
          </ul>
          <div class="page-btn">
            <a
              href="javascript:void(0);"
              class="btn btn-added"
              data-bs-toggle="modal"
              data-bs-target="#add-units"
              ><vue-feather type="plus-circle" class="me-2"></vue-feather>Add New User</a
            >
          </div>
        </div>
  
        <!-- /product list -->
        <div class="card table-list-card">
          <div class="card-body">
            <div class="table-top">
              <div class="search-set">
                <div class="search-input">
                  <input type="text" placeholder="Search" class="dark-input" />
                  <a href="" class="btn btn-searchset"
                    ><i data-feather="search" class="feather-search"></i
                  ></a>
                </div>
              </div>
              <div class="search-path">
                <div class="d-flex align-items-center">
                  <a
                    class="btn btn-filter"
                    id="filter_search"
                    v-on:click="filter = !filter"
                    :class="{ setclose: filter }"
                  >
                    <vue-feather type="filter" class="filter-icon"></vue-feather>
                    <span><img src="" alt="img" /></span>
                  </a>
                </div>
              </div>
              <div class="form-sort">
                <vue-feather type="sliders" class="info-img"></vue-feather>
                <vue-select :options="UserSort" id="usersort" placeholder="Sort by Date" />
              </div>
            </div>
            <!-- /Filter -->
            <div
              class="card"
              :style="{ display: filter ? 'block' : 'none' }"
              id="filter_inputs"
            >
              <div class="card-body pb-0">
                <div class="row">
                  <div class="col-lg-3 col-sm-6 col-12">
                    <div class="input-blocks">
                      <vue-feather type="user" class="info-img"></vue-feather>
                      <vue-select
                        :options="Choosename"
                        id="choosename"
                        placeholder="Choose Name"
                      />
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 col-12">
                    <div class="input-blocks">
                      <vue-feather type="stop-circle" class="info-img"></vue-feather>
                      <vue-select
                        :options="Choosestatususer"
                        id="choosestatususer"
                        placeholder="Choose Status"
                      />
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 col-12">
                    <div class="input-blocks">
                      <vue-feather type="zap" class="info-img"></vue-feather>
                      <vue-select
                        :options="Chooseroleuser"
                        id="chooseroleuser"
                        placeholder="Choose Role"
                      />
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 col-12">
                    <div class="input-blocks">
                      <a class="btn btn-filters ms-auto">
                        <i data-feather="search" class="feather-search"></i> Search
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /Filter -->
            <div class="table-responsive">
              <a-table
                class="table datanew"
                :columns="columns"
                :data-source="data"
                :row-selection="{}"
              >
                <template #bodyCell="{ column, record }">
                  <template v-if="column.key === 'UserName'">
                    <div class="userimgname">
                      <a href="javascript:void(0);" class="userslist-img bg-img">
                        <img
                          alt="product"
                        />
                      </a>
                      <div>
                        <a href="javascript:void(0);">{{ record.UserName }}</a>
                      </div>
                    </div>
                  </template>
                  <template v-else-if="column.key === 'Status'">
                    <div>
                      <span :class="record.Class">{{ record.Status }}</span>
                    </div>
                  </template>
                  <template v-else-if="column.key === 'action'">
                    <td class="action-table-data">
                      <div class="edit-delete-action">
                        <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                          <vue-feather type="eye" class="action-eye"></vue-feather>
                        </a>
                        <a
                          class="me-2 p-2 mb-0"
                          data-bs-toggle="modal"
                          data-bs-target="#edit-units"
                        >
                          <i data-feather="edit" class="feather-edit"></i>
                        </a>
                        <a class="me-2 confirm-text p-2 mb-0" href="javascript:void(0);">
                          <i data-feather="trash-2" class="feather-trash-2"></i>
                        </a>
                      </div>
                    </td>
                  </template>
                </template>
              </a-table>
            </div>
          </div>
        </div>
        <!-- /product list -->
      </div>
    </div>
    <users-list-modal></users-list-modal>
  </template>
  <script>
  const columns = [
    {
      title: "User Name",
      dataIndex: "UserName",
      key: "UserName",
      sorter: {
        compare: (a, b) => {
          a = a.UserName.toLowerCase();
          b = b.UserName.toLowerCase();
          return a > b ? -1 : b > a ? 1 : 0;
        },
      },
    },
    {
      title: "Phone",
      dataIndex: "Phone",
      sorter: {
        compare: (a, b) => {
          a = a.Phone.toLowerCase();
          b = b.Phone.toLowerCase();
          return a > b ? -1 : b > a ? 1 : 0;
        },
      },
    },
    {
      title: "Email",
      dataIndex: "Email",
      sorter: {
        compare: (a, b) => {
          a = a.Email.toLowerCase();
          b = b.Email.toLowerCase();
          return a > b ? -1 : b > a ? 1 : 0;
        },
      },
    },
    {
      title: "Role",
      dataIndex: "Role",
      sorter: {
        compare: (a, b) => {
          a = a.Role.toLowerCase();
          b = b.Role.toLowerCase();
          return a > b ? -1 : b > a ? 1 : 0;
        },
      },
    },
    {
      title: "Created On",
      dataIndex: "CreatedOn",
      sorter: {
        compare: (a, b) => {
          a = a.CreatedOn.toLowerCase();
          b = b.CreatedOn.toLowerCase();
          return a > b ? -1 : b > a ? 1 : 0;
        },
      },
    },
    {
      title: "Status",
      dataIndex: "Status",
      key: "Status",
      sorter: {
        compare: (a, b) => {
          a = a.Status.toLowerCase();
          b = b.Status.toLowerCase();
          return a > b ? -1 : b > a ? 1 : 0;
        },
      },
    },
    {
      title: "Action",
      key: "action",
      sorter: true,
    },
  ];
  const data = [
    {
      UserName: "Thomas",
      Phone: "12163547758",
      email: "thomas@example.com",
      Role: "Admin",
      CreatedOn: "19 Jan 2023",
      Image: "user-23.jpg",
      Class: "badge badge-linedanger",
      Status: "Inactive",
    },
    {
      UserName: "Rose",
      Phone: "11367529510",
      email: "rose@example.com",
      Role: "Manager",
      CreatedOn: "23 Jan 2023",
      Image: "user-15.jpg",
      Class: "badge badge-linesuccess",
      Status: "Active",
    },
    {
      UserName: "Benjamin",
      Phone: "15362789414",
      email: "benjamin@example.com",
      Role: "Salesman",
      CreatedOn: "07 Feb 2023",
      Image: "user-16.jpg",
      Class: "badge badge-linesuccess",
      Status: "Active",
    },
    {
      UserName: "Kaitlin",
      Phone: "18513094627",
      email: "kaitlin@example.com",
      Role: "Supervisor",
      CreatedOn: "18 Feb 2023",
      Image: "user-17.jpg",
      Class: "badge badge-linesuccess",
      Status: "Active",
    },
    {
      UserName: "illy",
      Phone: "14678219025",
      email: "lilly@example.com",
      Role: "Store Keeper",
      CreatedOn: "16 Mar 2023",
      Image: "user-18.jpg",
      Class: "badge badge-linedanger",
      Status: "Inactive",
    },
    {
      UserName: "Frda",
      Phone: "10913278319",
      email: "freda@example.com",
      Role: "Purchase",
      CreatedOn: "29 Mar 2023",
      Image: "user-19.jpg",
      Class: "badge badge-linedanger",
      Status: "Inactive",
    },
    {
      UserName: "Alwi",
      Phone: "19125852947",
      email: "alwin@example.com",
      Role: "Delivery Biker",
      CreatedOn: "03 Apr 2023",
      Image: "user-20.jpg",
      Class: "badge badge-linesuccess",
      Status: "Active",
    },
    {
      UserName: "Maybell",
      Phone: "13671835209",
      email: "maybelle@example.com",
      Role: "Maintenance",
      CreatedOn: "13 Apr 2023",
      Image: "user-06.jpg",
      Class: "badge badge-linesuccess",
      Status: "Active",
    },
    {
      UserName: "Ellen",
      Phone: "19756194733",
      email: "ellen@example.com",
      Role: "Quality Analyst",
      CreatedOn: "17 May 2023",
      Image: "user-21.jpg",
      Class: "badge badge-linesuccess",
      Status: "Active",
    },
    {
      UserName: "Grace",
      Phone: "19167850925",
      email: "grace@example.com",
      Role: "Accountant",
      CreatedOn: "21 May 2023",
      Image: "user-22.jpg",
      Class: "badge badge-linesuccess",
      Status: "Active",
    },
  ];
  export default {
    data() {
      return {
        filter: false,
        UserSort: ["Sort by Date", "Newest", "Oldest"],
        Chooseroleuser: ["Choose Role", "Store Keeper", "Salesman"],
        Choosestatususer: ["Choose Status", "Active", "Inactive"],
        Choosename: ["Choose Name", "Lilly", "Benjamin"],
        data,
        columns,
      };
    },
    methods: {
      toggleCollapse() {
        const collapseHeader = this.$refs.collapseHeader;
  
        if (collapseHeader) {
          collapseHeader.classList.toggle("active");
          document.body.classList.toggle("header-collapse");
        }
      },
    },
  };
  </script>
  