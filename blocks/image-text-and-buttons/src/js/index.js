/*
let animationContainer = document.querySelector('.animation-container');

// Clonar y reposicionar elementos al final de la animación
function handleAnimationIteration(event) {
  let animationClass = event.animationName;
  let targetMov = document.querySelector('.' + animationClass + ' .target_mov');
  let clone = targetMov.cloneNode(true);
  animationContainer.querySelector('.' + animationClass).appendChild(clone);
  targetMov.remove();
}

// Detectar el final de las animaciones
document.addEventListener('animationiteration', handleAnimationIteration);

*/