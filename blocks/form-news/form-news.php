<?php
$title = get_field('title');
$form_update = get_field('form_update');
$principal_image = get_field('principal_image');
$background_image = get_field('background_image');
?>

<div class="form-news-wrapper ">
 <section class="form-news-section flex flex-col  justify-center py-4" style="background-image: url('<?php echo $background_image; ?>');">
  <!--  Agregar el titulo de la sección  -->
  <div class="flex flex-row justify-around">
   <div class="flex flex-col gap-4 w-1/3">
    <p class="text-xl  text-center font-bold mb-6 text-black"><?= $title; ?></p>
 
    <div class="bg-[#5A3D82] flex flex-col gap-4 p-4 rounded-2xl">
     <input class="bg-[#BEB3CCAB] placeholder:text-black p-2 rounded" type="text" placeholder="Nombre y apellido">
     <input class="bg-[#BEB3CCAB] placeholder:text-black p-2 rounded" type="text" placeholder="Email">
    </div>
    <div>
     <button class="bg-white text-[#5A3D82] p-4">Enviar</button>
    </div>
   </div>
   <div  class="w-1/2">
    <img src="<?= $principal_image; ?>" alt="">
   </div>

  </div>

 </section>
</div>