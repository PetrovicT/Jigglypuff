function like_or_dislike_pitanje(buttonElement, idPitanja, isLike) {    
    buttonElement.disabled = true;
    buttonElement.removeAttribute("onclick");
    buttonElement.innerHTML = "Obrađujem...";

    $.post("like_or_dislike_pitanje",
            {
                id: idPitanja,
                isLike: isLike
            },
            function (data, status, xhr) {
                buttonElement.parentElement.innerHTML = "Hvala što ste ocenili pitanje!";
            });
}
