<?php
class DashboardController
{
    public function index(): void
    {
        if (!Auth::check()) {
            Response::redirect(View::route('login'));
        }
        $user = Auth::user();
        $model = new DashboardModel();
        $idColegio = (int)$user['id_colegio'];
        $idSede = isset($_GET['id_sede']) && $_GET['id_sede'] !== '' ? (int)$_GET['id_sede'] : null;

        $sedes = $model->sedesPorColegio($idColegio);
        $top = $model->topResponsablesPorSaldo($idColegio, $idSede);
        $cartera = $model->carteraPorSede($idColegio, $idSede);
        $recaudo = $model->recaudoUltimosMeses($idColegio, $idSede);

        View::render('dashboard/index', [
            'title' => 'Dashboard',
            'sedes' => $sedes,
            'selectedSede' => $idSede,
            'topResponsables' => $top,
            'cartera' => $cartera,
            'recaudo' => $recaudo,
            'styles' => ['css/dashboard/index.css'],
            'scripts' => ['js/dashboard/index.js']
        ]);
    }
}
