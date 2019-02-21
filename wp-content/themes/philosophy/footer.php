
<section class="s-extra">
    <div class="row top">            
        <div class="col tab-full about">
            <blockquote>
             <?php
                    if(is_active_sidebar('footer-sidebar-6')){
                    dynamic_sidebar('footer-sidebar-6');
                    }
                    ?>       
            </blockquote>
        </div> <!-- end about -->
    </div> <!-- end row -->
</section>
<hr/>
     <!-- s-footer
    ================================================== -->
    <footer class="s-footer">
        <div class="s-footer__main">
            <div id="footer-sidebar" class="row secondary">              
                <div class="col-two md-four mob-full s-footer__sitelinks" id="footer-sidebar1">                    
                    <?php
                    if(is_active_sidebar('footer-sidebar-1')){
                    dynamic_sidebar('footer-sidebar-1');
                    }
                    ?>       

                </div> <!-- end s-footer__sitelinks -->         
                <div class="col-two md-four mob-full s-footer__archives" id="footer-sidebar2">
                    <?php
                    if(is_active_sidebar('footer-sidebar-2')){
                    dynamic_sidebar('footer-sidebar-2');
                    }
                    ?>        
                </div> <!-- end s-footer__archives -->    
                <div class="col-two md-four mob-full s-footer__social" id="footer-sidebar3">                        
                         <?php
                    if(is_active_sidebar('footer-sidebar-3')){
                    dynamic_sidebar('footer-sidebar-3');
                    }
                    ?>
                </div> <!-- end s-footer__social -->
                <div class="col-five md-full end s-footer__subscribe" id="footer-sidebar4">             
                        <?php
                        if(is_active_sidebar('footer-sidebar-4')){
                        dynamic_sidebar('footer-sidebar-4');
                        }
                        ?>    
                </div> <!-- end s-footer__subscribe -->
            </div>
        </div> <!-- end s-footer__main -->

        <div class="s-footer__bottom">
            <div class="row">
                <div class="col-full">
                    <div class="s-footer__copyright">
                        <span>© Copyright Philosophy 2018</span> 
                        <span>Site Template by <a href="https://colorlib.com/">Colorlib</a></span>
                    </div>

                    <div class="go-top">
                        <a class="smoothscroll" title="Back to Top" href="#top"></a>
                    </div>
                </div>
            </div>
        </div> <!-- end s-footer__bottom -->

     <!-- end s-footer -->
	</footer>		
  </body>
</html>