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
                    data-feather="toggle-right"></i></span></span>{{ this.updating ? 'Edit' : 'Create' }} User</h4>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" v-model="form.username" class="form-control">
                                                <span v-if="errors.username" class="text-danger">{{
                                                        errors.username
                                                    }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" v-model="form.first_name" class="form-control">
                                                <span v-if="errors.first_name" class="text-danger">{{
                                                        errors.first_name
                                                    }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" v-model="form.last_name" class="form-control">
                                                <span v-if="errors.last_name" class="text-danger">{{
                                                        errors.last_name
                                                    }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" v-model="form.email" class="form-control">
                                                <span v-if="errors.email" class="text-danger">{{
                                                        errors.email
                                                    }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" v-model="form.password" class="form-control">
                                                <span v-if="errors.password" class="text-danger">{{
                                                        errors.password
                                                    }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Confirmation Password</label>
                                                <input type="password" v-model="form.password_confirmation" class="form-control">
                                                <span v-if="errors.password_confirmation" class="text-danger">{{
                                                        errors.password_confirmation
                                                    }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <button type="submit" class="btn btn-primary mr-10">Submit</button>
                            <router-link class="btn btn-light" :to="{path: '/users'}">Cancel</router-link>
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
            user: {},
            updating: false,
            form: {
                username: null,
                first_name: null,
                last_name: null,
                email: null,
                password: null,
                password_confirmation: null,
            },
            errors: {}
        }
    },
    created() {
        let id = this.$route.params.id;
        if (id) {
            axios.get(`/api/user/${id}`)
                .then(res => {
                    let user = res.data.data;
                    this.user = user;
                    this.updating = true;
                    this.form = Object.assign(this.form, {
                        username: user.username,
                        email: user.email,
                        first_name: user.first_name,
                        last_name: user.last_name,
                    })
                })
                .catch(err => console.log('err', err));
        }
    },
    methods: {
        submit() {
            let request = this.updating ? axios.put(`/api/user/${this.user.id}`, this.form) : axios.post('/api/user', this.form);

            request.then(response => {
                this.errors = {};
                this.$toastr.s(`User ${this.updating ? 'updated' : 'added'} successfully`, 'Success');
                this.$router.push({path: '/users'});
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
