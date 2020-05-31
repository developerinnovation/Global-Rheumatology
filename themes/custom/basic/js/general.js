var read = 1;
var shared = 1;
var limitResume = 250;
(function($) {
    $(document).ready(function() {

        // <!------------------------------- General ------------------------------>

        // icono enviar artículo

        $("#launcher-button").mouseover(function() {
            $(".launcher-message").addClass("active");
        }).mouseout(function() {
            $(".launcher-message").removeClass("active");
        });

        // save whit OWL profile user
        $(".text .entity.save").click(function() {
            var saved = $(this).hasClass("saved");
            if (saved) {
                $(this).closest('.owl-item').remove();
                $(this).closest('.views-row').remove();
            }
            $(this).toggleClass("saved");
            $.get("http://" + window.location.host + "/node/" + $(this).attr("data-id") + "/add-to-entity-wishlist");
        });

        // save view simple
        $(".text div.save").click(function() {
            check_user(this);
        });

        // save node
        $(".buttons div.node_save").click(function() {
            check_user(this);
        });

        $("#btn-menu").click(function() {
            $("#main-menu").toggleClass("active");
            $(".box-menu").toggleClass("active");
            $("#btn-menu").toggleClass("active");
        });

        $(".main.navigation__item a.submenu").click(function() {
            $(this).parent().first().toggleClass("active");
            $(this).parent().find("ul.box.main").first().toggleClass("inactive");
            console.log("entra");
        });

        $(".seconds.submenu a.seconds").click(function() {
            $(this).parent().find("ul.seconds").first().toggleClass("inactive");
        });

        if (document.documentElement.lang == "en") {
            setTimeout(function() {
                $("li.en").addClass("active");
            }, 500);
        } else if (document.documentElement.lang == "es") {
            setTimeout(function() {
                $("li.es").addClass("active");
            }, 500);
        } else {
            setTimeout(function() {
                $("li.po").addClass("active");
            }, 500);
        }

        // <!------------------------------- Home ------------------------------>

        $("#main .first_new .views-element-container ul").owlCarousel({
            nav: true,
            loop: false,
            navRewind: false,
            center: true,
            items: 1,
        });

        $("#read").click(function() {
            $(".more-read").toggleClass("active");
            $(".more-shared").toggleClass("active");
        });

        // Scroll fixed header Home
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 100) {
                $("#header.home").addClass("fixed");
                $(".launcher-box-message").addClass("active");
            } else {
                $("#header.home").removeClass("fixed");
                $(".launcher-box-message").removeClass("active");
            }
        });

        // Scroll fixed header Not-Home
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 1) {
                $("#header.not-home .container").addClass("fixed");
                $(".launcher-box-message").addClass("active");
            } else {
                $("#header.not-home .container").removeClass("fixed");
                $(".launcher-box-message").removeClass("active");
            }
        });

        setTimeout(function() {
            $("div.bottom .view_news.more-read .owl-item .item-news .count").each(function(index) {
                $(this).text(read++);
            });

            $("div.bottom .view_news.more-shared .owl-item .item-news .count").each(function(index) {
                $(this).text(shared++);
            });
        }, 500);

        // redirect to login user anonime
        $(".send-article.new-article.anonime").click(function() {
            if (document.documentElement.lang == "en") {
                window.open("http://" + window.location.host + "/en/user/login?action=new-article");
            } else if (document.documentElement.lang == "es") {
                window.open("http://" + window.location.host + "/user/login?action=new-article");
            } else {
                window.open("http://" + window.location.host + "/po/user/login?action=new-article");
            }
        });

        // send manuscrito
        $(".send-article.new-article.authentificate").click(function() {
            if (document.documentElement.lang == "en") {
                window.open("http://" + window.location.host + "/new/type/manuscrito");
            } else if (document.documentElement.lang == "es") {
                window.open("http://" + window.location.host + "/new/type/manuscrito");
            } else {
                window.open("http://" + window.location.host + "/new/type/manuscrito");
            }
        });


        // landing de tipos de articulos
        $("#info-article .list-type .option ul li#article").click(function() {
            $(this).addClass("active");
            $("#info-article .list-type .option ul li#magazine").removeClass("active");
            $("#info-article .list-type .box-type .magazine").removeClass("active");
            $("#info-article .list-type .box-type .article").addClass("active");
        });


        $("#info-article .list-type .option ul li#magazine").click(function() {
            $(this).addClass("active");
            $("#info-article .list-type .option ul li#article").removeClass("active");
            $("#info-article .list-type .box-type .article").removeClass("active");
            $("#info-article .list-type .box-type .magazine").addClass("active");
        });

        // load guias

        $("#info-article .list-type .box-type ul li.target").click(function() {
            var idNode = $(this).attr("data-node");
            var guia = "http://" + window.location.host + "/guia/" + idNode;
            var typeD = $(this).attr("data-type");

            $.getJSON(guia).done(function(data, textStatus, jqXHR) {
                $("main#info-article .live-box .data h2").html(data.title);
                $("main#info-article .live-box .data .info p.guia").html(data.body);
                $("#info-article aside.live-box .box a.link").attr("href", "/new/" + typeD + "/send");
                $("#info-article aside.live-box").addClass("active");
            }).fail(function(jqXHR, textStatus, errorThrown) {
                alert("Algo ha fallado: por favor recargue la página e intente nuevamente");
            });
        });

        $("#info-article aside.live-box .box .close").click(function() {
            $("#info-article aside.live-box").removeClass("active");
        });

        $("#shared").click(function() {
            $(".more-shared").toggleClass("active");
            $(".more-read").toggleClass("active");
        });

        // last news
        $(".last_news .views-element-container >div").owlCarousel({
            nav: true,
            loop: false,
            navRewind: false,
            center: true,
            items: 1,
            stagePadding: 50,
            responsive: {
                768: {
                    items: 3,
                    stagePadding: 0
                },
                1180: {
                    items: 4,
                    center: false,
                    stagePadding: 0
                }
            }
        });

        $(".view_news.more-read .views-element-container >div").owlCarousel({
            nav: true,
            loop: false,
            navRewind: false,
            center: true,
            items: 1,
            stagePadding: 45,
            responsive: {
                768: {
                    items: 3,
                    stagePadding: 0
                },
                1180: {
                    items: 4,
                    center: false,
                    stagePadding: 0
                }
            }
        });

        $(".view_news.more-shared .views-element-container >div").owlCarousel({
            nav: true,
            loop: false,
            navRewind: false,
            center: true,
            items: 1,
            stagePadding: 45,
            responsive: {
                768: {
                    items: 3,
                    stagePadding: 0
                },
                1180: {
                    items: 4,
                    center: false,
                    stagePadding: 0
                }
            }
        });

        // perfil usuario
        $(".user-form .container .profile form .form-actions #edit-submit--5").click(function(event) {
            var error = false;
            error_tratamiento = false;
            if ($("#edit-mail--3").val() == "") {
                $("#edit-mail--3").css({ "border": "solid red" });
                error = true;
            }

            if ($("#edit-name--4").val() == "") {
                $("#edit-name--4").css({ "border": "solid red" });
                error = true;
            }

            if ($("#edit-field-nombre-0-value--2").val() == "") {
                $("#edit-field-nombre-0-value--2").css({ "border": "solid red" });
                error = true;
            }

            if ($("#edit-field-apellidos-0-value--2").val() == "") {
                $("#edit-field-apellidos-0-value--2").css({ "border": "solid red" });
                error = true;
            }

            if ($("#edit-field-como-prefiero-ser-llamado--2").val().trim() === '_none') { // select
                $("#edit-field-como-prefiero-ser-llamado--2").css({ "border": "solid red" });
                error = true;
            }

            if ($("#edit-field-perfil-usuario-0-value--2").val() == "") {
                $("#edit-field-perfil-usuario-0-value--2").css({ "border": "solid red" });
                error = true;
            }

            if ($("#edit-field-registrarse-como--2").val().trim() === '_none') { // select
                $("#edit-field-registrarse-como--2").css({ "border": "solid red" });
                error = true;
            }

            if (!$("#edit-field-tratamiento-datos-value--2").is(":checked")) {
                $("#edit-field-tratamiento-datos-value--2").css({ "border": "solid red" });
                error = true;
            }

            if (error) {
                event.preventDefault();
                alert("Hay campos sin completar, por favor diligencie los campos con borde de color rojo y acepte las políticas de tratamiento de datos");
            }

        });

        // last news
        $("#main.user-profile .container .node_saved .views-element-container >div").owlCarousel({
            nav: true,
            loop: false,
            navRewind: false,
            center: true,
            items: 1,
            stagePadding: 50,
            responsive: {
                768: {
                    items: 3,
                    stagePadding: 0
                },
                1180: {
                    items: 4,
                    center: false,
                    stagePadding: 0
                }
            }
        });

        // <!------------------------------- node artículo cientifico ------------------------------>// 
        $(".btn-show-text").click(function() {
            var iDatrr = $(this).attr("data-id");
            $(this).toggleClass("active");
            $("div." + iDatrr + " div.box").toggleClass("active");
        });

        $(".content.article fn").click(function() {
            var paragraph_id = $(this).attr("value");
            var reference = $("#paragraph-" + paragraph_id + ".ref.paragraph").html();
            $(".popup.node-article-cientifico").toggleClass("active");
            $(".popup.node-article-cientifico .box").html(reference);
        });

        $("button#close-reference").click(function() {
            $(".popup.node-article-cientifico").toggleClass("active");
            $(".popup.node-article-cientifico .box").html("");
        });

        // registro usuario
        $("#main.user-form.user-register .container .user .profile #edit-submit--5").attr("disabled", true);

        // Preview node manuscritos
        var link_pr = $("form#node-preview-form-select a#edit-backlink").attr("href");
        if(link_pr != undefined){
            var preview_link = link_pr.split('?')[0].split('/')[3].replace('manuscrito_', '');
            var preview_uuid = link_pr.split('?')[1];
            $("form#node-preview-form-select a#edit-backlink").attr("href", "/new/" + preview_link + "/send?" + preview_uuid);
        }
        
       
        $("#cke_wordcount_edit-field-resumen-abstract-0-subform-field-resumen-espanol-0-value").change(function(){
            var cant = parseInt($( this ).text().split(",")[1].replace("Palabras: ",""));
            if(cant > limitResume){
                alert('El limite de '+ limit +' palabras fue excedido, por favor verifique su artículo.');
            }
        });
        $("#cke_wordcount_edit-field-resumen-abstract-0-subform-field-resumen-ingles-0-value").change(function(){
            var cant = parseInt($( this ).text().split(",")[1].replace("Palabras: ",""));
            if(cant > limitResume){
                alert('El limite de '+ limit +' palabras fue excedido, por favor verifique su artículo.');
            }
        });
        $("#cke_wordcount_edit-field-resumen-abstract-0-subform-field-resumen-portugues-0-value").change(function(){
            var cant = parseInt($( this ).text().split(",")[1].replace("Palabras: ",""));
            if(cant > limitResume){
                alert('El limite de '+ limitResume +' palabras fue excedido, por favor verifique su artículo.');
            }
        });

        $("#edit-submit").click(function(e) {
            checkWord(e);
        });

        $("#edit-preview").click(function(e) {
            checkWord(e);
        });

        // Buscador
        $("#info-article .list-type .option ul li#name").click(function() {
            $(this).addClass("active");
            $("#info-article .list-type .option ul li#tipo").removeClass("active");
            $("#info-article .list-type .option ul li#autor").removeClass("active");
            $("#info-article .list-type .box-type .article.autor").removeClass("active");
            $("#info-article .list-type .box-type .article.name").addClass("active");
            $("#info-article .list-type .box-type .article.tipo").removeClass("active");
        });
        $("#info-article .list-type .option ul li#autor").click(function() {
            $(this).addClass("active");
            $("#info-article .list-type .option ul li#tipo").removeClass("active");
            $("#info-article .list-type .option ul li#name").removeClass("active");
            $("#info-article .list-type .box-type .article.autor").addClass("active");
            $("#info-article .list-type .box-type .article.name").removeClass("active");
            $("#info-article .list-type .box-type .article.tipo").removeClass("active");
        });
        $("#info-article .list-type .option ul li#tipo").click(function() {
            $(this).addClass("active");
            $("#info-article .list-type .option ul li#name").removeClass("active");
            $("#info-article .list-type .option ul li#autor").removeClass("active");
            $("#info-article .list-type .box-type .article.autor").removeClass("active");
            $("#info-article .list-type .box-type .article.name").removeClass("active");
            $("#info-article .list-type .box-type .article.tipo").addClass("active");
        });
        if(window.location.pathname == "/search/content/by/type"){
            var parametro = window.location.search;
            parametro = parametro.split('=');
            parametro = parametro[0].replace('?','');
            $("#info-article .list-type .option ul li#"+parametro).trigger( "click" );
        }

    });
})(jQuery);

function check_user(element) {
    var auth = $(element).attr("data-session");
    if (auth != "authentificate") {
        if (document.documentElement.lang == "en") {
            window.open("http://" + window.location.host + "/en/user/login");
        } else if (document.documentElement.lang == "es") {
            window.open("http://" + window.location.host + "/user/login");
        } else {
            window.open("http://" + window.location.host + "/po/user/login");
        }
    } else {
        $(element).toggleClass("saved");
        $.get("http://" + window.location.host + "/node/" + $(element).attr("data-id") + "/add-to-entity-wishlist");
    }
}

/** validaciones para limite de campos */



function checkWord(e){

    var ctnWord = 0;
    $( "span.cke_path_item" ).each(function( i ) {
        ctnWord +=  parseInt($( this ).text().split(",")[1].replace("Palabras: ",""));
    });

    
    var referencia = parseInt($("#cke_wordcount_edit-field-referencia-0-value").text().split(",")[1].replace("Palabras: ",""));
    var resume_espanol = parseInt($("#cke_wordcount_edit-field-resumen-abstract-0-subform-field-resumen-espanol-0-value").text().split(",")[1].replace("Palabras: ",""));
    var resume_ingles = parseInt($("#cke_wordcount_edit-field-resumen-abstract-0-subform-field-resumen-ingles-0-value").text().split(",")[1].replace("Palabras: ",""));
    var resume_portugues = parseInt($("#cke_wordcount_edit-field-resumen-abstract-0-subform-field-resumen-portugues-0-value").text().split(",")[1].replace("Palabras: ",""));
    var agradecimientos = parseInt($("#cke_wordcount_edit-field-agradecimientos-0-value").text().split(",")[1].replace("Palabras: ",""));
    
    var rest = resume_espanol + referencia + resume_ingles + resume_portugues + agradecimientos;

    var type = location.pathname.split("/")[2];
    var limit = 0;
    switch(type) {
        case 'editorial':
           limit = 1500;
          break;
        case 'articulo_original':
            limit = 3000;
          break;
        case 'articulo_revision':
            limit = 5000;
        break;
        case 'mini_revision':
            limit = 3000;
        break;
        case 'rondas_clinicas':
            limit = 1500;
        break;
        case 'comentarios_respues':
            limit = 800;
        break;
        case 'articulo_especial':
            limit = 2500;
        break;
      }
      ctnWord = ctnWord - rest;
    if (ctnWord > limit) {
        alert('El limite de '+ limit +' palabras fue excedido, por favor verifique su artículo.');
        e.preventDefault();
    }
}


