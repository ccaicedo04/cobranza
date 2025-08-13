<div class="card">
    <h2>Dashboard</h2>
    <p>Bienvenido, <?php echo Security::sanitize(Auth::user()['nombre'] ?? ''); ?>.</p>
</div>
