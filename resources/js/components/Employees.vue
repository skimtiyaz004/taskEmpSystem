<template>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">First Name</th>
          <th scope="col">Middle Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="emp in employees" :key="emp.id">
          <th>{{ emp.id }}</th>
          <td>{{ emp.first_name }}</td>
          <td>{{ emp.middle_name }}</td>
          <td>{{ emp.last_name }}</td>
          <td>{{ emp.email }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Employees",
  data: () => ({
    employees: [],
  }),
  created() {
    axios.get("http://127.0.0.1:8000/api/allEmp").then((response) => {
      this.employees = response.data.data;
    });
  },
  methods: {},
};
</script>

<style scoped>
</style>
