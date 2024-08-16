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
                    data-feather="toggle-right"></i></span></span>{{ this.updating ? 'Edit' : 'Create' }} Employee</h4>
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
                                                <label>First Name</label>
                                                <input type="text" v-model="form.first_name" class="form-control">
                                                <span v-if="errors.first_name" class="text-danger">{{
                                                        errors.first_name
                                                    }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input type="text" v-model="form.middle_name" class="form-control">
                                                <span v-if="errors.middle_name" class="text-danger">{{
                                                        errors.middle_name
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <select v-model="form.city_id"
                                                        class="form-control custom-select">
                                                    <option v-for="city in cities"
                                                            :value="city.id">
                                                        {{ city.name }}
                                                    </option>
                                                </select>
                                                <span v-if="errors.city_id"
                                                      class="text-danger">{{ errors.city_id }}</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select v-model="form.department_id"
                                                        class="form-control custom-select">
                                                    <option v-for="department in departments"
                                                            :value="department.id">
                                                        {{ department.name }}
                                                    </option>
                                                </select>
                                                <span v-if="errors.department_id"
                                                      class="text-danger">{{ errors.department_id }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Zip</label>
                                                <input v-model="form.zip" type="text" class="form-control"
                                                       placeholder="Enter Purpose">
                                                <span v-if="errors.zip" class="text-danger">{{
                                                        errors.zip
                                                    }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea type="text" v-model="form.address"
                                                          class="form-control"></textarea>
                                                <span v-if="errors.address" class="text-danger">{{
                                                        errors.address
                                                    }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Date Hired</label>
                                            <datepicker v-model="form.date_hired"></datepicker>
                                            <span v-if="errors.date_hired"
                                                  class="text-danger">{{ errors.date_hired }}</span>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Birth Date</label>
                                            <datepicker v-model="form.birthdate"></datepicker>
                                            <span v-if="errors.birthdate"
                                                  class="text-danger">{{ errors.birthdate }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <button type="submit" class="btn btn-primary mr-10">Submit</button>
                            <router-link class="btn btn-light" :to="{path: '/employees'}">Cancel</router-link>
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
import Datepicker from 'vuejs-datepicker';
import moment from 'moment'

export default {
    name: "Form",
    components: {
        Datepicker
    },
    data() {
        return {
            employee: {},
            updating: false,
            departments: [],
            countries: [],
            states: [],
            cities: [],
            form: {
                first_name: null,
                middle_name: null,
                last_name: null,
                address: null,
                department_id: null,
                city_id: null,
                state_id: null,
                country_id: null,
                zip: null,
                birthdate: null,
                date_hired: new Date().toISOString().slice(0, 10),
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
        'form.state_id': function (newVal, oldVal) {
            let cities = [];
            if (this.form.country_id)
                cities = this.states.find(x => x.id === newVal).cities;
            this.cities = cities;
        },
        'form.date_hired': function (newVal, oldVal) {
            this.form.date_hired = moment(newVal).format('YYYY-MM-DD')
        },
        'form.birthdate': function (newVal, oldVal) {
            this.form.birthdate = moment(newVal).format('YYYY-MM-DD')
        },
    },
    mounted() {
        let pickers = document.getElementsByClassName('vdp-datepicker');
        for (let i = 0; i < pickers.length; i++)
            pickers[i].querySelector('input').classList.add('form-control')
    },
    created() {
        axios.get(`/api/employee/basic-data`)
            .then(res => {
                this.departments = res.data.departments;
                this.countries = res.data.countries;
            })
            .catch(err => console.log('err', err));

        let id = this.$route.params.id;
        if (id) {
            axios.get(`/api/employee/${id}`)
                .then(res => {
                    let employee = res.data.data;
                    this.employee = employee;
                    this.updating = true;
                    this.form = Object.assign(this.form, {
                        first_name: employee.first_name,
                        middle_name: employee.middle_name,
                        last_name: employee.last_name,
                        address: employee.address,
                        department_id: employee.department.id,
                        city_id: employee.city.id,
                        state_id: employee.state.id,
                        country_id: employee.country.id,
                        zip: employee.zip,
                        birthdate: employee.birthdate,
                        date_hired: employee.date_hired,
                    })
                })
                .catch(err => console.log('err', err));
        }
    },
    methods: {
        submit() {
            let request = this.updating ? axios.put(`/api/employee/${this.employee.id}`, this.form) : axios.post('/api/employee', this.form);

            request.then(response => {
                this.errors = {};
                this.$toastr.s(`Employee ${this.updating ? 'updated' : 'added'} successfully`, 'Success');
                this.$router.push({path: '/employees'});
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
