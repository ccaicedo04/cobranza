<?php
class DashboardModel
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function sedesPorColegio(int $idColegio): array
    {
        $stmt = $this->db->prepare('SELECT id_sede, nombre FROM sede WHERE id_colegio = :id');
        $stmt->execute([':id' => $idColegio]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function topResponsablesPorSaldo(int $idColegio, ?int $idSede = null): array
    {
        $sql = 'SELECT r.nombre_completo AS nombre, SUM(d.saldo_actual) AS saldo
                FROM responsable_financiero r
                JOIN estudiante e ON e.id_responsable = r.id_responsable
                JOIN deuda d ON d.id_estudiante = e.id_estudiante
                JOIN sede s ON r.id_sede = s.id_sede
                WHERE s.id_colegio = :id_col';
        $params = [':id_col' => $idColegio];
        if ($idSede) {
            $sql .= ' AND s.id_sede = :id_sede';
            $params[':id_sede'] = $idSede;
        }
        $sql .= ' GROUP BY r.id_responsable ORDER BY saldo DESC LIMIT 5';
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function carteraPorSede(int $idColegio, ?int $idSede = null): array
    {
        $sql = 'SELECT s.nombre, SUM(d.saldo_actual) AS saldo
                FROM sede s
                JOIN responsable_financiero r ON r.id_sede = s.id_sede
                JOIN estudiante e ON e.id_responsable = r.id_responsable
                JOIN deuda d ON d.id_estudiante = e.id_estudiante
                WHERE s.id_colegio = :id_col';
        $params = [':id_col' => $idColegio];
        if ($idSede) {
            $sql .= ' AND s.id_sede = :id_sede';
            $params[':id_sede'] = $idSede;
        }
        $sql .= ' GROUP BY s.id_sede';
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function recaudoUltimosMeses(int $idColegio, ?int $idSede = null, int $meses = 6): array
    {
        $sql = 'SELECT DATE_FORMAT(rp.fecha_pago, "%Y-%m") AS mes, SUM(rpd.valor_aplicado) AS total
                FROM registro_pago rp
                JOIN registro_pago_detalle rpd ON rpd.id_pago = rp.id_pago
                JOIN responsable_financiero r ON r.id_responsable = rp.id_responsable
                JOIN sede s ON s.id_sede = r.id_sede
                WHERE s.id_colegio = :id_col AND rp.fecha_pago >= DATE_SUB(CURDATE(), INTERVAL :meses MONTH)';
        $params = [':id_col' => $idColegio, ':meses' => $meses];
        if ($idSede) {
            $sql .= ' AND s.id_sede = :id_sede';
            $params[':id_sede'] = $idSede;
        }
        $sql .= ' GROUP BY mes ORDER BY mes';
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
