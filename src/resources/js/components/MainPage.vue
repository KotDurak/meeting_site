<script setup>

</script>

<template>

    <header>
        <!-- Фиксированная навигационная панель -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Сайт знакомств</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Переключить навигацию">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <router-link to="/" class="nav-link active" aria-current="page" href="#">Главная</router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ссылка</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Поиск" aria-label="Поиск">
                        <button class="btn btn-outline-success" type="submit">Поиск</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- Начало содержимого страницы -->
    <main class="flex-shrink-0">
        <div class="container">
           <slot/>
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Сайт знакомств</span>
        </div>
    </footer>
</template>

<style scoped>

</style>
