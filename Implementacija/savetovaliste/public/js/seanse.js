function prijaviSeansu(idSeanse) {
    $.post("prijavi_odjavi_seansu",
            {
                id: idSeanse
            },
            function (data, status) {
                alert("Ispis: " + data.ispis + "\nStatus: " + status);
            });
}

