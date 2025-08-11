<?php
$title = get_field('interest_title');
$data_interests = get_field('array_interest');

?>

<div class="interest-outer-wrapper">
 <section class="interest-section flex flex-col justify-center py-4">
  <!--  Agregar el titulo de la sección  -->
  <h1 class="text-4xl  text-center font-bold mb-6 text-black"><?= $title; ?></h1>
  
   <!--  Agregar varias secciones de interes  -->
   <?php foreach ($data_interests as $interest) { ?>
    <div class="flex flex-col <?= $interest['interest_direction'] ? " md:flex-row-reverse" : " md:flex-row" ?>  gap-8 justify-center items-center ">
     <!--  Agregar la imagen del interes  -->
     <img src="<?= $interest['interest_image']; ?>" alt="">
     <div>
      <!--  Agregar el subtitulo de la sección  -->
      <h2 class="text-4xl md:text-3xl font-[900] text-black"><?= $interest['interest_subtitle']; ?></h2>
      <!--  Agregar la descripcion de la sección  -->
      <p class="text-black text-2xl font-medium"><?= $interest['interest_description']; ?></p>
     </div>
    </div>
   <?php } ?>

 </section>
</div>