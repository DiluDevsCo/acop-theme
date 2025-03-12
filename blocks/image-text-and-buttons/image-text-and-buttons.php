<?php
$margin_t = get_field('margin_t') . 'px';
$margin_b = get_field('margin_b') . 'px';

$title_component = get_field("title_component");
$title_color = get_field("title_color");
$image = get_field('image');
$image_movil = get_field('image_movil');
$order_image_movil = get_field('order_image_movil');
$full_width = get_field("full_width");

$image_align = get_field('image_align');
$image_responsive = get_field('image_responsive');
$gradient = get_field('gradient');
$add_bg = get_field('add_bg');

$validate_image_background = get_field("validate_image_background");
$background_image = get_field("background_image");
$activate_gradient = get_field("activate_gradient");

if ($add_bg) {
    // Si 'add_bg' es true
    $bg_color = get_field('bg_color');
} else {
    // Si 'add_bg' es falso
    $bg_color = 'transparent';
}

$bg_color_movil = get_field('bg_color_movil');
$text_align = get_field('text_align');

$buttons = get_field('buttons');
$divide_buttons = get_field("divide_buttons");
$buttons_align = get_field('buttons_align');
$botton_function = get_field('botton_function');
$url_video = get_field('url_video');
$url_video_popup = get_field('url_video_popup');

$label_button = get_field('label_button');

$add_video = get_field("add_video");

$margin_top = get_field('margin-top_spacing') ?: 'xl';
$margin_bottom = get_field('margin-bottom_spacing') ?: 'xl';

$margin_classes = almus_get_block_margin_classes($margin_top, $margin_bottom);


if ($gradient) {
    $div_image_gradient = 'filter: drop-shadow(5px 5px 5rem rgba(1, 77, 129, 0.7))';
} else {
    $div_image_gradient = 'filter: none;';
}

$div_image_class = "";
$div_text_class = "";
$image_class = "";
$div_button_class = "";
$align_text = "";

if ($image_align == 'align_right') {
    $div_image_class = 'lg:order-2 flex justify-end';
    $div_text_class = ' lg:order-1 flex flex-row';
    $img_class = '';
} elseif ($image_align == 'align_left') {
    $div_image_class = ' lg:order-1 flex justify-start';
    $div_text_class = '  lg:order-2 flex flex-row';
    $img_class = '';
} elseif ($image_align == 'align_center') {
    $div_text_class = ' absolute inset-0';
}


if ($text_align == 'align_left') {
    $align_text = ' items-start text-left';
} elseif ($text_align == 'align_right') {
    $align_text = ' items-end text-right';
} elseif ($text_align == 'align_center') {
    $align_text = ' items-center text-center';
}

// Alineación del botón
if ($buttons_align == 'align_center') {
    $div_button_class = ' justify-center';
} elseif ($buttons_align == 'align_right') {
    $div_button_class = ' justify-end';
} elseif ($buttons_align == 'align_left') {
    $div_button_class = ' justify-start';
}

// Agregar clases que definen el ancho de la imagen y el texto
$image_width = get_field('image_width');

if ($image_width == '1/2') {
    $div_image_class .= ' lg:w-1/2';
    $div_text_class .= ' lg:w-1/2';
} elseif ($image_width == '20') {
    $div_image_class .= ' lg:w-[20%]';
    $div_text_class .= ' lg:w-1/2';
} elseif ($image_width == '1/3') {
    $div_image_class .= ' lg:w-1/3';
    $div_text_class .= ' lg:w-1/2';
} elseif ($image_width == '1/4') {
    $div_image_class .= ' lg:w-1/3';
    $div_text_class .= ' lg:w-1/2';
} elseif ($image_width == '7/12') {
    $div_image_class .= ' lg:w-7/12';
    $div_text_class .= ' lg:w-5/12';
} elseif ($image_width == 'w-full') {
    $div_text_class = ' absolute inset-0';
    $div_image_class = ' w-full';
}

// Agregar clases que separan el texto de los bordes
$text_padding_left = get_field('text_padding_left');
$text_padding_right = get_field('text_padding_right');

if ($text_padding_left == '1/12') {
    $div_text_class .= ' sm:ml-[8.333333%]';
} elseif ($text_padding_left == '2/12') {
    $div_text_class .= ' sm:ml-[16.666667%]';
} elseif ($text_padding_left == '3/12') {
    $div_text_class .= ' sm:ml-[25%]';
}

if ($text_padding_right == '1/12') {
    $div_text_class .= ' sm:mr-[8.333333%]';
} elseif ($text_padding_right == '2/12') {
    $div_text_class .= ' sm:mr-[16.666667%]';
} elseif ($text_padding_right == '3/12') {
    $div_text_class .= ' sm:mr-[25%]';
}

// Posicion del titulo
$title_position = get_field('title_position');
$title_align_class = '';
$position_title = "";

if ($title_position == 'arriba') {
    $first_title_view_class = '';
    $second_title_view_class = 'hidden';
} elseif ($title_position == 'abajo') {
    $first_title_view_class = '';
    $position_title = ' flex flex-col-reverse';
    $second_title_view_class = 'hidden';
} else {
    $first_title_view_class = 'block lg:hidden text-center';
    $second_title_view_class = 'hidden lg:block';
}

// Color del titulo
$title_color = $title_color != "" ? $title_color : '#FFF';

// Opciones imagen en móvil
if ($image_responsive == 'no_image_movil') {
    $image_class = ' hidden sm:block';
} elseif ($image_responsive == 'same_image_movil' || $image_responsive == 'other_image_movil') {
    if ($order_image_movil == 'top') {
        $div_image_class .= ' order-1';
        $div_text_class .= ' order-2';
    } elseif ($order_image_movil == 'bottom') {
        $div_image_class .= ' order-2';
        $div_text_class .= ' order-1';
    }
}
if ($image_responsive == 'same_image_movil') {
    $image_movil = $image;
}

$texts = get_field('texts');

// Generar un identificador único basado en uniqid()
$unique_id = uniqid();
?>

<section data-image-text-and-buttons-id="<?php echo $unique_id; ?>" class="block-image-text-and-buttons <?php echo $margin_classes;
                                                                                                        echo $position_title;
                                                                                                        echo $add_video ? " md:mb-[230px]" : "";
                                                                                                        echo $full_width ? " full-width" : ""; ?>">
    <?php
    if ($title_component != "") { ?>
        <div class="w-full grid place-items-center pb-7 <?php echo $first_title_view_class ?>">
            <h2 class="text-[40px] font-bold" style="color: <?php echo $title_color; ?>;"><?php echo $title_component; ?></h2>
        </div>
    <?php  } ?>
    <div class="w-full overflow-visible border-box relative my-5 sm:my-auto ">
        <?php
        if ($add_video) { ?>
            <div class="place-items-center absolute w-full -bottom-48 z-10 hidden md:grid pointer-events-none">
                <div class="w-[600px] h-[360px] bg-black">
                    <iframe class="w-full h-full" src="<?php echo $url_video; ?>" frameborder="0"></iframe>
                </div>
            </div>
        <?php }
        if ($validate_image_background) {
            $background_image = "background: url('" . $background_image . "'); background-repeat: no-repeat; background-size: cover;";
        } else {
            $bg_color = "background-color:" . $bg_color . ";";
        }


        ?>

        <!-- Imagen y Texto/Botón en la misma línea -->
        <div class="flex flex-col relative lg:flex-row items-center justify-center <?php echo $add_video ? "flex-col-reverse md:flex-row" : ""; ?>" style="<?php echo $validate_image_background ? $background_image : $bg_color; ?>">
            <?php if ($activate_gradient) { ?> <div class="z-0 absolute inset-0 w-full h-full activate_gradient" style="--bg-gradient: <?php echo $bg_color; ?>"></div> <?php } ?>

            <!-- Imagen  -->
            <div class="z-10 overflow-visible <?php echo $div_image_class ?>">
                <img class="hidden sm:block object-cover w-full <?php echo $image_class ?>" style="<?php echo $div_image_gradient ?>" src="<?php echo $image ?>" alt="">
                <img class="block sm:hidden object-cover h-full md:max-h-[35rem] xl:max-h-auto <?php echo $image_class ?>" style="<?php echo $div_image_gradient ?>" src="<?php echo $image_movil ?>" alt="">
            </div>
            <?php
            if ($add_video) { ?>
                <div class="block place-items-center w-full md:hidden">
                    <div class="w-full h-auto bg-black">
                        <iframe src="<?php echo $url_video; ?>" frameborder="0"></iframe>
                    </div>
                </div>
            <?php } ?>
            <!-- Texto y botón  -->
            <div class="z-10 lg:w-1/2 flex flex-col items-center justify-center <?php echo $div_text_class  ?>">
                <!-- Título -->
                <?php if ($title_component != "") { ?>
                    <div class="w-full overflow-visible <?php echo $second_title_view_class ?>">
                        <h2 class="text-[50px] font-bold mb-6" style="color: <?php echo $title_color; ?>;">
                            <?php echo $title_component; ?>
                        </h2>
                    </div>
                <?php } ?>
                <!-- Textos -->
                <div class="flex flex-col w-full overflow-visible gap-1 p-2 md:gap-2 md:p-0 <?php echo $align_text; ?> ">
                    <?php
                    if (!empty($texts)) {
                        foreach ($texts as $text) :
                            // Estilos al texto
                            // Tamaño y separación entre líneas de texto
                            $text_class = '';
                            if ($text['text_size'] == 'large') {
                                $text_class .= ' text-3xl sm:text-6xl leading-tight md:leading[' . $text['line_height'] . ']';
                            } elseif ($text['text_size'] == 'medium') {
                                $text_class .= 'text-lg sm:text-3xl leading-relaxed md:leading[' . $text['line_height'] . ']';
                            } elseif ($text['text_size'] == 'small') {
                                $text_class .= 'sm:text-base leading-relaxed md:leading[' . $text['line_height'] . ']';
                            } elseif ($text['text_size'] == 'other') {
                                $text_class .= 'leading-relaxed md:leading[' . $text['line_height'] . ']';
                            }
                            // Negrita en el texto
                            if ($text['font_weight'] == 'medium') {
                                $text_class .= ' font-medium';
                            } elseif ($text['font_weight'] == 'bold') {
                                $text_class .= ' font-bold';
                            } elseif ($text['font_weight'] == 'black') {
                                $text_class .= ' font-extrabold';
                            }
                            // Cursiva en el texto
                            if ($text['italic']) {
                                $text_class .= ' italic';
                            } else {
                                $text_class .= ' no-italic';
                            }
                    ?>
                            <div class="sm:p-0" style="color: <?php echo $text['text_color']; ?>;">
                                <?php if (!empty($text['highlighting_option'])) ?>
                                <?php
                                // Dividir $text_color en palabras
                                if (!$text["mark_text"]) {
                                    $palabras_color = explode(' ', $text['highlighting_words']);
                                    // Iterar sobre las palabras y envolverlas con la etiqueta HTML con el color especificado
                                    foreach ($palabras_color as $palabra) {
                                        // Utilizar expresiones regulares para hacer coincidir la palabra completa
                                        $text['text'] = preg_replace("/\b" . preg_quote($palabra, "/") . "\b/", '<font color="' . $text['highlighting_color'] . '">' . $palabra . '</font>', $text['text']);
                                    }
                                } else {
                                    $diferencia = str_replace($text['highlighting_words'], '', $text['text']);
                                    $text_marked = '<span style="background: ' . $text['highlighting_color'] . ';">' . $text['highlighting_words'] . '</span>';
                                    $text['text'] = str_replace($text['highlighting_words'], $text_marked, $text['text']);
                                }


                                // Cerrar el bloque PHP antes de concatenar la variable
                                ?>

                                <?php if ($text['active_text_bold']) ?>
                                <?php
                                // Dividir $text_bold en palabras
                                if (!empty($text["text_bold"])) {
                                    $palabras_negrita = explode(' ', $text['text_bold']);
                                    // Iterar sobre las palabras y envolverlas con la etiqueta HTML con el color especificado
                                    foreach ($palabras_negrita as $palabra) {
                                        // Utilizar expresiones regulares para hacer coincidir la palabra completa
                                        $text['text'] = preg_replace("/\b" . preg_quote($palabra, "/") . "\b/", '<strong>' . $palabra . '</strong>', $text['text']);
                                    }
                                } else {
                                    $diferencia = str_replace($text['text_bold'], '', $text['text']);
                                    $text_marked = '<span>' . $text['text_bold'] . '</span>';
                                    $text['text'] = str_replace($text['text_bold'], $text_marked, $text['text']);
                                }


                                // Cerrar el bloque PHP antes de concatenar la variable
                                ?>

                                <?php
                                // Crear la variable $result_text con el formato deseado

                                $result_text = '<p class="' . $text_class . '" style="color: ' . $text['text_color'] . '; ' . ($text['text_size'] == 'other' ? 'font-size:' . $text['size_personalize'] . 'px;' : '') . '">' . $text['text'] . '</p>';


                                if ($text["activate_list"]) { ?>
                                    <div class="flex items-center gap-5">
                                        <div class="h-4 w-4 bg-white rounded-full"></div>
                                        <?php echo $result_text; ?>
                                    </div>
                                <?php } else {
                                    echo $result_text;
                                }

                                if ($text['underline']) {
                                ?>
                                    <div class="w-1/2 h-[3px]" style="background-color: <?php echo $text['text_color']; ?>">
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                    <?php
                        endforeach;
                    } ?>
                </div>
                <!-- Botones -->
                <?php if ($url_video_popup || $botton_function || $buttons) { ?>

                    <div class="grid grid-flow-row md:grid-flow-col gap-4 sm:mt-9 mb-6 w-full <?php echo $div_button_class;
                                                                                                echo $divide_buttons ? " grid-rows-2" : ""; ?>">
                        <?php
                        if ($url_video_popup && $botton_function == 'show_video') { ?>
                            <button id="mostrar_video_popup" class="px-5 text-xl bg-[#C046F2] text-black font-bold hover:text-white hover:bg-[#C580E1] shadow-btn_ver_cursos-600/20 hover:shadow-btn_ver_cursos-600/40 rounded-[50px]"><?php echo $label_button ?></button>
                            <?php
                        } elseif (!empty($buttons)) {
                            foreach ($buttons as $button) :  ?>
                                <div class="flex    items-center">
                                    <?php
                                    fr_render_button(
                                        array(
                                            "label" => $button["label"],
                                            "url" => $button["url"],
                                            "style" => $button["style"],
                                            "size" => $button["size"]
                                        )
                                    ); ?>
                                </div>
                        <?php endforeach;
                        } ?>

                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
    <!-- Popup para mostrar vídeo -->
    <div data-video-popup class="hidden fixed inset-0 overflow-auto z-50 flex justify-center items-center" style="background-color: #001c30;">
        <div class="bg-black contenedor_popup flex items-center justify-center rounded-[20px] relative overflow-hidden border-box max-h-[675px] w-96 max-w-[1200px] h-[460px] lg:min-w-[820px]">
            <!-- <iframe style="width: 100%; height: 100vh;" class="" src="" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe> -->
            <iframe style="width: 100vw; min-height: 467px;" src="https://player.vimeo.com/video/911372404?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allowfullscreen></iframe>

            <!-- Botón para cerrar popup -->
            <button id="cerrarPopup" class="absolute z-50 top-0 right-0 w-[44px] h-[44px] bg-white bg-opacity-10 hover:bg-opacity-30 rounded-bl-[10px] flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 44 44" fill="none" class="hover:scale-125 transition ease-in-out duration-700">
                    <path d="M15.0891 30C14.8115 30 14.5659 29.9252 14.3523 29.7756C14.1388 29.6259 14.0214 29.4295 14 29.1864C14 28.9245 14.1388 28.6533 14.4164 28.3727L20.0218 22.2004V23.3788L14.7687 17.6273C14.4911 17.328 14.3523 17.0568 14.3523 16.8136C14.3737 16.5705 14.4911 16.3741 14.7047 16.2244C14.9182 16.0748 15.1638 16 15.4414 16C15.7617 16 16.0286 16.0561 16.2422 16.1683C16.4771 16.2619 16.6906 16.4208 16.8828 16.6453L21.4632 21.7234H20.5663L25.1788 16.6453C25.371 16.4208 25.5739 16.2619 25.7874 16.1683C26.0009 16.0561 26.2679 16 26.5882 16C26.8871 16 27.1327 16.0748 27.3249 16.2244C27.5384 16.3741 27.6452 16.5798 27.6452 16.8417C27.6665 17.0848 27.5384 17.356 27.2608 17.6553L22.0398 23.3226V22.2846L27.6452 28.3727C27.9014 28.6533 28.0189 28.9245 27.9975 29.1864C27.9975 29.4295 27.8908 29.6259 27.6772 29.7756C27.4637 29.9252 27.2074 30 26.9085 30C26.6095 30 26.3426 29.9439 26.1077 29.8317C25.8942 29.7381 25.6806 29.5792 25.4671 29.3547L20.5343 23.9118H21.4632L16.5304 29.3547C16.3383 29.5605 16.1247 29.7194 15.8898 29.8317C15.6763 29.9439 15.4094 30 15.0891 30Z" fill="black" />
                </svg>
            </button>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mostrar el popup al hacer clic en el botón
        document.getElementById('mostrar_video_popup').addEventListener('click', function() {
            var popup = document.querySelector('[data-video-popup]');
            if (popup) {
                popup.classList.remove('hidden');
            }
        });

        // Cerrar el popup al hacer clic en el botón de cerrar
        document.getElementById('cerrarPopup').addEventListener('click', function() {
            var popup = document.querySelector('[data-video-popup]');
            if (popup) {
                popup.classList.add('hidden');
            }
        });

        // Cerrar al hacer clic fuera del popup
        document.querySelector('[data-video-popup]').addEventListener('click', function(event) {
            if (!event.target.closest('.contenedor_popup')) {
                this.classList.add('hidden');
            }
        });
    });
</script>