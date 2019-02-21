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

		$oZanr = wp_get_post_terms( $post->ID, 'tip_knjige' );
		$sZanr = "-";
		$oTip = wp_get_post_terms( $post->ID, 'tip' );
		$sTip = "-";
		$sBrojStranica = get_post_meta($post->ID, 'broj_stranica_knjige', true);
		$sBrojPoglavlja = get_post_meta($post->ID, 'broj_poglavlja_knjige', true);
		$sGodinaIzdanja = get_post_meta($post->ID, 'godina_izdanja_knjige', true);
		if(sizeof($sZanr)>0)
		{
			$sZanr = $oZanr[0]->name;
		}
		if(sizeof($oTip)>0)
		{
			$sTip = $oTip[0]->name;
		}		
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
	                <?php	     
	                	$sPisci = get_post_meta($post->ID,'pisci_knjige', true);     
	              		if($sPisci != '') {
							$sPisci = explode(",", $sPisci);
					        foreach ($sPisci as $pisac) 
					        {			        	
		        	 			$resultPisac = get_post($pisac);
		        	 			$sPisacUrl = $resultPisac->guid;
		        	 			$pisci[] = $resultPisac->post_title;
		        	 		}
		        	 		$pisci = implode(", ",$pisci);
		        	 		echo '<a href='.$sPisacUrl.' title style="text-decoration: none"><p class="lead">'.$pisci.'</p></a>';
						}
					    else { 
					       	echo "Ne definiran pisac";
					     }						             
					 ?>                	           
            </div>
        </div>

        <div class="row">
        	<div class="col-six tab-full">
        		<p>
        		<?php 
        		if($post->post_content){
        			echo '<h3>Ukratko o knjizi</h3>
           			<p class="drop-cap">';
					echo $post->post_content;
					echo '</p';
        		}
        		else{
        			echo '<h3>Nema informacija o knjizi!</h3>';
        		}
        		?>		
        		</p>		
        	</div>
        	<div class="col-six tab-full" style="height:100%">
            	<p style="text-align:center; vertical-align: middle;">
            		<img src="<?php echo $sIstaknutaSlika ?>"/>
           		 </p>
        	</div>
   		 </div>
   		 <div class="row">
        	<div class="col-six tab-full">
        		<h3>Detalji knjige</h3>
	   		 	<?php 
	   		 		if($sZanr){
		   		 		echo '<p>Žanr: '.$sZanr.'</p>';
		   		 	}
	   		 		if($sTip){
	   		 		echo '<p>Tip: '.$sTip.'</p>';
	   		 		}
	   		 		if($sBrojStranica){
	   		 			echo '<p>Broj stranica: '.$sBrojStranica.'</p>';
	   		 		}
	   		 		if($sBrojPoglavlja){
	   		 			echo '<p>Broj poglavlja: '.$sBrojPoglavlja.'</p>';
	   		 		}
	   		 		if($sGodinaIzdanja){
	   		 			echo '<p>Godina izdanja: '.$sGodinaIzdanja.'</p>';
	   		 		}
	   		 	?>
   			 </div>
   			 <div class="col-six tab-full">
   			 	<h3>Izdavač</h3>
   			 	<div><?php
   			 		$sIzdavaci = get_post_meta($post->ID,'izdavaci_knjige', true);     
          			if($sIzdavaci != '') {
						$sIzdavaci = explode(",", $sIzdavaci);
						$sIzdavacUrl = "";
				        foreach ($sIzdavaci as $izdavac) 
				        {				        
	        	 			$resultIzdavac = get_post($izdavac);
	        	 			$sIzdavacUrl = $resultIzdavac->guid;
	        	 			$izdavaci[] = $resultIzdavac->post_title;
	        	 		}
	        	 		$izdavaci = implode(", ",$izdavaci);
	        	 		echo '<a href='.$sIzdavacUrl.' title style="text-decoration: none"><p>'.$izdavaci.'</p></a>';
					}
				    else { 
				       	echo "Ne definiran izdavač";
				     }				
   			 	?></div>
   			 </div>
   		 </div>          
    </section>
<?php
get_footer();
?>