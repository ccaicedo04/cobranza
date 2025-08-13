<?php
class DashboardController
{
    public function index(): void
    {
        if (!Auth::check()) {
            Response::redirect(View::route('login'));
        }
        View::render('dashboard/index', [
            'title' => 'Dashboard'
        ]);
    }
}
