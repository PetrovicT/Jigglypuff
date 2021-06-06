function like_or_dislike_psiholog(buttonElement, idPsihologa, isLike) {
    buttonElement.innerHTML = "Obrađujem...";
    buttonElement.disabled = true;
    buttonElement.removeAttribute("onclick");

    $.post("../like_or_dislike_psiholog",
            {
                id: idPsihologa,
                isLike: isLike
            },
            function (data, status, xhr) {
                buttonElement.parentElement.innerHTML = "Hvala što ste ocenili psihologa!";
            });
}