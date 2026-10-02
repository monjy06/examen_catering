<?php




// ===== APARTADO 7: Eliminar servicio =====
if ($accion === 'eliminar' && isset($_GET['indice'])) {
    $indice = (int)$_GET['indice'];
    if (isset($_SESSION['servicios'][$indice])) {
        array_splice($_SESSION['servicios'], $indice, 1);
        incrementarVersion();
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}




<!-- ===== APARTADO 6: Visualización de servicios ===== -->
<h2>Servicios</h2>
<?php if ($total_servicios === 0): ?>
    <p>No hay servicios en el presupuesto.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Uds.</th>
                <th>Código</th>
                <th>Descripción</th>
                <th>Precio ud.</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['servicios'] as $indice => $s): ?>
                <tr>
                    <!-- ===== APARTADO 9: Botones + y - ===== -->
                    <td>
                        <a href="?accion=modificar_unidades&indice=<?= $indice ?>&delta=-1">−</a>
                        <?= $s['unidades'] ?>
                        <a href="?accion=modificar_unidades&indice=<?= $indice ?>&delta=1">+</a>
                    </td>
                    <td><?= htmlspecialchars($s['codigo']) ?></td>
                    <td><?= htmlspecialchars($s['descripcion']) ?></td>
                    <td><?= number_format($s['precio_unidad'], 2, ',', '.') ?> €</td>
                    <td><?= number_format($s['unidades'] * $s['precio_unidad'], 2, ',', '.') ?> €</td>
                    <!-- ===== APARTADO 7: Enlace eliminar ===== -->
                    <td>
                        <a href="?accion=eliminar&indice=<?= $indice ?>" onclick="return confirm('¿Eliminar este servicio?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Estadísticas</h3>
    <ul>
        <li>Total servicios: <?= $total_servicios ?></li>
        <li>Total unidades: <?= $total_unidades ?></li>
        <li>Bruto: <?= number_format($bruto, 2, ',', '.') ?> €</li>
        <li>Descuento: <?= number_format($descuento, 2, ',', '.') ?> €</li>
        <li>IVA (10%): <?= number_format($iva, 2, ',', '.') ?> €</li>
        <li>Neto: <?= number_format($neto, 2, ',', '.') ?> €</li>
    </ul>
<?php endif; ?>




</body>
</html>