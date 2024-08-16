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
                    <router-link class="btn btn-primary" :to="{name: 'states.create'}">Create</router-link>
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
                                            <th>Country</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="state in data">
                                            <td>{{ state.id }}</td>
                                            <td>{{ state.name }}</td>
                                            <td>{{ state.country.name }}</td>
                                            <td>{{ state.created_at }}</td>
                                            <td>
                                                <router-link class="btn btn-info btn-xs"
                                                             :to="{name: 'states.edit',params: { id: state.id }}">
                                                    Edit
                                                </router-link>
                                                <button @click="()=>destroy(state.id)"
                                                        class="btn btn-danger btn-xs">Delete
                                                </button>
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
            pageName: 'State List',
            filter: null,
            filterableColumns: ['name', 'country.name'],
            states: [],
            data: []
        };
    },
    created() {
        this.loadList();
    },
    watch: {
        filter: function (newVal, oldVal) {
            this.data = this.states.filter((state) => {
                let found = false;
                this.filterableColumns.forEach(column => {
                    let value = eval(`state.${column}`);
                    if (value.toLowerCase().includes(newVal))
                        found = true
                });
                return found;
            });
        },
    },
    methods: {
        loadList() {
            axios.get('/api/state')
                .then(res => {
                    this.states = res.data.data;
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
                        axios.delete(`/api/state/${id}`)
                            .then(response => {
                                this.$toastr.s('State deleted successfully', 'Success!');
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
