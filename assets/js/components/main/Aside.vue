<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <router-link to="/" class="brand-link">
            <img src="/img/dra_picto.png" alt="AdminLTE Picto" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Access Configurator</span>
        </router-link>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <el-container class="sidebar-user">
                <div v-if="user['connected']" class="connected-container">
                    <div class="user-container">
                        <div class="user-img">
                            <img src="/img/avatar_elpueblo.jpg" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="user-info">
                            <p>{{ user.firstname }}</p>
                            <p>{{ user.lastname }}</p>
                        </div>
                    </div>
                    <div class="logout-button">
                        <el-button size="large" type="warning">
                            <span @click="logout">Déconnexion</span>
                        </el-button>
                    </div>
                </div>
                <div v-else class="disconnected-container">
                    <el-button size="large" type="primary">
                        <router-link to="/login">Connexion</router-link>
                    </el-button>
                </div>
            </el-container>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                        <router-link to="/" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/page2" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Afficher la page 2
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Layout Options
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">6</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/layout/top-nav.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Top Navigation</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Top Navigation + Sidebar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/layout/boxed.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Boxed</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Fixed Sidebar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/layout/fixed-topnav.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Fixed Navbar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/layout/fixed-footer.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Fixed Footer</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Collapsed Sidebar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>

    export default {
        name: "Aside",
        props: {
            user: {}
        },
        methods: {
            logout() {
                this.$apiRequester.logout().then(response => {
                    location.reload()
                })
            }
        }
    }

</script>

<style scoped>

    .sidebar-user {
        margin: 1rem 0;
        padding-bottom: 1rem;
        display: flex;
        justify-content: center;
        border-bottom: 1px solid #4b545c;
    }
    .connected-container {
        display: flex;
        align-items: center;
        flex-direction: column;
    }
    .disconnected-container {

    }
    .user-container {
        display: flex;
        align-items: center;
    }
    .user-img {
        max-width: 70px;
    }
    .user-img img {
        width: 100%;
    }
    .user-info {
        color: white;
        margin-left: 20px;
    }
    .user-info p {
        margin: 0;
    }
    .logout-button {
        margin-top: 20px;
    }
    .logout-button span {
        color: black;
    }

</style>