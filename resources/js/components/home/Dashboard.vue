<template>
        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                <!-- Title -->
                <div class="hk-pg-header align-items-top">
                    <div>
                        <h2 class="hk-pg-title font-weight-600 mb-10">Dashboard</h2>
                    </div>
                </div>
                <!-- /Title -->

            </div>
            <!-- /Container -->
        </div>
</template>

<script>
    import {init} from "../../../../public/assets/dist/js/dashboard-data";

    export default {
        components: {
        },
        mounted() {
            init();
        }
    }
</script>
