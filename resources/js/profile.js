$(() => {
	const cepInput = document.getElementById("cep");

	let abortController = new AbortController();

	cepInput.addEventListener("input", async (e) => {
		const value = e.target.value;

		const sanitizedValue = value?.replace(/\D/g, "") ?? "";

		const streetField = document.getElementById("address");
		const neighborhoodField = document.getElementById("neighborhood");
		const cityField = document.getElementById("city");
		const stateField = document.getElementById("state");
		const helper = document.getElementById("cepHelper");

		if (sanitizedValue.length === 8) {
			if (abortController) {
				abortController.abort();
			}

			abortController = new AbortController();

			try {
				e.target.readOnly = true;

				const response = await fetch(
					`https://brasilapi.com.br/api/cep/v1/${sanitizedValue}`,
					{
						signal: abortController.signal,
					},
				);

				if (!response.ok) {
					helper.innerText = "CEP não encontrado";
					return;
				}

				const data = await response.json();

				helper.innerText =
					"Digite o CEP para buscar o endereço automaticamente";

				streetField.value = data.street;
				neighborhoodField.value = data.neighborhood;
				cityField.value = data.city;
				stateField.value = data.state;
			} catch (e) {
				if (e.name === "AbortError") {
					return;
				}
				console.error(e);
			} finally {
				e.target.readOnly = false;
			}
		} else {
			streetField.value = "";
			neighborhoodField.value = "";
			cityField.value = "";
			stateField.value = "";
			helper.innerText = "Digite o CEP para buscar o endereço automaticamente";
		}
	});
});
