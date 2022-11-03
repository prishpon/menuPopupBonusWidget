<?php
/**
 * Plugin Name:       Sv Bonus top menu
 * Plugin URI:
 * Description:       Inserts bonus icon with modal window in the header menu
 * Version:           1.0
 * Author:            Synced Vision
 */

 //do_action('sv_add_header_bonus_widget');

add_action( 'sv_add_header_bonus_widget', 'sv_add_header_bonus_widget_settings');

function sv_add_header_bonus_widget_settings(){ ?>
    <style>
        .bonus-widget-container{
            display:flex;
            align-items: center;
        }
        .bonus-widget-container:hover{
            cursor:pointer;
        }
        .bonus-box{
            display:flex;
            align-items: center;
        }
        #bonus-modal{
            position: fixed;
            width: 100%;
            height: 100vh;
            top: 0px;
            z-index: 1000;
            left: 0;
            color: black;
            display: none;
            background-color: #0000009e;
        }

        .bonus-modal-box-w2{
            display: flex;
            justify-content: flex-end;
            flex-direction:column;
            width:270px;
            float: right;
        }

        .bonus-modal-box{
            display:flex;
            align-items: center;
            justify-content: space-between;
            padding: 17px 9px 17px 15px;
            border-radius:10px;
            background-color:#620909;
            color:white;
            z-index:10;

        }
        .bonus-modal-box:hover{
            cursor:pointer;
        }

        .bonus-modal-box:nth-child(1) {
            z-index:1006;
            position:relative;
        }
        a.bonus-link:nth-child(1) {
            z-index:1006;
            position:relative;
        }
        .bonus-modal-box:nth-child(1)::before {
            content: " ";
            position: absolute;
            display: block;
            width: 0;
            height: 0;
            border-right: 16px solid transparent;
            border-left: 16px solid transparent;
            border-bottom: 10px solid #620909;
            position: absolute;
            top: -8px;
            right: 12px;
        }
        .bonus-modal-box:nth-child(2) {
            top: 125px;
        }
        a.bonus-link:nth-child(2) {
            top: 125px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25) !important;
            z-index:1005;
        }
        .bonus-modal-box:nth-child(3) {
            top: 200px;
        }
        a.bonus-link:nth-child(3) {
            top: 200px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25) !important;
            z-index:1004;
        }
        .bonus-modal-box:nth-child(4) {
            top: 265px;
            z-index:1003;
        }
        a.bonus-link:nth-child(4) {
            top: 265px;
            z-index:1003;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25) !important;
        }
        .bonus-modal-box:nth-child(5) {
            top: 324px;
            z-index:1002;
        }
        a.bonus-link:nth-child(5) {
            top: 324px;
            z-index:1002;
        }
        a.bonus-link{
            text-decoration:none;
            border-radius: 10px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25) !important;
        }
        #bonus-wraper{
            z-index:1001;
            position: relative;
            margin-right: 15px;
            width: 20px;
        }

        .bonus-button{
            background-color: #FFA216;
            margin-left: 2px;
            padding: 8px;
            font-size: 12px;
            font-weight: 900;
            border-radius: 2px;
            font-family: "Arial";
            width: 72px;
            text-transform:capitalize;
            text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.4);
        }
 
        .bonus-text p{
            line-height:14px;
            font-size:12px;
            font-weight:400;
            font-family: "Оpen Sans";
            width: 102px;
        }
        .bonus-text strong{
            font-size:20px;
            font-weight:700;
            font-family: "Оpen Sans";
            color:#FDCA14;
        }
        .logo-bonus img{
            height: 38px;
            width: 56px;
        }
        .present-count {
            color: white;
            font-weight: 500;
            font-size: 8px;
            z-index: 21;
            transform: translate(35.5px, -7.2px);
        }
        span.pres-count::before{
            content: '';
            display: block;
            height: 12px;
            width: 12px;
            background-color: #B81818;
            border-radius: 50%;
            transform: translate(28px, -7.5px);
            z-index: 1001;
                }
                .open-gift{
                    display:none;
                    width: 20px;
                    transform: translateX(5px);
                }
                .shake{
                    animation-name: shake;
                    animation-duration: 4.5s;
                    animation-iteration-count: infinite;
                    animation-timing-function: ease-in-out;
                    animation: shake 4.5s infinite ease-in-out;
                }
                .closed-gift img{
                    height:17px;
                    transform: translateX(0);
                }
                .open-gift img{
                    transform: translateX(10px);
                    height: 20px;
                }
                .closed-gift{
                z-index:-1;}
                @keyframes shake {
                    0%  { transform: rotate(0deg);}
                    4%  { transform: rotate(20deg);}
                    8%  { transform: rotate(-20deg);}
                    12%  { transform: rotate(20deg);}
                    16%  { transform: rotate(-20deg);}
                    20%  { transform: rotate(0deg);}
                }
                .show{
                    display:block !important;

                }
                .hide{
                    display:none !important;

                }


                @media screen and (max-width: 1025px){
                    #bonus-wraper {
                        margin-right: 30px;
                    }
                }
                @media screen and (max-width: 520px){
                    .trigger-mmenu .icon {
                        margin-right: -10px;
                    }
        }
        @media screen and (max-width: 425px){
            .trigger-mmenu .icon{
                margin-right: -20px;
            }
            .trigger-mmenu {
                overflow: unset;
            }
        }


    </style>
    <script>
        (function($) {
            $(function() {

                function resizeBonusModal(calib = 0){

                    var bonusPositionTop = 0;
                    var bannerPositionLeft = 0;

                    var bonusPosition = $('#bonus-wraper').offset();
                    bonusPositionTop = parseFloat(bonusPosition.top) + 35;
                    bannerPositionLeft = parseFloat(bonusPosition.left) - 220 - calib;

                    $('.bonus-modal-box-w2').css({position:'absolute'});
                    $('.bonus-modal-box-w2').css({top:bonusPositionTop,left:bannerPositionLeft});

                }

                resizeBonusModal();

                $( window ).resize(function() {
                    // console.log('resize Befoer ');
                    resizeBonusModal(0);
                });


                function openBanner(){
                    $('#bonus-modal').fadeIn(500).addClass("showModal");
                    $('.closed-gift').addClass("hide");
                    $('.open-gift').addClass("show");
                    $('.present-count').addClass("hide");
                    $('.pres-count').addClass("hide");
                }

                function closeBanner(){
                    $('#bonus-modal').fadeOut(500).removeClass("showModal");
                    $('.closed-gift').removeClass("hide");
                    $('.open-gift').removeClass("show");
                    $('.present-count').removeClass("hide");
                    $('.pres-count').removeClass("hide");
                }

                $('#bonus-wraper').click(function(e){
                    if($('#bonus-modal').hasClass("showModal")){
                        closeBanner();
                    }else{
                        openBanner();
                    }
                });


                $('#bonus-modal').click(function(e) {


                    if (e.target.id == 'bonus-modal') {
                        $(e.target).fadeOut(500).removeClass("showModal");
                        $( ".open-gift" ).removeClass("show");
                        $( ".closed-gift" ).removeClass("hide");
                        $( ".present-count" ).removeClass("hide");
                        $('.pres-count').removeClass("hide");
                    }
                });

                //number of banners in circle
                var countBox = $('.bonus-modal-box');
                var countBoxN = countBox.length;
                $('.present-count').append(countBoxN);
            });


        })(jQuery);
    </script>
    <div class="bonus-box">
        <div class="bonus-widget-container" id="bonus-wraper">
            <div class="present-count">
            </div>
            <span class="pres-count"></span>
            <div class="closed-gift shake">
                <?php if(get_field('bonus_icon1','option')){ ?>
                    <img src="<?= get_field('bonus_icon1','option');?>" width="20" height="20"  alt="bonus">
                <?php } ;?>
            </div>
            <div class="open-gift">
                <?php if(get_field('bonus_icon2','option')){ ?>
                    <img src="<?= get_field('bonus_icon2','option');?>" width="20" height="20"  alt="bonus">
                <?php } ;?>
            </div>
        </div>
        <div id="bonus-modal" class="">

            <?php if( have_rows('bonus_popup_box', 'option')) : ?>
                <div class="bonus-modal-box-w2 animated fadeInRight">
                    <?php
                    // loop through the rows of data
                    while ( have_rows('bonus_popup_box', 'option') ) : the_row(); ?>

                        <?php
                        $link = get_sub_field('banner_link');
                        if( $link ):
                            $link_url = $link['url'];
                            $link_target = $link['target'];
                            ?>
                        <?php endif; ?>
                        <a href="<?php echo $link['url']; ?>" target="_blank" class="bonus-link">
                            <div class="bonus-modal-box">
                                <div class="logo-bonus">
                                    <img src="<?php  if(get_sub_field('logo')) {
                                        echo get_sub_field('logo');} ?>" alt="">
                                </div>
                                <div class="bonus-text">
                                    <?php  if(get_sub_field('text')) {
                                        echo get_sub_field('text');} ?>
                                </div>
                                <div class="bonus-button">
                                    <?php  if(get_sub_field('button_text')) {
                                        echo get_sub_field('button_text');} ?>
                                </div>

                            </div>
                        </a>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
    <?php
}