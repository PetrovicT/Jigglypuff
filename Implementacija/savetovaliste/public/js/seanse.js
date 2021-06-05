function prijaviSeansu(idSeanse) {
    $.post("prijavi_seansu",
            {
                id: idSeanse
            },
            function (data, status) {
                alert("Data: " + data + "\nStatus: " + status);
            });
}

