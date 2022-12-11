<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>List Anjing</title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <script src="<?= base_url('assets/js/datatables/jquery.dataTables.min.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/datatables/dataTables.bootstrap5.min.js') ?>" type="text/javascript"></script>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>

    <main class="container" id="beranda-main">
        <article class="row align-items-center justify-content-around">
            <header class="mb-5">
                <h2 class="text-center fw-bold">List Anjing</h2>
            </header>

            <!-- <div class="search-container">
                <form action="/action_page.php">
                <input type="text" placeholder="No. ICR/Nama" name="search">
                <button type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div> -->
            
            <table id="tabel_list_anjing" class="table text-white">
                <thead>
                    <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">Nomor ICR</th>
                        <th scope="col">Nama</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($canines as $canine) 
                    {
                        echo "<tr>";
                        echo '<td scope="col">' . $canine->can_photo . '</td>';
                        echo '<td scope="col">' . $canine->can_icr_number . '</td>';
                        echo '<td scope="col">' . $canine->can_a_s . '</td>';
                        echo '<td scope="col"><a href="canine_detail" class="btn btn-light"><i class="bi bi-list"></i></a></td>';
                        echo '<td scope="col"><a href="edit_canine" class="btn btn-light"><i class="bi bi-pencil-square"></i></a></td>';
                        echo '<td scope="col"><a href="canine_detail" class="btn btn-light"><i class="bi bi-file-earmark"></i></a></td>';
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </article>
    </main>
    
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script type="text/javascript">
    $(function() {
        $("#tabel_list_anjing").dataTable({
            "iDisplayLength": 10,
            "aLengthMenu": [[10, 25, 50, 100,  -1], [10, 25, 50, 100, "All"]],
            "aaSorting": []
        });
    });
    </script>
</body>
</html>

