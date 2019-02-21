<?php
	get_header();
?>
     <section class="s-content">        
        <div class="row masonry-wrap">
          <div class="s-content__header col-full">
              <h1 class="s-content__header-title">
                  Izdavači
              </h1>
          </div>
            <div class="masonry" style="position: relative;">
              <div class="grid-sizer"></div>
                    <?php
                      echo daj_izdavace();
                    ?>  
          </div>      
        </div>        
    </section>
<?php
	get_footer();
?>

