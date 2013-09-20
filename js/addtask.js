$(function() {
	var totalCriterias=1;

	function addCriteria() {
		var newcriteria = $("#pattern").clone().appendTo("#criterias");

		newcriteria.find("#critname").attr("name","critname-"+totalCriterias);
		newcriteria.find("#critpoints").attr("name","critpoints-"+totalCriterias);

		newcriteria.attr("id","criteria-"+totalCriterias);

		totalCriterias++;

		newcriteria.show();
	}
	$("#addcrit").click(function() {
		addCriteria();
		return false;
	});
});
