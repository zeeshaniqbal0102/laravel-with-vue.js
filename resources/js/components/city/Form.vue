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
                    data-feather="toggle-right"></i></span></span>{{ this.updating ? 'Edit' : 'Create' }} City</h4>
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
                                                <label>Name</label>
                                                <input type="text" v-model="form.name" class="form-control">
                                                <span v-if="errors.name" class="text-danger">{{
                                                        errors.name
                                                    }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select v-model="form.country_id"
                                                        class="form-control custom-select">
                                                    <option v-for="country in countries"
                                                            :value="country.id">
                                                        {{ country.name }}
                                                    </option>
                                                </select>
                                                <span v-if="errors.country_id"
                                                      class="text-danger">{{ errors.country_id }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select v-model="form.state_id"
                                                        class="form-control custom-select">
                                                    <option v-for="state in states"
                                                            :value="state.id">
                                                        {{ state.name }}
                                                    </option>
                                                </select>
                                                <span v-if="errors.state_id"
                                                      class="text-danger">{{ errors.state_id }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <button type="submit" class="btn btn-primary mr-10">Submit</button>
                            <router-link class="btn btn-light" :to="{path: '/cities'}">Cancel</router-link>
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
            city: {},
            updating: false,
            countries: [],
            states: [],
            form: {
                name: null,
                state_id: null,
                country_id: null,
            },
            errors: {}
        }
    },
    watch: {
        'form.country_id': function (newVal, oldVal) {
            let states = [];
            if (this.form.country_id)
                states = this.countries.find(x => x.id === newVal).states;
            this.states = states;
        },
    },
    created() {
        axios.get(`/api/city/basic-data`)
            .then(res => {
                this.countries = res.data.countries;
            })
            .catch(err => console.log('err', err));

        let id = this.$route.params.id;
        if (id) {
            axios.get(`/api/city/${id}`)
                .then(res => {
                    let city = res.data.data;
                    this.city = city;
                    this.updating = true;
                    this.form = Object.assign(this.form, {
                        name: city.name,
                        state_id: city.state.id,
                        country_id: city.country.id,
                    })
                })
                .catch(err => console.log('err', err));
        }
    },
    methods: {
        submit() {
            let request = this.updating ? axios.put(`/api/city/${this.city.id}`, this.form) : axios.post('/api/city', this.form);

            request.then(response => {
                this.errors = {};
                this.$toastr.s(`City ${this.updating ? 'updated' : 'added'} successfully`, 'Success');
                this.$router.push({path: '/cities'});
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
