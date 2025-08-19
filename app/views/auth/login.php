<div class="login-box card">
    <h2>Iniciar sesión</h2>
    <?php if (!empty($error)): ?>
    <div class="alert error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST" action="<?php echo View::route('login'); ?>">
        <?php echo CSRF::input(); ?>
        <label>Email
            <input type="email" name="email" value="<?php echo Security::sanitize($email ?? ''); ?>" required>
        </label>
        <label>Contraseña
            <input type="password" name="password" required>
        </label>
        <button type="submit" class="btn">Entrar</button>
    </form>
</div>
