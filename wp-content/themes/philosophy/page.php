<?php
get_header();
?>

   <section class="s-content">        
        <div class="row">
            <div class="row half-bottom">

            	<div class="col-full">    
            	               	<?php   
if (have_posts()) {
    while (have_posts()) {
         the_post();
         the_content();
    }
}
?>      
            	</div>

       		 </div> 
       	</div>         
    </section>
<?php
get_footer();
?>