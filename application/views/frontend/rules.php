<main class="container" id="beranda-main">
    <article class="row align-items-center justify-content-around">
        <div class="col-5 mb-5">
            <header>
                <h2 id="article-heading" class="fw-bold">Rules</h2>
            </header>
            <?php foreach ($rules AS $r){ 
                echo '<p>'.$r->ru_title.'</p>'; 
                echo $r->ru_desc; 
            } ?>    
            <p>Laporan langsung ke email icr_indonesia@yahoo.com atau ke aplikasi</p>
        </div>
    </article>
</main>