import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from "../components/auth/Login";
import EmployeeList from "../components/employee/Index";
import EmployeeForm from "../components/employee/Form";
import UserList from "../components/user/Index";
import UserForm from "../components/user/Form";
import CountryList from "../components/country/Index";
import CountryForm from "../components/country/Form";
import StateList from "../components/state/Index";
import StateForm from "../components/state/Form";
import CityList from "../components/city/Index";
import CityForm from "../components/city/Form";
import DepartmentList from "../components/department/Index";
import DepartmentForm from "../components/department/Form";
import Logout from "../components/auth/Logout";
import Dashboard from "../components/home/Dashboard";
import User from '../helpers/User';

Vue.use(VueRouter);

const routes = [
    {path: '/login', component: Login, name: 'login'},
    {path: '/logout', component: Logout, name: 'logout'},
    {
        path: '/', component: Dashboard, name: 'dashboard',
        meta: {requiresAuth: true}
    },
    {
        path: '/employees',
        name: 'employees',
        component: {render: h => h('router-view')},
        meta: {requiresAuth: true},
        children: [
            {
                path: '',
                name: 'employees.index',
                component: EmployeeList,
            },
            {
                path: 'create',
                name: 'employees.create',
                component: EmployeeForm,
            },
            {
                path: ':id/edit',
                name: 'employees.edit',
                component: EmployeeForm,
            },
        ]
    },
    {
        path: '/users',
        name: 'users',
        component: {render: h => h('router-view')},
        meta: {requiresAuth: true},
        children: [
            {
                path: '',
                name: 'users.index',
                component: UserList,
            },
            {
                path: 'create',
                name: 'users.create',
                component: UserForm,
            },
            {
                path: ':id/edit',
                name: 'users.edit',
                component: UserForm,
            },
        ]
    },
    {
        path: '/countries',
        name: 'countries',
        component: {render: h => h('router-view')},
        meta: {requiresAuth: true},
        children: [
            {
                path: '',
                name: 'countries.index',
                component: CountryList,
            },
            {
                path: 'create',
                name: 'countries.create',
                component: CountryForm,
            },
            {
                path: ':id/edit',
                name: 'countries.edit',
                component: CountryForm,
            },
        ]
    },
    {
        path: '/states',
        name: 'states',
        component: {render: h => h('router-view')},
        meta: {requiresAuth: true},
        children: [
            {
                path: '',
                name: 'states.index',
                component: StateList,
            },
            {
                path: 'create',
                name: 'states.create',
                component: StateForm,
            },
            {
                path: ':id/edit',
                name: 'states.edit',
                component: StateForm,
            },
        ]
    },
    {
        path: '/cities',
        name: 'cities',
        component: {render: h => h('router-view')},
        meta: {requiresAuth: true},
        children: [
            {
                path: '',
                name: 'cities.index',
                component: CityList,
            },
            {
                path: 'create',
                name: 'cities.create',
                component: CityForm,
            },
            {
                path: ':id/edit',
                name: 'cities.edit',
                component: CityForm,
            },
        ]
    },
    {
        path: '/departments',
        name: 'departments',
        component: {render: h => h('router-view')},
        meta: {requiresAuth: true},
        children: [
            {
                path: '',
                name: 'departments.index',
                component: DepartmentList,
            },
            {
                path: 'create',
                name: 'departments.create',
                component: DepartmentForm,
            },
            {
                path: ':id/edit',
                name: 'departments.edit',
                component: DepartmentForm,
            },
        ]
    },
];

const router = new VueRouter({
    routes,
    mode: 'history'
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        axios.post('/api/auth/refresh')
            .then(response => {
                User.responseAfterAuthenticated(response, false);
                next();
            })
            .catch(err => console.log('UnAuthorized: ', err))
    } else {
        next()
    }
})

export default router;
