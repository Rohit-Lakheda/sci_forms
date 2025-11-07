function go_back() {
	
	var assoc_nameurl2 = '';
	
	if(a != '') {
		a = '&a=' + a;		
	}
	
	if(assoc_name != '') {
		assoc_nameurl2 = '&assoc_name=' + assoc_name;
	}
	window.location=('registration.php?ret=retds4fu324rn_ed24d3it&en=' + en + a + assoc_nameurl2);
}


function go_back1() {//alert('registration_comp3.php?ret=retds4fu324rn_ed24d3it&' + cata_type);
	window.location=('registration_comp3.php?ret=retds4fu324rn_ed24d3it&' + cata_type);
}
