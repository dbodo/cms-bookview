<?php
	get_header();
?>
<section class="s-content">     
        <div class="row narrow section-intro add-bottom text-center">
            <div class="col-full s-content__header">
                <h1>Dobrodošli na BookView!</h1>               
                <p class="lead">Mjesto na kojem možete pronaći sve informacije vezane o knjigama, njihovim piscima i izdavačima.</p>
            </div>
        </div>    
        <div class="row full section-intro add-bottom">
            <div class="row masonry-wrap">
              <div class="col-twelve tab-full text-center">
                  <h1> Novo dodane knjige </h1>
              </div>
                <div class="masonry">
                  <div class="grid-sizer"></div>
                        <?php
                          echo daj_knjige_pocetna();
                        ?> 
               </div>    
            </div>
        </div>       
</section>  
    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader">
            <div class="line-scale">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
<?php
	get_footer();
?>