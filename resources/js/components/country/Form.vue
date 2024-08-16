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
                    data-feather="toggle-right"></i></span></span>{{ this.updating ? 'Edit' : 'Create' }} Country</h4>
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" v-model="form.name" class="form-control">
                                                <span v-if="errors.name" class="text-danger">{{
                                                        errors.name
                                                    }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country Code</label>
                                                <input type="text" v-model="form.country_code" class="form-control">
                                                <span v-if="errors.country_code" class="text-danger">{{
                                                        errors.country_code
                                                    }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <button type="submit" class="btn btn-primary mr-10">Submit</button>
                            <router-link class="btn btn-light" :to="{path: '/countries'}">Cancel</router-link>
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
            country: {},
            updating: false,
            form: {
                name: null,
                country_code: null,
            },
            errors: {}
        }
    },
    created() {
        let id = this.$route.params.id;
        if (id) {
            axios.get(`/api/country/${id}`)
                .then(res => {
                    let country = res.data.data;
                    this.country = country;
                    this.updating = true;
                    this.form = Object.assign(this.form, {
                        name: country.name,
                        country_code: country.country_code,
                    })
                })
                .catch(err => console.log('err', err));
        }
    },
    methods: {
        submit() {
            let request = this.updating ? axios.put(`/api/country/${this.country.id}`, this.form) : axios.post('/api/country', this.form);

            request.then(response => {
                this.errors = {};
                this.$toastr.s(`Country ${this.updating ? 'updated' : 'added'} successfully`, 'Success');
                this.$router.push({path: '/countries'});
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
