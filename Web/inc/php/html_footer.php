<?php

	/**
	* HTML: LÁBLÉC
	*
	* Beleértve a vizuálisan is megjelenő láblécet, ami a <body> tag-en végén 
	* szerepel és magát a <html> dokumentum lezárását.
	*
	* @author	Veres Tamás
	* 
	* @return	string	Lábléc.
	*/

	function html_footer ($data=null) {

		return
<<<HTML

      </div>
    </main>
  </div>
</body>
</html>

HTML;

	}

?>