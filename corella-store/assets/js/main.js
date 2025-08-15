(function(){
	function qs(sel, ctx){ return (ctx||document).querySelector(sel); }
	function qsa(sel, ctx){ return Array.prototype.slice.call((ctx||document).querySelectorAll(sel)); }

	var toggle = qs('.nav__toggle');
	var nav = qs('#primary-nav');
	if (toggle && nav) {
		toggle.addEventListener('click', function(){
			var open = nav.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		});
	}

	// Lazy class reveal
	qsa('.fade-in-up').forEach(function(el){
		var obs = new IntersectionObserver(function(entries){
			entries.forEach(function(e){ if (e.isIntersecting) { el.style.animationPlayState = 'running'; obs.unobserve(el); } });
		},{ threshold: 0.2 });
		obs.observe(el);
	});
})();