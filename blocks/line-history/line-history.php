<?php
$title_component = get_field('title_component');
$line_history = get_field("line_history");
$background_top = get_field("background_top");
?>
<div data-cards-history class="container-body-swiper full-width relative overflow-hidden h-full" style="background-color: <?php echo $background_top; ?>;">
    <div class="full-width text-center relative z-10" style="background-color: <?php echo $background_top; ?>;">
        <h2 class="text-black font-bold"><?php echo $title_component; ?> </h2>
    </div>
    <div class="absolute w-full md:top-0 left-0 h-full">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1920 1080" style="enable-background:new 0 0 1920 1080;" xml:space="preserve">
            <g>
                <defs>
                    <rect id="SVGID_1_" width="100%" height="1080" />
                </defs>
                <clipPath id="SVGID_00000117654403914607327910000002787401375760163730_">
                    <use xlink:href="#SVGID_1_" style="overflow:visible;" />
                </clipPath>
                <ellipse fill="<?php echo $background_top; ?>" style="clip-path:url(#SVGID_00000117654403914607327910000002787401375760163730_);" cx="960" cy="-895" rx="1460" ry="1435" />
            </g>
        </svg>
    </div>
    <div class="container-swiper container-fluid bg-[#001C30] ">
        <div class="swiper-container-wrapper swiper-container-wrapper--timeline">
            <!-- Timeline -->
            <div class="mx-40 hidden md:block">
                <div class="grid place-items-center ">
                    <ul class="swiper-pagination-custom">
                        <?php
                        $class = "";
                        foreach ($line_history as $key =>  $history) {
                            if ($key === 0) { $class = "first"; } 
                            else { $class = ""; }
                            if ($key === count($line_history) - 1) { $class = "last"; }
                        ?>
                            <li class='swiper-pagination-switch <?php echo $class; ?>'>
                                <span class='switch-title'><img class="md:w-12 lg:w-16" src="<?php echo $history["image_history"]; ?>" alt=""></span>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- Progressbar -->
                <div class="grid place-items-center">
                    <div class="swiper-pagination swiper-pagination-progressbar swiper-pagination-horizontal pointer-events-none shadow-lg drop-shadow-lg md:mt-[20px] lg:mt-[31px]"></div>
                </div>
            </div>
            <!-- Swiper -->
            <div class="swiper swiper-container swiper-container--timeline h-[550px]">
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php
                    foreach ($line_history as $key =>  $history) { ?>
                        <div class="swiper-slide flex min-h-[300px] items-center justify-center rounded-xl  bg-transparent">
                            <div class="flex flex-col w-full items-center justify-center">
                                <div class="w-1/2 md:w-1/5 rounded-full border-[20px] border-solid" 
                                style="background: <?php echo $background_top; ?>; border-color: <?php echo $background_top; ?>;
                                ">
                                    <img class="border-8 border-solid border-white rounded-full " src="<?php echo $history["image_history"]; ?>" alt="">
                                </div>
                                <div class="flex flex-col md:flex-row w-full justify-around">
                                    <?php
                                    foreach ($history["texts_history"] as $history_text) { ?>
                                        <div class="flex flex-col items-center justify-center text-center py-5 px-20">
                                            <p class="text-white font-bold text-xs md:text-lg"><?php echo $history_text["year_history"]; ?></p>
                                            <p class="text-white font-normal text-xs md:text-base"><?php echo $history_text["text_history"]; ?></p>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>
</div>