<!-- Listado de materiales de pacientes -->

<?php
$materials = get_field('materials');

if (!$materials) {
 return; // No hay materiales, no hacemos nada
}

foreach ($materials as $material) {
 $material_title = $material['title'];
?>
 <h2 class="text-2xl font-bold text-center my-10"><?= $material_title; ?></h2>
 <?php
 $cards = $material['cards'];
 ?>
 <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto px-4 py-8">
  <?php
  if (empty($cards)) {
   continue; // No hay tarjetas, saltamos a la siguiente
  }
  foreach ($cards as $card) {
   $material_image = $card['image'];
   $material_description = $card['description'];
  ?>
   <a href="#" class="bg-blue-100 rounded-lg shadow hover:shadow-md transition p-4 flex flex-col items-center text-center">
    <img src="<?php echo $material_image; ?>" alt="Cartas al ratón Pérez" class="h-24 mb-4 object-contain">
    <p class="font-semibold"><?php echo $material_description; ?></p>
   </a>
  <?php
  }
  ?>
 </div>
<?php
}
?>
