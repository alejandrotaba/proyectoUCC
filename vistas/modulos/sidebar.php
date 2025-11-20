        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!-- <i class="fas fa-laugh-wink"></i> -->
                    <img src="vistas/administrativas/img/undraw_posting_photo.svg" alt="" width="50px">
                </div>
                <div class="sidebar-brand-text mx-3">Inventario</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Usuarios -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="usuarios">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Usuarios</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider">



            <!-- Heading -->
            <div class="sidebar-heading">
                Inventario
            </div>

            <!-- Administradores -->
            <li class="nav-item">
                <a class="nav-link" href="administradores">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Administradores</span></a>
            </li>

            <!-- Categorías -->
            <li class="nav-item">
                <a class="nav-link" href="categorias">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Categorías</span></a>
            </li>

            <!-- Productos -->
            <li class="nav-item">
                <a class="nav-link" href="productos">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Productos</span></a>
            </li>


            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->

            <!-- Clientes -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="clientes">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Clientes</span></a>
            </li> -->

            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->


            <!-- Ventas -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Ventas</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestión de ventas:</h6>
                        <a class="collapse-item" href="ventas">Administrar ventas</a>
                        <a class="collapse-item" href="crear-venta">Crear Venta</a>
                        <a class="collapse-item" href="reportes">Reporte de Ventas</a>
                    </div>
                </div>
            </li> -->

            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->

            <!-- Salir -->
            <li class="nav-item">
                <a class="nav-link" href="salir">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Salir</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        <script>
         async function crearBoton(){
          const titulo = prompt("Nombre del botón:");
    if(!titulo) return;
    const resp = await fetch('/api/dashboard/crear_boton.php', {
        method:'POST', headers:{'Content-Type':'application/json'},
        body: JSON.stringify({titulo})
    });
    const j = await resp.json();
    if(j.ok) {
        alert('Botón creado');
        location.reload();
    } else alert('Error: '+j.msg);
 }

 async function eliminarBoton(id){
    if(!confirm('¿Estás seguro de eliminar este botón?')) return;
    const resp = await fetch('/api/dashboard/eliminar_boton.php', {
        method:'POST', headers:{'Content-Type':'application/json'},
        body: JSON.stringify({id})
    });
    const j = await resp.json();
    if(j.ok) location.reload(); else alert(j.msg);
    }
       </script>


        </ul>