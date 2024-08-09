<template>
    <div class="container">
        <div class="row">
            <nav id="sidebar" class="col-6 bg-light sidebar">
                <div class="position-sticky">
                    <h4 class="text-center my-4">Admin Dashboard</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <router-link class="nav-link" to="/">
                                <i class="bi bi-house-door"></i> Dashboard
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/courses">
                                <i class="bi bi-book"></i> Cursos
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/students">
                                <i class="bi bi-person"></i> Usuários
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/enrollments">
                                <i class="bi bi-gear"></i> Inscrições
                            </router-link>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-6">
                <router-view></router-view>
            </main>
        </div>
    </div>
</template>

<script>
export default {
    name: 'App',
};
</script>

<style>
body {
    display: flex;
}

#sidebar {
    height: 100vh;
}

main {
    padding-top: 20px;
}
</style>
