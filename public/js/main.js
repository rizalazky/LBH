(function($) {

    $(".toggle-password").click(function() {
        $(this).toggleClass("zmdi-eye zmdi-eye-off");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });

    let inputTypeNumber=document.getElementsByClassName('input_number');
    let inputTypeAlpha=document.getElementsByClassName('input_textOnly');
    let alertDiv=document.getElementsByClassName('alert');
    let formSubmit=document.getElementById('submit');
    let inputan=document.getElementsByTagName('input');


    msgArray=[]

    function setValidasi(msg){
      let invalid=document.getElementsByClassName('invalid')
      console.log(invalid.length)
      if(invalid.length > 0){
        formSubmit.disabled =true
        alertDiv[0].innerHTML = 'Format Inputan Salah ('+msg+')'
        alertDiv[0].style.display='block'
      }else{
        alertDiv[0].style.display='none'
        formSubmit.disabled =false
      }
    }

    if(inputTypeNumber){
      for (let index = 0; index < inputTypeNumber.length; index++) {
        const element = inputTypeNumber[index];
        element.addEventListener('input',(e)=>{
          let value=e.target.value
          var validasiAngka = /^[0-9]+$/;
          let msg=''
         console.log(value)
          if (!value.match(validasiAngka) && value!='') {
            element.classList.add('invalid')
            msg='numeric'
          }else{
            element.classList.remove('invalid')
          }
          setValidasi(msg); 
        }) 
      }
    }

    if(inputTypeAlpha){
      for (let i = 0; i < inputTypeAlpha.length; i++) {
        const el = inputTypeAlpha[i];
        
        el.addEventListener('input',(e)=>{
          let value=e.target.value
          let name=e.target.name
  
          var validasiHuruf = /^[a-zA-Z ]+$/;
          let msg=''
          if (!value.match(validasiHuruf) && value!='') {
            el.classList.add('invalid')
            msg='alphabet'
          }else{
            el.classList.remove('invalid')
            
          }
          setValidasi(msg); 
        })      
      }
    }
 
		var rupiah = document.getElementById('jmlbelanja');
    if(rupiah){
      rupiah.addEventListener('keyup', function(e){
        rupiah.value = formatRupiah(this.value, 'Rp. ');
      });
    }
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}

    // profile user page
    // show and hide history

    const btnHistory=document.getElementsByClassName('history_date');
    if(btnHistory){
      for (let a = 0; a < btnHistory.length; a++) {
        btnHistory[a].addEventListener('click',(e)=>{
          let sibling=btnHistory[a].nextElementSibling;
          if(btnHistory[a].classList.contains('active')){
            sibling.style.display ='none';
            btnHistory[a].classList.remove('active');
          }else{
            sibling.style.display ='block';
            btnHistory[a].classList.add('active');

          }
        }) 
      }
    }

})(jQuery);

