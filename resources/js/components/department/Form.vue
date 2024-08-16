<template>
    <div class="hk-pg-wrapper">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Element</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->

        <!-- Container -->
        <div class="container-fluid">
            <!-- Title -->
            <div class="hk-pg-header">
                <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                    data-feather="toggle-right"></i></span></span>{{ this.updating ? 'Edit' : 'Create' }} Department</h4>
            </div>
            <!-- /Title -->

            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <form @submit.prevent="submit">
                        <section class="hk-sec-wrapper">
                            <h5 class="hk-sec-title"></h5>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" v-model="form.name" class="form-control">
                                                <span v-if="errors.name" class="text-danger">{{
                                                        errors.name
                                                    }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary mr-10">Submit</button>
                            <router-link class="btn btn-light" :to="{path: '/departments'}">Cancel</router-link>
                        </section>
                    </form>
                </div>
            </div>
            <!-- /Row -->
        </div>
        <!-- /Container -->
    </div>
</template>

<script>
export default {
    name: "Form",
    data() {
        return {
            department: {},
            updating: false,
            form: {
                name: null,
            },
            errors: {}
        }
    },
    created() {
        let id = this.$route.params.id;
        if (id) {
            axios.get(`/api/department/${id}`)
                .then(res => {
                    let department = res.data.data;
                    this.department = department;
                    this.updating = true;
                    this.form = Object.assign(this.form, {
                        name: department.name,
                    })
                })
                .catch(err => console.log('err', err));
        }
    },
    methods: {
        submit() {
            let request = this.updating ? axios.put(`/api/department/${this.department.id}`, this.form) : axios.post('/api/department', this.form);

            request.then(response => {
                this.errors = {};
                this.$toastr.s(`Department ${this.updating ? 'updated' : 'added'} successfully`, 'Success');
                this.$router.push({path: '/departments'});
            }).catch(error => {
                this.$toastr.e(error.response.data.message, 'Oops!');
                let errors = error.response.data.errors;
                for (let key in errors) {
                    errors[key] = errors[key][0];
                }
                this.errors = errors;
            });


        }
    }
}
</script>

<style scoped>

</style>
