<?php
if (!function_exists('inicijaliziraj_temu')) {
    function inicijaliziraj_temu()
    {
        add_theme_support('post-thumbnails');
        register_nav_menus(array(
            'glavni-menu' => "Glavni navigacijski izbornik",
            'sporedni-menu' => "Izbornik u podnožju"
        ));
        add_theme_support('custom-background', apply_filters('test_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => ''
        )));
        add_theme_support('customize-selective-refresh-widgets');
    }
}
add_action('after_setup_theme', 'inicijaliziraj_temu');
// regsitracija sidebar-a

function aktiviraj_sidebar()
{
    register_sidebar(array (
        'name' => "Glavni sidebar",
        'id' => 'glavni-sidebar',
        'description' => "Glavni sidebar",
        'before_widget' => '<div class="widget-content">',
        'after_widget' => "</div>",
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>'
    ));
    register_sidebar(array (
        'id' => 'footer-sidebar-1',
        'name' => 'Footer Sidebar 1',
        'description' => 'Brzi linkovi',
        'before_widget' => '<ul class="widget_text s-footer__linklist">',
        'after_widget' => '</ul>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
        ) );
    register_sidebar( array(
        'name' => 'Footer Sidebar 2',
        'id' => 'footer-sidebar-2',
        'description' => 'Arhiva',
        'before_widget' => '<ul class="s-footer__linklist">',
        'after_widget' => '</ul>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );
    register_sidebar( array(
        'name' => 'Footer Sidebar 3',
        'id' => 'footer-sidebar-3',
        'description' => 'Društvene mreže',
        'before_widget' => '<ul class="s-footer__linklist">',
        'after_widget' => '</ul>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );
     register_sidebar( array(
        'name' => 'Footer Sidebar 4',
        'id' => 'footer-sidebar-4',
        'description' => 'Pošta',
        'before_widget' => '<ul class="s-footer__linklist">',
        'after_widget' => '</ul>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );
     register_sidebar( array(
        'name' => 'Footer Sidebar 5',
        'id' => 'footer-sidebar-5',
        'description' => 'Društvene veze',
        'before_widget' => '<ul class="header__social">',
        'after_widget' => '</ul>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );
     register_sidebar( array(
        'name' => 'Footer Sidebar 6',
        'id' => 'footer-sidebar-6',
        'description' => 'Citat',
        'before_widget' => '<div class="col tab-full about">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );
}
add_action('widgets_init', 'aktiviraj_sidebar');

//učitavanje CSS datoteke
function ucitaj_glavni_css()
{  
    wp_enqueue_style( 'fontawesome-css', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css');
    wp_enqueue_style( 'base-css', get_template_directory_uri() . '/css/base.css');
    wp_enqueue_style( 'fonts-css', get_template_directory_uri() . '/css/fonts.css');
    wp_enqueue_style( 'vendor-css', get_template_directory_uri() . '/css/vendor.css');
    wp_enqueue_style( 'main-css', get_template_directory_uri() . '/css/main.css');
    wp_enqueue_style( 'glavni-css', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'ucitaj_glavni_css');

//ucitavanje select2 
function ucitaj_select2()
{
    wp_enqueue_style( 'select2css', get_template_directory_uri() . '/assets/select2/select2.min.css' );
    wp_enqueue_script('select2js', get_template_directory_uri().'/assets/select2/select2.min.js', array('jquery'), true);
    wp_enqueue_script('select2-admin-js', get_template_directory_uri().'/js/init_select2.js', array('jquery'), true);
}
add_action( 'admin_enqueue_scripts', 'ucitaj_select2' );

//učitavanje javascript datoteke
function ucitaj_glavni_js()
{
    /*
    === VAŽNO ===
    Prije upisivanja linije ispod potrebno je kreirati direktorij js i u njemu
    kreirati datoteku skripta.js.
    */
    wp_enqueue_script('modernizr-js', get_template_directory_uri().'/js/modernizr.js' , array('jquery'), true);  
    wp_enqueue_script('pace-js', get_template_directory_uri().'/js/pace.min.js' , array('jquery'), true);   
    wp_enqueue_script('jquery-js', get_template_directory_uri().'/js/jquery-3.2.1.min.js' , array('jquery'), true);  
    wp_enqueue_script('plugins-js', get_template_directory_uri().'/js/plugins.js' , array('jquery'), true);       
    wp_enqueue_script('main-js', get_template_directory_uri().'/js/main.js' , array('jquery'), true);
    wp_enqueue_script('glavni-js', get_template_directory_uri(). '/js/skripta.js', array('jquery'), true);
}
add_action('wp_enqueue_scripts', 'ucitaj_glavni_js', 1);

// Register Custom Post Type
function registriraj_knjigu_cpt() {

    $labels = array(
        'name'                  => _x( 'Knjige', 'Post Type General Name', 'BookView' ),
        'singular_name'         => _x( 'Knjiga', 'Post Type Singular Name', 'BookView' ),
        'menu_name'             => __( 'Knjige', 'BookView' ),
        'name_admin_bar'        => __( 'Knjige', 'BookView' ),
        'archives'              => __( 'Knjige arhiva', 'BookView' ),
        'attributes'            => __( 'Atributi', 'BookView' ),
        'parent_item_colon'     => __( 'Roditeljski element', 'BookView' ),
        'all_items'             => __( 'Sve knjige', 'BookView' ),
        'add_new_item'          => __( 'Dodaj novu knjigu', 'BookView' ),
        'add_new'               => __( 'Dodaj novu', 'BookView' ),
        'new_item'              => __( 'Nova knjiga', 'BookView' ),
        'edit_item'             => __( 'Uredi knjigu', 'BookView' ),
        'update_item'           => __( 'Ažuriraj knjigu', 'BookView' ),
        'view_item'             => __( 'Pogledaj knjigu', 'BookView' ),
        'view_items'            => __( 'Pogledaj knjige', 'BookView' ),
        'search_items'          => __( 'Pretraži knjige', 'BookView' ),
        'not_found'             => __( 'Nije pronađeno', 'BookView' ),
        'not_found_in_trash'    => __( 'Nije pronađeno u smeću', 'BookView' ),
        'featured_image'        => __( 'Glavna slika', 'BookView' ),
        'set_featured_image'    => __( 'Postavi glavnu sliku', 'BookView' ),
        'remove_featured_image' => __( 'Ukloni glavnu sliku', 'BookView' ),
        'use_featured_image'    => __( 'Postavi za glavnu sliku', 'BookView' ),
        'insert_into_item'      => __( 'Umetni', 'BookView' ),
        'uploaded_to_this_item' => __( 'Preneseno', 'BookView' ),
        'items_list'            => __( 'Lista', 'BookView' ),
        'items_list_navigation' => __( 'Navigacija među knjigama', 'BookView' ),
        'filter_items_list'     => __( 'Filtiriranje knjiga', 'BookView' ),
    );
    $args = array(
        'label'                 => __( 'Knjiga', 'BookView' ),
        'description'           => __( 'Knjiga post type', 'BookView' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions'),        
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'knjiga', $args );

}
add_action( 'init', 'registriraj_knjigu_cpt', 0 );

// Registriraj taksonomiju tip knjige
function registriraj_taksonomiju_tip() {

    $labels = array(
        'name'                       => _x( 'Tipovi', 'Taxonomy General Name', 'BookView' ),
        'singular_name'              => _x( 'Tip', 'Taxonomy Singular Name', 'BookView' ),
        'menu_name'                  => __( 'Tipovi', 'BookView' ),
        'all_items'                  => __( 'Svi tipovi', 'BookView' ),
        'parent_item'                => __( 'Roditeljski tip', 'BookView' ),
        'parent_item_colon'          => __( 'Roditeljski tip', 'BookView' ),
        'new_item_name'              => __( 'Novi naziv tipa', 'BookView' ),
        'add_new_item'               => __( 'Dodaj novi tip', 'BookView' ),
        'edit_item'                  => __( 'Uredi tip', 'BookView' ),
        'update_item'                => __( 'Ažuriraj tip', 'BookView' ),
        'view_item'                  => __( 'Pogledaj tip', 'BookView' ),
        'separate_items_with_commas' => __( 'Odvojite tipove sa zarezima', 'BookView' ),
        'add_or_remove_items'        => __( 'Dodaj ili ukloni tipove', 'BookView' ),
        'choose_from_most_used'      => __( 'Odaberi među najčešće korištenima', 'BookView' ),
        'popular_items'              => __( 'Popularni tipovi', 'BookView' ),
        'search_items'               => __( 'Pretraži tipove', 'BookView' ),
        'not_found'                  => __( 'Nije pronađeno', 'BookView' ),
        'no_terms'                   => __( 'Nema tipa', 'BookView' ),
        'items_list'                 => __( 'Lista tipova', 'BookView' ),
        'items_list_navigation'      => __( 'Navigacija', 'BookView' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'tip', array( 'knjiga' ), $args );

}
add_action( 'init', 'registriraj_taksonomiju_tip', 0 );

function daj_knjige( $slug )
    {
        $args = array(
        'posts_per_page' => -1,
        'post_type' => 'knjiga',
        'post_status' => 'publish',
        'tax_query' => array(
                                array(
                                    'taxonomy' => 'tip_knjige',
                                    'field' => 'slug',
                                    'terms' => $slug
                                )
        ));
        $knjige = get_posts( $args );  
        $sHtml =  "";
        foreach ($knjige as $knjiga)
        {   
            $sKnjigaNaziv = $knjiga->post_title;
            if($sKnjigaNaziv != "")
            {
                $sKnjigaUrl = $knjiga->guid;
                $pisci_knjige = get_post_meta($knjiga->ID, 'pisci_knjige', true);
                $godinaIzdanja = get_post_meta($knjiga->ID, 'godina_izdanja_knjige', true);
                if( $pisci_knjige != "")
                {
                    $pisci_knjige = explode(",", $pisci_knjige);
                    foreach ($pisci_knjige as $pisac_id){
                         $pisac = get_post($pisac_id);
                         $sPisacNaziv = $pisac->post_title;
                         $sPisacUrl = $pisac->guid;
                    }
                }            
                $knjiga_slika = ""; 
                if( get_the_post_thumbnail_url($knjiga->ID) )
                {
                    $knjiga_slika = get_the_post_thumbnail_url($knjiga->ID);
                }
                else
                {
                    $knjiga_slika = get_template_directory_uri() .'/images/default_cover.png';
                }       
                $sHtml .= "<article class='masonry__brick entry format-standard aos-init aos-animate' data-aos='fade-up'>
                      <div class='entry__thumb'>
                            <a href='".$sKnjigaUrl."' class='entry__thumb-link' style='width: 100%; height: 350px;'>
                                <img src='".$knjiga_slika."' style='width: 100%; height: 350px;'>
                            </a>
                        </div>";

                $sKnjigaContent = strip_tags($knjiga->post_content);
                if(strlen($sKnjigaContent)==0){
                    $sKnjigaContent = 'Ova knjiga ne sadrži kratki opis!';
                }
                else{
                    $stringCut = substr($sKnjigaContent, 0, 220);
                    $endPoint = strrpos($strngCut, ' ');

                    $sKnjigaContent = $endPoint? substr($stringCut, 0, $endPoint) : substr ($stringCut, 0);
                    $sKnjigaContent .= '...<a href='.$sKnjigaUrl.'>Pročitaj više</a>';
                }
                $sHtml .= '<div class="entry__text" style="min-height: 460px">
                                <div class="entry__header">                            
                                    <h1 class="entry__title" style="padding:0; margin:5;"><a href='.$sKnjigaUrl.'>'.$sKnjigaNaziv.'</a></h1>
                                </div>
                                <div class="entry__excerpt" style="min-height: 200px">
                                    <p>
                                        '.$sKnjigaContent.'
                                    </p>
                                </div>
                                <div class="entry__date" style="text-align:right; min-height:40px">';
                $sPisacNaziv = "";
                $sPisacUrl = "";
                $pisci_knjige = get_post_meta($knjiga->ID, 'pisci_knjige', true);
                if( $pisci_knjige != "")
                {
                    $pisci_knjige = explode(",", $pisci_knjige);
                    foreach ($pisci_knjige as $pisac_id){
                         $pisac = get_post($pisac_id);
                         $sPisacNaziv = $pisac->post_title;
                         $sPisacUrl = $pisac->guid;
                         $sHtml.= '<a href='.$sPisacUrl.' title><h6 style="padding:0; margin:0;">'.$sPisacNaziv.'</h6></a>';
                    }
                }
                $sHtml .= '            <a href='.$sKnjigaUrl.'>'.$godinaIzdanja.'</a>
                                    </div>
                            <div style="text-align:right">';
                $sIzdavacNaziv = "";
                $sIzdavacUrl = "";
                $izdavaci_knjige = get_post_meta($knjiga->ID, 'izdavaci_knjige', true);
                if($izdavaci_knjige != ""){
                    $izdavaci_knjige = explode(",", $izdavaci_knjige);
                    foreach($izdavaci_knjige as $izdavac_id){
                        $izdavac = get_post($izdavac_id);
                        $sIzdavacNaziv = $izdavac->post_title;
                        $sIzdavacUrl = $izdavac->guid;
                        $sHtml.= '<a href='.$sIzdavacUrl.' title style="text-decoration: none"><p style="padding:0; margin:0;">'.$sIzdavacNaziv.'</p></a>';
                    }
                }
                $sHtml .= '</div>
                        </div>
                    </article>';
                    wp_reset_query();
            }
        }
        return $sHtml;
    }

    function daj_knjige_pocetna()
    {
        $args = array(
        'posts_per_page' => 3,
        'post_type' => 'knjiga',
        'post_status' => 'publish',
        );
        $knjige = get_posts( $args );  
        $sHtml =  "";
        foreach ($knjige as $knjiga)
        {   
            $sKnjigaNaziv = $knjiga->post_title;
            if($sKnjigaNaziv != "")
            {
                $sKnjigaUrl = $knjiga->guid;
                $godinaIzdanja = get_post_meta($knjiga->ID, 'godina_izdanja_knjige', true);    
                $knjiga_slika = ""; 
                if( get_the_post_thumbnail_url($knjiga->ID) )
                {
                    $knjiga_slika = get_the_post_thumbnail_url($knjiga->ID);
                }
                else
                {
                    $knjiga_slika = get_template_directory_uri() .'/images/default_cover.png';
                }       
                $sHtml .= "<article class='masonry__brick entry format-standard aos-init aos-animate' data-aos='fade-up' style='margin-left:2%; margin-right:2%'>
                      <div class='entry__thumb'>
                            <a href='".$sKnjigaUrl."' class='entry__thumb-link' style='width: 100%; height: 350px;'>
                                <img src='".$knjiga_slika."' style='width: 100%; height: 350px;'>
                            </a>
                        </div>";

                $sKnjigaContent = strip_tags($knjiga->post_content);
                if(strlen($sKnjigaContent)==0){
                    $sKnjigaContent = 'Ova knjiga ne sadrži kratki opis!';
                }
                else{
                    $stringCut = substr($sKnjigaContent, 0, 220);
                    $endPoint = strrpos($strngCut, ' ');

                    $sKnjigaContent = $endPoint? substr($stringCut, 0, $endPoint) : substr ($stringCut, 0);
                    $sKnjigaContent .= '...<a href='.$sKnjigaUrl.'>Pročitaj više</a>';
                }
                $sHtml .= '<div class="entry__text">
                                <div class="entry__header" style="padding-bottom: 5px; min-height: 30px;">                            
                                    <h1 class="entry__title" ><a href='.$sKnjigaUrl.'>'.$sKnjigaNaziv.'</a></h1>
                                </div>
                                <div class="entry__excerpt" style="min-height: 200px">
                                    <p>
                                        '.$sKnjigaContent.'
                                    </p>
                                </div>
                                <div class="entry__date" style="text-align:right; min-height:40px">';
                $pisci_knjige = get_post_meta($knjiga->ID, 'pisci_knjige', true);
                if( $pisci_knjige != "")
                {
                    $pisci_knjige = explode(",", $pisci_knjige);
                    foreach ($pisci_knjige as $pisac_id){
                         $pisac = get_post($pisac_id);
                         $sPisacNaziv = $pisac->post_title;
                         $sPisacUrl = $pisac->guid;
                         $sHtml.= '<a href='.$sPisacUrl.' title><h6 style="padding:0; margin:0;">'.$sPisacNaziv.'</h6></a>';
                    }
                }  
                $sHtml .= '        <a href='.$sKnjigaUrl.'>'.$godinaIzdanja.'</a>
                                </div>
                            </div>
                    </article>';
                    wp_reset_query();
            }
        }
        return $sHtml;
    }

// Registriraj taksonomiju žanr knjige
function registriraj_taksonomiju_zanr() {
    $labels = array(
        'name'                       => _x( 'Žanrovi', 'Taxonomy General Name', 'BookView' ),
        'singular_name'              => _x( 'Žanr', 'Taxonomy Singular Name', 'BookView' ),
        'menu_name'                  => __( 'Žanrovi', 'BookView' ),
        'all_items'                  => __( 'Svi žanrovi', 'BookView' ),
        'parent_item'                => __( 'Roditeljski žanr', 'BookView' ),
        'parent_item_colon'          => __( 'Roditeljski žanr', 'BookView' ),
        'new_item_name'              => __( 'Novi naziv žanra', 'BookView' ),
        'add_new_item'               => __( 'Dodaj novi žanr', 'BookView' ),
        'edit_item'                  => __( 'Uredi žanr', 'BookView' ),
        'update_item'                => __( 'Ažuriraj žanrove', 'BookView' ),
        'view_item'                  => __( 'Pogledaj žanrove', 'BookView' ),
        'separate_items_with_commas' => __( 'Odvojite žanrove sa zarezima', 'BookView' ),
        'add_or_remove_items'        => __( 'Dodaj ili ukloni žanrove', 'BookView' ),
        'choose_from_most_used'      => __( 'Odaberi među najčešće korištenima', 'BookView' ),
        'popular_items'              => __( 'Popularni žanrovi', 'BookView' ),
        'search_items'               => __( 'Pretraži žanrove', 'BookView' ),
        'not_found'                  => __( 'Nije pronađeno', 'BookView' ),
        'no_terms'                   => __( 'Nema žanra', 'BookView' ),
        'items_list'                 => __( 'Lista žanrova', 'BookView' ),
        'items_list_navigation'      => __( 'Navigacija', 'BookView' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'tip_knjige', array('knjiga'), $args );

}
add_action( 'init', 'registriraj_taksonomiju_zanr', 0 );


// Register Custom Post Type
function registriraj_knjizevnika_cpt() {

    $labels = array(
        'name'                  => _x( 'Književnici', 'Post Type General Name', 'BookView' ),
        'singular_name'         => _x( 'Književnik', 'Post Type Singular Name', 'BookView' ),
        'menu_name'             => __( 'Književnici', 'BookView' ),
        'name_admin_bar'        => __( 'Književnici', 'BookView' ),
        'archives'              => __( 'Književnici arhiva', 'BookView' ),
        'attributes'            => __( 'Atributi', 'BookView' ),
        'parent_item_colon'     => __( 'Roditeljski element', 'BookView' ),
        'all_items'             => __( 'Svi književnici', 'BookView' ),
        'add_new_item'          => __( 'Dodaj novog književnika', 'BookView' ),
        'add_new'               => __( 'Dodaj novog', 'BookView' ),
        'new_item'              => __( 'Novi književnik', 'BookView' ),
        'edit_item'             => __( 'Uredi književnika', 'BookView' ),
        'update_item'           => __( 'Ažuriraj književnika', 'BookView' ),
        'view_item'             => __( 'Pogledaj književnika', 'BookView' ),
        'view_items'            => __( 'Pogledaj književnike', 'BookView' ),
        'search_items'          => __( 'Pretraži književnike', 'BookView' ),
        'not_found'             => __( 'Nije pronađeno', 'BookView' ),
        'not_found_in_trash'    => __( 'Nije pronađeno u smeću', 'BookView' ),
        'featured_image'        => __( 'Glavna slika', 'BookView' ),
        'set_featured_image'    => __( 'Postavi glavnu sliku', 'BookView' ),
        'remove_featured_image' => __( 'Ukloni glavnu sliku', 'BookView' ),
        'use_featured_image'    => __( 'Postavi za glavnu sliku', 'BookView' ),
        'insert_into_item'      => __( 'Umetni', 'BookView' ),
        'uploaded_to_this_item' => __( 'Preneseno', 'BookView' ),
        'items_list'            => __( 'Lista', 'BookView' ),
        'items_list_navigation' => __( 'Navigacija među književnicima', 'BookView' ),
        'filter_items_list'     => __( 'Filtiriranje književnika', 'BookView' ),
    );
    $args = array(
        'label'                 => __( 'Književnik', 'BookView' ),
        'description'           => __( 'Knjizevnik post type', 'BookView' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions'),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'knjizevnik', $args );

}
add_action( 'init', 'registriraj_knjizevnika_cpt', 0 );

function daj_knjizevnike()
    {
        $args = array(
        'posts_per_page' => -1,
        'post_type' => 'knjizevnik',
        'post_status' => 'publish'
        );
        $knjizevnici = get_posts( $args );
        $sHtml = "<ul>";
        foreach ($knjizevnici as $knjizevnik)
        {
            $knjizevnikId = get_post($knjizevnik)->ID;
            $sKnjizevnikIme = $knjizevnik->post_title;
            if($sKnjizevnikIme != "")
            {
                $sKnjizevnikUrl = $knjizevnik->guid;
                $sKnjizevnikSlikaUrl = ""; 
                if( get_the_post_thumbnail_url($knjizevnik->ID) )
                {
                    $sKnjizevnikSlikaUrl = get_the_post_thumbnail_url($knjizevnik->ID);
                }
                else
                {
                    $sKnjizevnikSlikaUrl = get_template_directory_uri() .'/images/default_cover.png';
                }       
                $sHtml .= "<article class='masonry__brick entry format-standard aos-init aos-animate' data-aos='fade-up'>
                      <div class='entry__thumb'>
                            <a href='".$sKnjizevnikUrl."' class='entry__thumb-link' style='width: 100%; height: 350px;'>
                                <img src='".$sKnjizevnikSlikaUrl."' style='width: 100%; height: 350px;'>
                            </a>
                        </div>";
                $sKnjizevnikContent = strip_tags($knjizevnik->post_content);
                if(strlen($sKnjizevnikContent)==0){
                    $sKnjizevnikContent = 'Nismo pronašli informacije o književniku!';
                }
                else if(strlen($sKnjizevnikContent)<200){
                    $sKnjizevnikContent = $knjizevnik->post_content;
                }
                else{
                    $stringCut = substr($sKnjizevnikContent, 0, 200);
                    $endPoint = strrpos($strngCut, ' ');

                    $sKnjizevnikContent = $endPoint? substr($stringCut, 0, $endPoint) : substr ($stringCut, 0);
                    $sKnjizevnikContent .= '...<a href='.$sKnjizevnikUrl.'>Pročitaj više</a>';
                }
                $sHtml .= '<div class="entry__text" style="min-height: 400px">
                                <div class="entry__header" style="padding-bottom: 10px">                            
                                    <h1 class="entry__title" style="min-height: 30px;"><a href='.$sKnjizevnikUrl.'>'.$sKnjizevnikIme.'</a></h1>
                                </div>
                                <div class="entry__excerpt">
                                    <p style="min-height: 150px;">
                                        '.$sKnjizevnikContent.'
                                    </p>
                                </div>';
                $args = array(
                            'post_type'     =>  'knjiga',
                            'post_status'   =>  'publish',
                            'meta_query'    =>  array(
                                array(
                                    'key'   => 'pisci_knjige',
                                    'value' =>  $knjizevnikId,
                                    'compare'=> 'LIKE'
                                )
                             )
                        );
                $query = new WP_Query( $args );          
                $knjige = $query->posts;
                $sKnjigaNaziv = "";
                $sKnjigaUrl = "";
                $sHtml .= '<div class="entry__date" style="text-align:right; min-height:40px">';
                foreach($knjige as $knjiga){
                    $sKnjigaNaziv = $knjiga->post_title;
                    $sKnjigaUrl = $knjiga->guid;
                    $sHtml .= '<a href='.$sKnjigaUrl.' title><h6 style="padding:0; margin:0;">'.$sKnjigaNaziv.'</h6></a>';
                }
                 $sHtml .= '    </div>
                            </div>
                    </article>';
                    wp_reset_query();
            }
        }
        return $sHtml;
    }

// Register Custom Post Type
function registriraj_izdavaca_cpt() {

    $labels = array(
        'name'                  => _x( 'Izdavači', 'Post Type General Name', 'BookView' ),
        'singular_name'         => _x( 'Izdavač', 'Post Type Singular Name', 'BookView' ),
        'menu_name'             => __( 'Izdavači', 'BookView' ),
        'name_admin_bar'        => __( 'Izdavači', 'BookView' ),
        'archives'              => __( 'Izdavači arhiva', 'BookView' ),
        'attributes'            => __( 'Atributi', 'BookView' ),
        'parent_item_colon'     => __( 'Roditeljski element', 'BookView' ),
        'all_items'             => __( 'Svi izdavači', 'BookView' ),
        'add_new_item'          => __( 'Dodaj novog izdavača', 'BookView' ),
        'add_new'               => __( 'Dodaj novog', 'BookView' ),
        'new_item'              => __( 'Novi izdavač', 'BookView' ),
        'edit_item'             => __( 'Uredi izdavača', 'BookView' ),
        'update_item'           => __( 'Ažuriraj izdavača', 'BookView' ),
        'view_item'             => __( 'Pogledaj izdavača', 'BookView' ),
        'view_items'            => __( 'Pogledaj izdavače', 'BookView' ),
        'search_items'          => __( 'Pretraži izdavače', 'BookView' ),
        'not_found'             => __( 'Nije pronađeno', 'BookView' ),
        'not_found_in_trash'    => __( 'Nije pronađeno u smeću', 'BookView' ),
        'featured_image'        => __( 'Glavna slika', 'BookView' ),
        'set_featured_image'    => __( 'Postavi glavnu sliku', 'BookView' ),
        'remove_featured_image' => __( 'Ukloni glavnu sliku', 'BookView' ),
        'use_featured_image'    => __( 'Postavi za glavnu sliku', 'BookView' ),
        'insert_into_item'      => __( 'Umetni', 'BookView' ),
        'uploaded_to_this_item' => __( 'Preneseno', 'BookView' ),
        'items_list'            => __( 'Lista', 'BookView' ),
        'items_list_navigation' => __( 'Navigacija među izdavačima', 'BookView' ),
        'filter_items_list'     => __( 'Filtiriranje izdavača', 'BookView' ),
    );
    $args = array(
        'label'                 => __( 'Izdavač', 'BookView' ),
        'description'           => __( 'Izdavac post type', 'BookView' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions'),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'izdavac', $args );

}
add_action( 'init', 'registriraj_izdavaca_cpt', 0 );

function daj_izdavace()
    {
        $args = array(
        'posts_per_page' => -1,
        'post_type' => 'izdavac',
        'post_status' => 'publish'
        );
        $izdavaci = get_posts( $args );
        $sHtml = "<ul>";
        foreach ($izdavaci as $izdavac)
        {
                $izdavacId = get_post($izdavac)->ID;
                $sIzdavacNaziv = $izdavac->post_title;
                if($sIzdavacNaziv != ""){
                $sIzdavacUrl = $izdavac->guid;            
                $sIzdavacSlikaUrl = ""; 
                if( get_the_post_thumbnail_url($izdavac->ID) )
                {
                    $sIzdavacSlikaUrl = get_the_post_thumbnail_url($izdavac->ID);
                }
                else
                {
                    $sIzdavacSlikaUrl = get_template_directory_uri() .'/images/default_cover.png';
                }       
                $sHtml .= "<article class='masonry__brick entry format-standard aos-init aos-animate' data-aos='fade-up'>
                      <div class='entry__thumb'>
                            <a href='".$sIzdavacUrl."' class='entry__thumb-link' style='width: 100%; height: 350px;'>
                                <img src='".$sIzdavacSlikaUrl."' style='width: 100%; height: 350px;'>
                            </a>
                        </div>";

                $sIzdavacContent = strip_tags($izdavac->post_content);
                if(strlen($sIzdavacContent)==0){
                    $sIzdavacContent = 'Nismo pronašli informacije o izdavaču!';
                }
                else if(strlen($sIzdavacContent)<200){
                    $sIzdavacContent = $izdavac->post_content;
                }
                else{
                    $stringCut = substr($sIzdavacContent, 0, 200);
                    $endPoint = strrpos($strngCut, ' ');

                    $sIzdavacContent = $endPoint? substr($stringCut, 0, $endPoint) : substr ($stringCut, 0);
                    $sIzdavacContent .= '...<a href='.$sIzdavacUrl.'>Pročitaj više</a>';
                }
                $sHtml .= '<div class="entry__text" style="min-height: 400px">
                                <div class="entry__header" style="padding-bottom: 10px">                            
                                    <h1 class="entry__title" style="min-height: 30px;"><a href='.$sIzdavacUrl.'>'.$sIzdavacNaziv.'</a></h1>
                                </div>
                                <div class="entry__excerpt">
                                    <p style="min-height: 150px">
                                        '.$sIzdavacContent.'
                                    </p>
                                </div>';
                                 

                $args = array(
                    'post_type'     =>  'knjiga',
                    'post_status'   =>  'publish',
                    'meta_query'    =>  array(
                        array(
                            'key'   => 'izdavaci_knjige',
                            'value' =>  "$izdavacId",
                            'compare'=> 'LIKE'
                        )
                     )
                );
                $query = new WP_Query( $args );          
                $knjige = $query->posts;
                $sKnjigaNaziv = "";
                $sKnjigaUrl = "";
                $sHtml .= '<div class="entry__date" style="text-align:right; min-height:30px">';
                foreach($knjige as $knjiga){
                    $sKnjigaNaziv = $knjiga->post_title;
                    $sKnjigaUrl = $knjiga->guid;
                    $sHtml .= '<a href='.$sKnjigaUrl.' title><h6 style="padding:0; margin:0;">'.$sKnjigaNaziv.'</h6></a>';
                }
                 $sHtml .= '    </div>
                            </div>
                    </article>';
                    wp_reset_query();
            }
        }
        return $sHtml;
    }

function add_meta_box_broj_stranica()
    {
    add_meta_box('bookview_knjiga_broj_stranica', 'Broj stranica', 'html_meta_box_knjiga_stranice', 'knjiga');
    }

function html_meta_box_knjiga_stranice($post)
    {
    wp_nonce_field('spremi_broj_stranica_knjige', 'broj_stranica_nonce');
    // dohvaćanje meta vrijednosti
    $broj_stranica = get_post_meta($post->ID, 'broj_stranica_knjige', true);
    echo '
            <div>
            <label for="broj_stranica_knjige">Broj stranica knjige: </label>
            <input type="text" id="broj_stranica_knjige"
            name="broj_stranica_knjige" value="' . $broj_stranica . '" />
            </div>';
    }

function spremi_broj_stranica_knjige($post_id)
    {
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce_broj_stranica = (isset($_POST['broj_stranica_nonce']) && wp_verify_nonce($_POST['broj_stranica_nonce'], basename(__FILE__))) ? 'true' : 'false';
    if ($is_autosave || $is_revision || !$is_valid_nonce_broj_stranica)
        {
        return;
        }

    if (!empty($_POST['broj_stranica_knjige']))
        {
        update_post_meta($post_id, 'broj_stranica_knjige', $_POST['broj_stranica_knjige']);
        }
      else
        {
        delete_post_meta($post_id, 'broj_stranica_knjige');
        }
    }
add_action('add_meta_boxes', 'add_meta_box_broj_stranica');
add_action('save_post', 'spremi_broj_stranica_knjige');

function add_meta_box_broj_poglavlja()
    {
    add_meta_box('bookview_knjiga_broj_poglavlja', 'Broj poglavlja', 'html_meta_box_knjiga_poglavlje', 'knjiga');
    }

function html_meta_box_knjiga_poglavlje($post)
    {
    wp_nonce_field('spremi_broj_poglavlja_knjige', 'broj_poglavlja_nonce');
    // dohvaćanje meta vrijednosti
    $broj_poglavlja = get_post_meta($post->ID, 'broj_poglavlja_knjige', true);
    echo '
            <div>
            <label for="broj_poglavlja_knjige">Broj poglavlja knjige: </label>
            <input type="text" id="broj_poglavlja_knjige"
            name="broj_poglavlja_knjige" value="' . $broj_poglavlja . '" />
            </div>';
    }

function spremi_broj_poglavlja_knjige($post_id)
    {
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce_broj_poglavlja = (isset($_POST['broj_poglavlja_nonce']) && wp_verify_nonce($_POST['broj_poglavlja_nonce'], basename(__FILE__))) ? 'true' : 'false';
    if ($is_autosave || $is_revision || !$is_valid_nonce_broj_poglavlja)
        {
        return;
        }

    if (!empty($_POST['broj_poglavlja_knjige']))
        {
        update_post_meta($post_id, 'broj_poglavlja_knjige', $_POST['broj_poglavlja_knjige']);
        }
      else
        {
        delete_post_meta($post_id, 'broj_poglavlja_knjige');
        }
    }
add_action('add_meta_boxes', 'add_meta_box_broj_poglavlja');
add_action('save_post', 'spremi_broj_poglavlja_knjige');

function add_meta_box_godina_izdanja()
    {
    add_meta_box('bookview_knjiga_godina_izdanja', 'Godina izdanja', 'html_meta_box_knjiga_godina_izdanja', 'knjiga');
    }

function html_meta_box_knjiga_godina_izdanja($post)
    {
    wp_nonce_field('spremi_godinu_izdanja', 'godina_izdanja_nonce');
    // dohvaćanje meta vrijednosti
    $godina_izdanja = get_post_meta($post->ID, 'godina_izdanja_knjige', true);
    echo '
            <div>
            <label for="godina_izdanja_knjige">Godina izdanja knjige: </label>
            <input type="text" id="godina_izdanja_knjige"
            name="godina_izdanja_knjige" value="' . $godina_izdanja . '" />
            </div>';
    }

function spremi_godinu_izdanja($post_id)
    {
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce_godina_izdanja = (isset($_POST['godina_izdanja_nonce']) && wp_verify_nonce($_POST['godina_izdanja_nonce'], basename(__FILE__))) ? 'true' : 'false';
    if ($is_autosave || $is_revision || !$is_valid_nonce_godina_izdanja)
        {
        return;
        }

    if (!empty($_POST['broj_poglavlja_knjige']))
        {
        update_post_meta($post_id, 'godina_izdanja_knjige', $_POST['godina_izdanja_knjige']);
        }
      else
        {
        delete_post_meta($post_id, 'godina_izdanja_knjige');
        }
    }
add_action('add_meta_boxes', 'add_meta_box_godina_izdanja');
add_action('save_post', 'spremi_godinu_izdanja');

function add_meta_box_pisci_knjige()
{
    add_meta_box( 'bookview_pisci_knjige', 'Pisci knjige', 'html_meta_box_pisci_knjige', 'knjiga', 'normal', 'low');
}
add_action( 'add_meta_boxes', 'add_meta_box_pisci_knjige' );

function html_meta_box_pisci_knjige($pisciPost)
{
    wp_nonce_field('spremi_pisce_knjige', 'pisci_knjige_nonce');

    //dohvaćanje meta vrijednosti
    $pisci_knjige_ids = get_post_meta($pisciPost->ID, 'pisci_knjige', true);

    //string u array
    $pisci_knjige_ids = explode( ',', $pisci_knjige_ids );

    //dohvati sve knjizevnike
    $args = array(
            'posts_per_page'    => -1,
            'post_type'         => 'knjizevnik',
            'post_status'       => 'publish',
        );
    $pisci = get_posts( $args ); 

    $pisci_form = '<select name="pisci[]" id="pisci[]" class="s2" multiple>';
    
    foreach ($pisci as $pisac) 
    {
        $selected_text = (in_array($pisac->ID, $pisci_knjige_ids)) ? "selected" : "" ;
        $pisci_form .= '<option '.$selected_text.' value="'.$pisac->ID.'">'.$pisac->post_title.'</option>';
    }

    $pisci_form .= '</select>';

    echo '
    <div>
            '.$pisci_form.'
    </div>';    
}

function spremi_pisce_knjige($post_id)
{
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce_pisci_knjige = ( isset( $_POST[ 'pisci_knjige_nonce' ] ) && wp_verify_nonce( $_POST[ 'pisci_knjige_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    if ( $is_autosave || $is_revision || !$is_valid_nonce_pisci_knjige) 
    {
        return;
    }
    if(!empty($_POST['pisci']))
    {
        //array u string
        $pisci = implode(",", $_POST['pisci']);
        update_post_meta($post_id, 'pisci_knjige', $pisci);
    }
    else
    {
        delete_post_meta($post_id, 'pisci_knjige');
    }

}
add_action( 'save_post', 'spremi_pisce_knjige' );

function daj_html_pisci_knjige($knjiga_id)
{
    $pisci_knjige_ids = get_post_meta($knjiga_id, 'pisci_knjige', true);

    $sHtml = "<div class='pisci_knjige'>";

    if( $pisci_knjige_ids != "")
    {
        $pisci_knjige_ids = explode(",", $pisci_knjige_ids);
        foreach ($pisci_knjige_ids as $pisac_id) 
        {
            $pisac = get_post($pisac_id);

            $pisac_slika = ""; 
            if( get_the_post_thumbnail_url($pisac_id) )
            {
                $pisac_slika = get_the_post_thumbnail_url($pisac_id);
            }
            else
            {
                $pisac_slika = get_template_directory_uri() .'/img/user.png';
            }
            $pisac_naziv = $pisac->post_title;
            $pisac_url = $pisac->guid;

            $sHtml.= "
                <a href='".$pisac_url."' class='pisac'>
                    <div class='pisac_slika' style='background-image: url(".$pisac_slika.")'></div>
                    <h6 class='pisac_naziv'>".$pisac_naziv."</h6>
                </a>
            ";
        }
    }
    else
    {
        $sHtml .= "<p>Knjiga nema dodanih pisaca</p>";
    }
    $sHtml .= '</div>';
    return $sHtml;
}   

function add_meta_box_izdavaci_knjige()
{
    add_meta_box( 'bookview_izdavaci_knjige', 'Izdavači knjige', 'html_meta_box_izdavaci_knjige', 'knjiga', 'normal', 'low');
}
add_action( 'add_meta_boxes', 'add_meta_box_izdavaci_knjige' );

function html_meta_box_izdavaci_knjige($izdavacPost)
{
    wp_nonce_field('spremi_izdavace_knjige', 'izdavaci_knjige_nonce');

    //dohvaćanje meta vrijednosti
    $izdavaci_knjige_ids = get_post_meta($izdavacPost->ID, 'izdavaci_knjige', true);

    //string u array
    $izdavaci_knjige_ids = explode( ',', $izdavaci_knjige_ids );

    //dohvati sve nastavnike
    $args = array(
            'posts_per_page'    => -1,
            'post_type'         => 'izdavac',
            'post_status'       => 'publish',
        );
    $izdavaci = get_posts( $args ); 

    $izdavaci_form = '<select name="izdavaci[]" id="izdavaci[]" class="s2" multiple>';
    
    foreach ($izdavaci as $izdavac) 
    {
        $selected_text = (in_array($izdavac->ID, $izdavaci_knjige_ids)) ? "selected" : "" ;
        $izdavaci_form .= '<option '.$selected_text.' value="'.$izdavac->ID.'">'.$izdavac->post_title.'</option>';
    }

    $izdavaci_form .= '</select>';

    echo '
    <div>
            '.$izdavaci_form.'
    </div>';    
}

function spremi_izdavace_knjige($post_id)
{
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce_pisci_knjige = ( isset( $_POST[ 'izdavaci_knjige_nonce' ] ) && wp_verify_nonce( $_POST[ 'izdavaci_knjige_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    if ( $is_autosave || $is_revision || !$is_valid_nonce_pisci_knjige) 
    {
        return;
    }


    if(!empty($_POST['izdavaci']))
    {
        //array u string
        $izdavaci = implode(",", $_POST['izdavaci']);
        update_post_meta($post_id, 'izdavaci_knjige', $izdavaci);
    }
    else
    {
        delete_post_meta($post_id, 'izdavaci_knjige');
    }

}
add_action( 'save_post', 'spremi_izdavace_knjige' );

function daj_html_izdavaci_knjige($knjiga_id)
{
    $izdavaci_knjige_ids = get_post_meta($knjiga_id, 'izdavaci_knjige', true);

    $sHtml = "<div class='izdavaci_knjige'>";

    if( $izdavaci_knjige_ids != "")
    {
        $izdavaci_knjige_ids = explode(",", $izdavaci_knjige_ids);
        foreach ($pisci_knjige_ids as $izdavac_id) 
        {
            $izdavac = get_post($izdavac_id);

            $izdavac_slika = ""; 
            if( get_the_post_thumbnail_url($izdavac_id) )
            {
                $izdavac_slika = get_the_post_thumbnail_url($izdavac_id);
            }
            else
            {
                $izdavac_slika = get_template_directory_uri() .'/img/user.png';
            }
        
            $izdavac_naziv = $izdavac->post_title;
            $izdavac_url = $izdavac->guid;

            $sHtml.= "
                <a href='".$izdavac_url."' class='izdavac'>
                    <div class='izdavac_slika' style='background-image: url(".$izdavac_slika.")'></div>
                    <h6 class='izdavac_naziv'>".$izdavac_naziv."</h6>
                </a>
            ";
        }
    }
    else
    {
        $sHtml .= "<p>Knjiga nema dodanih pisaca</p>";
    }
    $sHtml .= '</div>';
    return $sHtml;
}   
?>
