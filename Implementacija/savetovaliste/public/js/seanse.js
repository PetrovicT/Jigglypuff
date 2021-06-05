function prijaviSeansu(buttonElement, idSeanse) {
    buttonElement.disabled = true;
    buttonElement.innerHTML = "Obrađujem...";

    $.post("prijavi_odjavi_seansu",
            {
                id: idSeanse
            },
            function (data, status) {
                buttonElement.style = "width: auto;";
                buttonElement.innerHTML = data.ispis;
                buttonElement.removeAttribute("onclick");
            });
}

