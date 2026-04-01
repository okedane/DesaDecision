<x-app>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Status Pelamar</h3>
                    <p class="text-subtitle text-muted">For admin to check their list</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header float-start float-lg-end'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Status Pelamar</li>
                        </ol>
                    </nav>  
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0">Status Pelamar</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class='table table-striped w-100'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             
                                    <tr>
                                        <td>1</td>
                                        <td>1233445677</td>
                                        <td>Dhani</td>
                                        <td>Lolos</td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="btn btn-sm btn-success me-2">
                                                    <i class="bi bi-check-circle"></i> Lolos
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="bi bi-x-circle"></i> Tidak Lolos
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                               =
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </section>
    </div>

</x-app>
