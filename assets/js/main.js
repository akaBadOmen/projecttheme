import './menu.js';

class General {
	constructor() {
		this.testVariable = 'script working';
		this.init();
	}

	init() {
		// for tests purposes only
		console.log(this.testVariable);
	}
}

document.addEventListener('DOMContentLoaded', () => {
	new General();
});


/* FAQ: "Weitere Fragen" blendet die versteckten Fragen ein */
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.tg-faq__more').forEach((button) => {
    button.addEventListener('click', () => {
      const list = document.getElementById(button.getAttribute('aria-controls'));
      if (!list) return;
      const hidden = list.querySelectorAll('[data-faq-more]');
      hidden.forEach((item) => { item.hidden = false; });
      button.setAttribute('aria-expanded', 'true');
      button.hidden = true;
      if (hidden[0]) hidden[0].querySelector('summary').focus();
    });
  });
});
