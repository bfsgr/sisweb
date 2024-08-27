function handleTypeChange(e) {
    const keyField = $("#key")
    const selected = e.target.value

    switch (selected) {
        case "email":
            keyField.unmask()
            break
        case "phone":
            keyField.unmask()
            keyField.mask("(00) 00000-0000", {
                onChange(value, e, $element, options) {
                    const masks = ["(00) 0000-00000", "(00) 00000-0000"]
                    const mask = (value.length === 15) ? masks[1] : masks[0]
                    $("#key").mask(mask, options)
                }
            })
            break
        case "cpf":
            keyField.unmask()
            keyField.mask("000.000.000-00")
            break
        default:
            keyField.unmask()
            break
    }
}

$(() => {
    const form = document.getElementById("pix-form")
    const typeField = document.getElementById("type")

    handleTypeChange({ target: typeField })

    typeField.addEventListener("change", handleTypeChange)
    
    form.addEventListener("submit", (e) => {
        $("#key").unmask()
    })

    form.addEventListener("reset", () => {
        requestAnimationFrame(() => {
            handleTypeChange({ target: typeField })
        })
    })
})
