<?php
	get_header();
?>
<?php
if ( have_posts() )
{
	while ( have_posts() )
	{
		the_post();
		$sIstaknutaSlika = "";	
		if( get_the_post_thumbnail_url($post->ID) )
		{
			$sIstaknutaSlika = get_the_post_thumbnail_url($post->ID);
		}
		else
		{
			$sIstaknutaSlika = get_template_directory_uri(). '/images/thumbs/about/about-500.jpg';
		}
	}
}
?>
  <section class="s-content">   
        <div class="row">     
          <div class="s-content__header col-full">
                <h1 class="s-content__header-title">
                    <?php echo $post->post_title; ?>       
                </h1>               
            </div>
        </div>
        <div class="row">
          <div class="col-six tab-full">
            <?php
              if($post->post_content){
               echo '<h3>Ukratko o književniku</h3>
               <p class="drop-cap">';
               echo $post->post_content;
               echo '</p>';
               }
               else{
                echo '<h3>Nema informacija o književniku!</h3>';
               }
              ?>              
            <div>
             <?php 
               $args = array(
                  'post_type'     =>  'knjiga',
                  'post_status'   =>  'publish',
                  'meta_query'    =>  array(
                      array(
                          'key'   => 'pisci_knjige',
                          'value' =>  $post->ID,
                          'compare'=> 'LIKE'
                      )
                   )
              );
              $query = new WP_Query( $args );          
              $knjige = $query->posts;  
              if($knjige){
                echo '<h3>Knjige</h3><ol><ul>';
                foreach($knjige as $knjiga){
                    $sKnjigaNaziv = $knjiga->post_title;
                    $sKnjigaUrl = $knjiga->guid;
                    echo '<li><a href='.$sKnjigaUrl.'>'.$sKnjigaNaziv.'</a></li>';             
                }
                echo '</ul>';
                wp_reset_query();
              }
               ?>
            </div>         
          </div>
          <div class="col-six tab-full" style="height:100%">
            <p style="text-align:center; vertical-align: middle;">
              <img src="<?php echo $sIstaknutaSlika ?>"/>
            </p>
          </div>
       </div>    
    </section>
<?php
get_footer();
?>