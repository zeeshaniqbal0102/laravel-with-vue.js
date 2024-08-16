<template>
    <div class="hk-pg-wrapper">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item">
                    <router-link :to="{name: 'dashboard'}">Dashboard</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ this.pageName }}</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->

        <!-- Container -->
        <div class="container-fluid">
            <!-- Title -->
            <div class="hk-pg-header">
                <h4 class="hk-pg-title">
                    <span class="pg-title-icon"><span class="feather-icon">
                    <i data-feather="toggle-right"></i></span>
                    </span>{{ this.pageName }}</h4>
                <div class="d-flex">
                    <router-link class="btn btn-primary" :to="{name: 'departments.create'}">Create</router-link>
                </div>
            </div>
            <!-- /Title -->

            <!-- Row -->
            <div class="d-flex form-group w-25">
                <label class="d-inline mr-10 mt-10">Search:</label>
                <input type="search" v-model="filter" class="form-control pull-right">
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <section class="hk-sec-wrapper">
                        <div class="row">
                            <div class="col-sm">
                                <div class="table-wrap">
                                    <table id="datable_1" class="table table-hover w-100 display pb-30">
                                        <thead>
                                        <tr class="table-dark">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="department in data">
                                            <td>{{ department.id }}</td>
                                            <td>{{ department.name }}</td>
                                            <td>{{ department.created_at }}</td>
                                            <td>
                                                <span>
                                                    <router-link class="btn btn-info btn-xs"
                                                                 :to="{name: 'departments.edit',params: { id: department.id }}">
                                                    Edit
                                                </router-link>
                                                <button @click="()=>destroy(department.id)"
                                                        class="btn btn-danger btn-xs">Delete
                                                </button>
                                                </span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- /Row -->
        </div>
        <!-- /Container -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            pageName: 'Department List',
            filter: null,
            filterableColumns: ['name'],
            departments: [],
            data: []
        };
    },
    created() {
        this.loadList();
    },
    watch: {
        filter: function (newVal, oldVal) {
            this.data = this.departments.filter((department) => {
                let found = false;
                this.filterableColumns.forEach(column => {
                    let value = eval(`department.${column}`);
                    if (value.toLowerCase().includes(newVal))
                        found = true
                });
                return found;
            });
        },
    },
    methods: {
        loadList() {
            axios.get('/api/department')
                .then(res => {
                    this.departments = res.data.data;
                    this.data = res.data.data;
                })
                .catch(err => console.log('err', err))
        },
        destroy(id) {
            this.$swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
                .then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/api/department/${id}`)
                            .then(response => {
                                this.$toastr.s('Department deleted successfully', 'Success!');
                                this.loadList();
                            }).catch(error => {
                                this.$toastr.e(error.response.data.message, 'Failed!')
                            })
                    }
                });
        }
    }
}
</script>

<style scoped>

</style>
