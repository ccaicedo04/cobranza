<div class="card">
    <h2>Dashboard</h2>
    <form method="get">
        <label for="id_sede">Sede:</label>
        <select id="id_sede" name="id_sede" onchange="this.form.submit()">
            <option value="">Todas</option>
            <?php foreach ($sedes as $s): ?>
            <option value="<?php echo $s['id_sede']; ?>"<?php echo $selectedSede == $s['id_sede'] ? ' selected' : ''; ?>><?php echo Security::sanitize($s['nombre']); ?></option>
            <?php endforeach; ?>
        </select>
    </form>
    <div class="dashboard-charts grid3">
        <canvas id="chartPie"></canvas>
        <canvas id="chartBar"></canvas>
        <canvas id="chartLine"></canvas>
    </div>
</div>
<script>
window.dashboardData = {
    topResponsables: <?php echo json_encode($topResponsables); ?>,
    cartera: <?php echo json_encode($cartera); ?>,
    recaudo: <?php echo json_encode($recaudo); ?>
};
</script>
