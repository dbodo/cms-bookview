(function($) {
	$(document).ready(function(){
		var select_knjizevnici = $('.s2');
		if(select_knjizevnici)
		{
			select_knjizevnici.select2({
				width: '100%',
      			placeholder: 'Kliknite ovdje za odabir književnika'
			});
		}
		var select_izdavaci = $('.s2');
		if(select_izdavaci)
		{
			select_izdavaci.select2({
				width: '100%',
      			placeholder: 'Kliknite ovdje za odabir izdavača'
			});
		}
	});
})(jQuery);