<?php if(isset($_SESSION['user_id'])): ?>
    <header class="header">
        <div class="container">
            <div class="logo">
                ЛОГОТИП
            </div>
            <div class="right-menu">
                <a href="index.php">Главная</a>
                <a href="profile.php">Профиль</a>
                <a href="applications.php">Заявки</a>
                <a href="logout.php">Выйты</a>
            </div>
        </div>
    </header>

<?php else: ?>
    <header class="header">
        <div class="container">
            <div class="logo">
                ЛОГОТИП
            </div>
            <div class="right-menu">
                <a href="index.php">Главная</a>
                <a href="auth.php">Авторизация</a>
                <a href="reg.php">Регистрация</a>
            </div>
        </div>
    </header>
<?php endif; ?>