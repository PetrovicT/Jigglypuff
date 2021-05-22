function inputIntoPromotionField(clickedRow){
	var username = clickedRow.cells[0].innerHTML;
	document.getElementById("usernameForPromotion").value=username;
}