<template>
    <nav class="hk-nav hk-nav-light">
        <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i
            data-feather="x"></i></span></a>
        <div class="nicescroll-bar">
            <div class="navbar-nav-wrap">
                <ul class="navbar-nav flex-column">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'dashboard'}">
                            <span class="feather-icon"><i data-feather="book"></i></span>
                            <span class="nav-link-text">Dashboard</span>
                        </router-link>
                    </li>
                </ul>
                <hr class="nav-separator">
                <div class="nav-header">
                    <span>Main Moudels</span>
                    <span>UI</span>
                </div>
                <ul class="navbar-nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse"
                           data-target="#user_menu">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-user">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span class="nav-link-text ml-2">User Management</span>
                        </a>
                        <ul id="user_menu" class="nav flex-column collapse collapse-level-1">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <router-link class="nav-link" :to="{name: 'users.index'}">List</router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link class="nav-link" :to="{name: 'users.create'}">Create</router-link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse"
                           data-target="#employee_menu">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-users">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span class="nav-link-text ml-2">Employee Management</span>
                        </a>
                        <ul id="employee_menu" class="nav flex-column collapse collapse-level-1">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <router-link class="nav-link" :to="{name: 'employees.index'}">List</router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link class="nav-link" :to="{name: 'employees.create'}">Create
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse"
                           data-target="#system_menu">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-settings">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path
                                    d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                            </svg>
                            <span class="nav-link-text ml-2">System Management</span>
                        </a>
                        <ul id="system_menu" class="nav flex-column collapse collapse-level-1">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <router-link class="nav-link" :to="{name: 'countries.index'}">Countries</router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link class="nav-link" :to="{name: 'states.index'}">States</router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link class="nav-link" :to="{name: 'cities.index'}">Cities</router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link class="nav-link" :to="{name: 'departments.index'}">Departments</router-link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
                <hr class="nav-separator">
            </div>
        </div>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
    </nav>
</template>

<script>
export default {
    name: "Sidebar",
    // created(){
    //     EventBus.$on('logout',function () {
    //         User.logout();
    //     });
    // },
    data() {
        return {
            //
        }
    }
}
</script>

<style scoped>

</style>
