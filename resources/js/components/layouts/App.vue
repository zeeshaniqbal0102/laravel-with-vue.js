<template>
    <!-- HK Wrapper -->
    <div v-if="isLoggedIn" class="hk-wrapper hk-vertical-nav">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar">
            <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span
                class="feather-icon"><i data-feather="menu"></i></span></a>
            <router-link class="navbar-brand" :to="{name: 'dashboard'}">
                <img class="brand-img d-inline-block w-190p" src="/assets/dist/img/logo-dark.png" alt="brand"/>
            </router-link>
            <ul class="navbar-nav hk-navbar-content">
                <li class="nav-item dropdown dropdown-authentication">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar">
                                    <img src="/assets/dist/img/avatar12.jpg" alt="user"
                                         class="avatar-img rounded-circle">
                                </div>
                                <span class="badge badge-success badge-indicator"></span>
                            </div>
                            <div class="media-body">
                                <span>{{user.name}}<i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX"
                         data-dropdown-out="flipOutX">
                        <router-link class="dropdown-item" :to="{name: 'logout'}">
                            <i class="dropdown-icon zmdi zmdi-power"></i>
                            <span>Log out</span>
                        </router-link>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /Top Navbar -->

        <router-view></router-view>

        <sidebar/>

        <div class="hk-footer-wrap container">
            <footer class="footer ml-100">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <p>Powered by<a href="https://tagsncode.co/" class="text-dark" target="_blank">XYZ</a> ©
                            2021</p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <p class="d-inline-block">Follow us</p>
                        <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span
                            class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
                        <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span
                            class="btn-icon-wrap"><i class="fa fa-twitter"></i></span></a>
                        <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span
                            class="btn-icon-wrap"><i class="fa fa-google-plus"></i></span></a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <router-view v-else></router-view>

</template>

<script>
import Sidebar from "./Sidebar";
import {init} from "../../../../public/assets/dist/js/init";

export default {
    components: {
        Sidebar
    },
    data() {
        return {
            isLoggedIn: User.loggedIn(),
            user: User.get()

        }
    },
    mounted() {
        init();
        if (this.props?.alert)
            this.$toast.open({
                position: 'top-right',
                ...this.props.alert
            });
    }
}
</script>

<style scoped>
.hk-wrapper.hk-vertical-nav .hk-pg-wrapper {
    height: unset;
}
</style>
