$(window).on('load', function () {
	// ajax ajax detection
	let oldXHR = window.XMLHttpRequest;
	function newXHR() {
		let realXHR = new oldXHR();
		realXHR.addEventListener("readystatechange", function () {
			if (realXHR.readyState === 4 && realXHR.status === 200) {
				setTimeout(
					function () {
						document.dispatchEvent(
							new CustomEvent("NittroAjaxRequestReadyStateChange")
						);
					}, 1
				);
			}
		}, false);
		return realXHR;
	}
	window.XMLHttpRequest = newXHR;

	// on ajax start
	document.addEventListener("NittroAjaxRequestCreated", function () {
		$('#loader-wrapper').fadeIn();
	});

	// on ajax finish
	document.addEventListener("NittroAjaxRequestReadyStateChange", function () {
		$('#loader-wrapper').fadeOut();
	});
});