import "./bootstrap";

$(() => {
	const forms = $("form");

	forms.on("reset", () => {
		requestAnimationFrame(() => {
			$("input[data-mask]").each((i, el) => {
				el.dispatchEvent(new Event("input"));
			});
		});
	});

	forms.on("submit", () => {
		$("input[data-mask]").each((i, el) => {
			$(el).unmask();
		});
	});
});
