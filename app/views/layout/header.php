<header class="topbar">
    <h1><a href="<?php echo View::route('dashboard'); ?>">Cobranza</a></h1>
    <?php if (Auth::check()): ?>
    <nav><a href="<?php echo View::route('logout'); ?>">Salir</a></nav>
    <?php endif; ?>
</header>
<main class="container">
