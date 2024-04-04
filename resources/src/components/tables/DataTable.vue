<template>
  <div class="table-responsive">
    <a-table
      outlined
      :columns="columns"
      :data-source="data"
      :pagination="{ pageSize: 10 }"
    />
  </div>
</template>
<script>
// Dammy data
import { defineComponent } from "vue";
const columns = [
  {
    title: "Name",
    dataIndex: "name",
    sorter: (a, b) => {
      if (a.name === data[0].name || b.name === data[0].name) return 0;
      return a.name.length - b.name.length;
    },
  },
  {
    title: "Position",
    dataIndex: "position",
    sorter: (a, b) => {
      if (a.position === data[0].position || b.position === data[0].position) return 0;
      return a.position.length - b.position.length;
    },
  },
  {
    title: "Office",
    dataIndex: "office",
    sorter: (a, b) => {
      if (a.office === data[0].office || b.office === data[0].office) return 0;
      return a.office.length - b.office.length;
    },
  },
  {
    title: "Age",
    dataIndex: "age",
    sorter: {
      compare: (a, b) => a.age - b.age,
    },
  },
  {
    title: "Start date",
    dataIndex: "start_date",
    sorter: (a, b) => new Date(a.start_date) - new Date(b.start_date),
  },
  {
    title: "Salary",
    dataIndex: "salary",
    sorter: (a, b) => {
      if (a.salary === data[0].salary || b.salary === data[0].salary) return 0;
      return a.salary.length - b.salary.length;
    },
  },
];
const data = [
  {
    key: "1",
    name: "Airi Satou",
    position: "Accountant",
    office: "Tokyo",
    age: "33",
    start_date: "2008/11/28",
    salary: "$162,700",
  },
  {
    key: "2",
    name: "Angelica Ramos",
    position: "Chief Executive officer",
    office: "London",
    age: "47",
    start_date: "2009/10/09",
    salary: "$1,200,000",
  },
  {
    key: "3",
    name: "Ashton Cox",
    position: "Junior Technical Author",
    office: "San Francisco",
    age: "66",
    start_date: "2009/01/12",
    salary: "$86,000",
  },
  {
    key: "4",
    name: "Bradley Greer",
    position: "Software Engineer",
    office: "London",
    age: "41",
    start_date: "2012/10/13",
    salary: "$132,000",
  },
  {
    key: "5",
    name: "Brenden Wagner",
    position: "Software Engineer",
    office: "San Francisco",
    age: "28",
    start_date: "2011/06/07",
    salary: "$206,850",
  },
  {
    key: "6",
    name: "Brielle Williamson",
    position: "Integration Specialist",
    office: "New York",
    age: "61",
    start_date: "2012/12/02",
    salary: "$372,000",
  },
  {
    key: "7",
    name: "Caesar Vance",
    position: "Pre-Sales Support",
    office: "New York",
    age: "21",
    start_date: "2011/12/02",
    salary: "$106,450",
  },
  {
    key: "8",
    name: "Cedric Kelly",
    position: "Senior Javascript Developer",
    office: "Edinburgh",
    age: "22",
    start_date: "2012/03/29",
    salary: "$433,060",
  },
  {
    key: "9",
    name: "Charde Marshall",
    position: "Regional Director",
    office: "San Francisco",
    age: "36",
    start_date: "2008/10/16",
    salary: "$470,600",
  },
  {
    key: "10",
    name: "Colleen Hurst",
    position: "Javascript Developer",
    office: "San Francisco",
    age: "39",
    start_date: "2009/09/16",
    salary: "$205,500",
  },
  {
    key: "11",
    name: "Dai Rios",
    position: "Personnel Lead",
    office: "Edinburgh",
    age: "35",
    start_date: "2012/09/26",
    salary: "$217,500",
  },
  {
    key: "12",
    name: "Doris Wilder",
    position: "Sales Assistant",
    office: "Sidney",
    age: "23",
    start_date: "2010/09/20",
    salary: "$85,600",
  },
  {
    key: "13",
    name: "Fiona Green",
    position: "Chief Operating Officer (COO)",
    office: "San Francisco",
    age: "48",
    start_date: "2010/03/11",
    salary: "$850,000",
  },
  {
    key: "14",
    name: "Garrett Winters",
    position: "Accountant",
    office: "Tokyo",
    age: "63",
    start_date: "2011/07/25",
    salary: "$170,750",
  },
  {
    key: "15",
    name: "Gavin Joyce",
    position: "Developer",
    office: "Edinburgh",
    age: "42",
    start_date: "2010/12/22",
    salary: "$92,575",
  },
  {
    key: "16",
    name: "Gloria Little",
    position: "Systems Administrator",
    office: "New York",
    age: "59",
    start_date: "2009/04/10",
    salary: "$237,500",
  },
  {
    key: "17",
    name: "Haley Kennedy",
    position: "Senior Marketing Designer",
    office: "London",
    age: "43",
    start_date: "2012/12/18",
    salary: "$313,500",
  },
  {
    key: "18",
    name: "Herrod Chandler",
    position: "Sales Assistant",
    office: "San Francisco",
    age: "59",
    start_date: "2012/08/06",
    salary: "$137,500",
  },
  {
    key: "19",
    name: "Jena Gaines",
    position: "Office Manager",
    office: "London",
    age: "30",
    start_date: "2008/12/19",
    salary: "$90,560",
  },
  {
    key: "20",
    name: "Jenette Caldwell",
    position: "Development Lead",
    office: "New York",
    age: "30",
    start_date: "2011/09/03",
    salary: "$345,000",
  },
  {
    key: "21",
    name: "Jennifer Chang",
    position: "Regional Director",
    office: "Singapore",
    age: "28",
    start_date: "2010/11/14",
    salary: "$357,650",
  },
  {
    key: "22",
    name: "Michael Silva",
    position: "Marketing Designer",
    office: "London",
    age: "66",
    start_date: "2012/11/27",
    salary: "$198,500",
  },
  {
    key: "23",
    name: "Paul Byrd",
    position: "Chief Financial Officer (CFO)",
    office: "New York",
    age: "64",
    start_date: "2010/06/09",
    salary: "$725,000",
  },
  {
    key: "24",
    name: "Quinn Flynn",
    position: "Support Lead",
    office: "Edinburgh",
    age: "22",
    start_date: "2013/03/03",
    salary: "$342,000",
  },
  {
    key: "25",
    name: "Rhona Davidson",
    position: "Integration Specialist",
    office: "Tokyo",
    age: "55",
    start_date: "2010/10/14",
    salary: "$327,900",
  },
  {
    key: "26",
    name: "Shou Itou",
    position: "Regional Marketing",
    office: "Tokyo",
    age: "20",
    start_date: "2011/08/14",
    salary: "$163,000",
  },
  {
    key: "27",
    name: "Sonya Frost",
    position: "Software Engineer",
    office: "Edinburgh",
    age: "23",
    start_date: "2008/12/13",
    salary: "$103,600",
  },
  {
    key: "28",
    name: "Tatyana Fitzpatrick",
    position: "Regional Director",
    office: "London",
    age: "19",
    start_date: "2010/03/17",
    salary: "$385,750",
  },
  {
    key: "29",
    name: "Tiger Nixon",
    position: "System Architect",
    office: "Edinburgh",
    age: "61",
    start_date: "2011/04/25",
    salary: "$320,800",
  },
  {
    key: "30",
    name: "Yuri Berry",
    position: "Chief Marketing Officer (CMO)",
    office: "New York",
    Age: "40",
    start_date: "2009/06/25",
    salary: "$675,000",
  },
];
export default defineComponent({
  setup() {
    return {
      title: "Data Tables",
      text: "Dashboard",
      text1: "Data Tables",
      data,
      columns,
      onChange: (pagination, filters, sorter, extra) => {
        console.log("params", pagination, filters, sorter, extra);
      },
    };
  },
});
</script>
<style>
.ant-tooltip {
  display: none !important;
}
</style>
