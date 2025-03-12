document.addEventListener('DOMContentLoaded', (event) => {
  if (!customElements.get('popup-block')) {
    class Popup extends HTMLElement {
      constructor() {
        super();
        this.closeButton = this.querySelector('[data-close-button]');
        this.showButton = this.querySelector('[data-show-button]');
        this.popupContentButton = this.querySelector('[data-block-popup-button]');
        this.showPopup = this.dataset.blockPopup;
        this.showVideoPopup = this.dataset.blockPopupVideo;
        this.waitTime = Number(this.dataset.waitTime);
      }
  
      connectedCallback() {
        this.fechaDeAccessoLabel = `popup-${this.id}-fecha-de-acceso`;
        this.fechaDeAccessoSessionLabel = `popup-${this.id}-fecha-de-acceso-session`;
        this.usuarioHaHechoClick = `popup-${this.id}-user-clicked`;
  
        this.showPopup = this.dataset.blockPopup;
        this.showVideoPopup = this.dataset.blockPopupVideo;
        this.waitTime = Number(this.dataset.waitTime);
  
        this.fechaDeAcceso = JSON.parse(localStorage.getItem(this.fechaDeAccessoLabel));
        this.fechaDeAccesoSesion = JSON.parse(sessionStorage.getItem(this.fechaDeAccessoSessionLabel));
        this.usuarioHaHechoClic = JSON.parse(localStorage.getItem(this.usuarioHaHechoClick)) || false;
  
        this.addEventListeners();
      }
  
      formatearFecha(date) {
        if (!date) {
          return null;
        }
        const fecha = new Date(date);
        const año = fecha.getFullYear();
        let mes = fecha.getMonth() + 1;
        let dia = fecha.getDate();
      
        if (mes < 10) mes = '0' + mes;
        if (dia < 10) dia = '0' + dia;
      
        const fechaFormateada = año + '/' + mes + '/' + dia;
        return fechaFormateada;
      }
  
      mostrarPopup() {
        this.classList.remove('hidden');
        const fechaActual = new Date();
        localStorage.setItem(this.fechaDeAccessoLabel, JSON.stringify(fechaActual));
        sessionStorage.setItem(this.fechaDeAccessoSessionLabel, JSON.stringify(fechaActual));
      }
  
      addEventListeners() {
        this.addEventListener('click', () => {
          this.classList.add('hidden');
        });
  
        if (this.popupContentButton) {
          this.popupContentButton.addEventListener('click', () => {
            this.usuarioHaHechoClic = true;
            localStorage.setItem(this.usuarioHaHechoClick, JSON.stringify(this.usuarioHaHechoClic));
          });
        }
  
        this.addEventListener('click', (event) => {
          if (!event.target.closest('.contenedor_popup')) {
            this.classList.add('hidden');
          }
        });
  
        if (this.showPopup == 'show_with_timer') {
          const fechaActual = new Date().toISOString().split('T')[0];
          const fechaDeAcceso = new Date(this.fechaDeAcceso).toISOString().split('T')[0];
          const fechaDeAccesoSesion = new Date(this.fechaDeAcceso).toISOString().split('T')[0];
          
          if (this.showVideoPopup == 'diary' && fechaDeAcceso === fechaActual) {
            this.classList.add('hidden');
          } else if (this.showVideoPopup == 'per_login' && fechaDeAccesoSesion === fechaActual) {
            this.classList.add('hidden');
          } else if (this.showVideoPopup == 'click_the_button' && this.usuarioHaHechoClic) {
            this.classList.add('hidden');
          } else {
            setTimeout(() => {
              this.mostrarPopup();
            }, this.waitTime);
          }
        } else if (this.showPopup == 'show_with_click') {
          this.showButton?.addEventListener('click', () => {
            this.classList.remove('hidden');
            localStorage.setItem(this.usuarioHaHechoClick, JSON.stringify(true));
          });
        }
      }
    }
  
    customElements.define('popup-block', Popup);
  }  
});