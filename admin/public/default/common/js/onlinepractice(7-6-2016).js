function chk_answer(id){ 

    if(window.XMLHttpRequest)
        http=new XMLHttpRequest();
    else if(window.ActiveXObject)
        http=new ActiveXObject("Microsoft.XMLHTTP");
    else
        return(false);
	var answer = document.getElementById('txt_answer').value;	
	if(answer==''){
   	alert('Type Your Answer');
	document.getElementById('txt_answer_'+id).focus();
	return false;
   }
	
	
	url=BASE_URL+"student/onlinepractice/checkanswer/answer/"+answer+"/id/"+id;
    http.open("POST",url,true);
    http.onreadystatechange = function(){
       if(http.readyState == 4){
            if(http.status == 200){
                var result = http.responseText;
				if(result==0){      
			    document.getElementById('span_res').innerHTML='Wrong Answer';
			   }
			   else if(result==1){ 
			   document.getElementById('span_res').innerHTML='Right Answer';
			   }
            }
        }
    }
    http.send(null);
}


<!-- ****************************************************************************  -->

<!-- ********   DICTACTION CHECK ANSWER     *************  -->


<!-- ****************************************************************************  -->

function chk_answer_dic(id){ 
    if(window.XMLHttpRequest)
        http=new XMLHttpRequest();
    else if(window.ActiveXObject)
        http=new ActiveXObject("Microsoft.XMLHTTP");
    else
        return(false);
	var answer = document.getElementById('txt_answer').value;	
	url=BASE_URL+"student/onlinepractice/checkanswer_dic/answer/"+answer+"/id/"+id;
	//alert(url);return false;
    http.open("POST",url,true);
    http.onreadystatechange = function(){
       if(http.readyState == 4){
            if(http.status == 200){
                var result = http.responseText;
				if(result==0){      
			    document.getElementById('span_res').innerHTML='Wrong Answer';
			   }
			   else if(result==1){ 
			   document.getElementById('span_res').innerHTML='Right Answer';
			   }
            }
        }
    }
    http.send(null);
}



<!-- ****************************************************************************  -->

<!-- ********   IDENTIFY CORRECT ANSWER CHECK ANSWER     *************  -->


<!-- ****************************************************************************  -->


function chk_answer_ics(id){ 
	var i;var found=0;
 	for(i=1;i<=3;i++){
 	 	if(document.getElementById('rad_option'+i).checked==true){
	 		var found=1;
			var answer=document.getElementById('rad_option'+i).value;
		 	break;
	 	}
 	}
 if(found==0){
 	alert('Pls select your answer');
	return false;
 }
 
    if(window.XMLHttpRequest)
        http=new XMLHttpRequest();
    else if(window.ActiveXObject)
        http=new ActiveXObject("Microsoft.XMLHTTP");
    else
        return(false);
    
    url=BASE_URL+"student/onlinepractice/checkanswer_ics/answer/"+answer+"/id/"+id;
    //alert(url);
    http.open("POST",url,true);
    http.onreadystatechange = function(){
       if(http.readyState == 4){
            if(http.status == 200){
                var result = http.responseText;
				if(result==0){      
			    document.getElementById('span_res').innerHTML='Wrong Answer';
			   }
			   else if(result==1){ 
			   document.getElementById('span_res').innerHTML='Right Answer';
			   }
            }
        }
    }
    http.send(null);
}


<!-- ****************************************************************************  -->

<!-- ********   WORDAPP CHECK ANSWER     *************  -->


<!-- ****************************************************************************  -->



function chk_answer_word_app(id){ 
    if(window.XMLHttpRequest)
        http=new XMLHttpRequest();
    else if(window.ActiveXObject)
        http=new ActiveXObject("Microsoft.XMLHTTP");
    else
        return(false);
	var answer = document.getElementById('txt_answer').value;
	/*if(answer==''){
   	alert('Type Your Answer');
	//document.getElementById('txt_answer_'+id).focus();
	return false;
   }*/

	/*alert(answer);	return false;*/
	url=BASE_URL+"student/onlinepractice/checkanswer_word_app/answer/"+answer+"/id/"+id;
	//alert(url);return false;
    http.open("POST",url,true);
    http.onreadystatechange = function(){
       if(http.readyState == 4){
            if(http.status == 200){
                var result = http.responseText;
				/*alert(result);return false;*/
				if(result==0)
				{  
				    document.getElementById('span_res_'+id).innerHTML='Wrong Answer';
					//$("#span_res_"+id).html('Wrong Answer');
					
					
			   }
			   else if(result==1){ 
			   document.getElementById('span_res_'+id).innerHTML='Right Answer';
			   }
            }
        }
    }
    http.send(null);
}


<!-- ****************************************************************************  -->

<!-- ********   COMPLETE SENTENCE CHECK ANSWER     *************  -->


<!-- ****************************************************************************  -->



function chk_answer_complete_sent(id)
{ 
 /*alert(id);*/
    if(window.XMLHttpRequest)
        http=new XMLHttpRequest();
    else if(window.ActiveXObject)
        http=new ActiveXObject("Microsoft.XMLHTTP");
    else
        return(false);
	var answer = document.getElementById('txt_answer').value;
	/*if(answer==''){
   	alert('Type Your Answer');
	//document.getElementById('txt_answer_'+id).focus();
	return false;
   }*/

	/*alert(answer);	return false;*/
	url=BASE_URL+"student/onlinepractice/checkanswer_complete_sentence/answer/"+answer+"/id/"+id;
	//alert(url);return false;
    http.open("POST",url,true);
    http.onreadystatechange = function(){
       if(http.readyState == 4){
            if(http.status == 200){
                var result = http.responseText;
				/*alert(result);return false;*/
				if(result==0)
				{  
				    document.getElementById('span_res').innerHTML='Wrong Answer';
					//$("#span_res_"+id).html('Wrong Answer');
					
					
			   }
			   else if(result==1){ 
			   document.getElementById('span_res').innerHTML='Right Answer';
			   }
            }
        }
    }
    http.send(null);
}



<!-- ****************************************************************************  -->

<!-- ********   COMPLETE IDIOMS CHECK ANSWER     *************  -->


<!-- ****************************************************************************  -->



function chk_answer_complete_idioms(id)
{ 
 /*alert(id);*/
    if(window.XMLHttpRequest)
        http=new XMLHttpRequest();
    else if(window.ActiveXObject)
        http=new ActiveXObject("Microsoft.XMLHTTP");
    else
        return(false);
	var answer = document.getElementById('txt_answer').value;
	/*if(answer==''){
   	alert('Type Your Answer');
	//document.getElementById('txt_answer_'+id).focus();
	return false;
   }*/

	/*alert(answer);	return false;*/
	url=BASE_URL+"student/onlinepractice/checkanswer_complete_idioms/answer/"+answer+"/id/"+id;
	//alert(url);return false;
    http.open("POST",url,true);
    http.onreadystatechange = function(){
       if(http.readyState == 4){
            if(http.status == 200){
                var result = http.responseText;
				/*alert(result);return false;*/
				if(result==0)
				{  
				    document.getElementById('span_res').innerHTML='Wrong Answer';
					//$("#span_res_"+id).html('Wrong Answer');
					
					
			   }
			   else if(result==1){ 
			   document.getElementById('span_res').innerHTML='Right Answer';
			   }
            }
        }
    }
    http.send(null);
}



<!-- ****************************************************************************  -->

<!-- ********   PHONITICS CHECK ANSWER     *************  -->


<!-- ****************************************************************************  -->



function chk_answer_phonitics(id)
{ 
 /*alert(id);*/
    if(window.XMLHttpRequest)
        http=new XMLHttpRequest();
    else if(window.ActiveXObject)
        http=new ActiveXObject("Microsoft.XMLHTTP");
    else
        return(false);
	var answer = document.getElementById('txt_answer').value;
	/*if(answer==''){
   	alert('Type Your Answer');
	//document.getElementById('txt_answer_'+id).focus();
	return false;
   }*/

	/*alert(answer);	return false;*/
	url=BASE_URL+"student/onlinepractice/check_answer_phonitics/answer/"+answer+"/id/"+id;
	//alert(url);return false;
    http.open("POST",url,true);
    http.onreadystatechange = function(){
       if(http.readyState == 4){
            if(http.status == 200){
                var result = http.responseText;
				/*alert(result);return false;*/
				if(result==0)
				{  
				    document.getElementById('span_res').innerHTML='Wrong Answer';
					//$("#span_res_"+id).html('Wrong Answer');
					
					
			   }
			   else if(result==1){ 
			   document.getElementById('span_res').innerHTML='Right Answer';
			   }
            }
        }
    }
    http.send(null);
}



<!-- ****************************************************************************  -->

<!-- ********   SYNONYM & ANTONYM  CHECK ANSWER     *************  -->


<!-- ****************************************************************************  -->


function chk_answer_syn_ant(id)

{ 
    //alert(id);
    if(window.XMLHttpRequest)
        http=new XMLHttpRequest();
    else if(window.ActiveXObject)
        http=new ActiveXObject("Microsoft.XMLHTTP");
    else
        return(false);
	var synonym_answer = document.getElementById('txt_synonym').value;
	var antonym_answer = document.getElementById('txt_antonym').value;
	
	if(synonym_answer==''){
		
   	/*alert('Type Your Answer');*/
	document.getElementById('synonym_span').innerHTML='Please Enter the  Synonym';
	document.getElementById('txt_synonym').focus();
	return false;
	}
	
    if(antonym_answer==''){
   	
	document.getElementById('antonym_span').innerHTML='Please Enter the  Antonym';
	document.getElementById('txt_antonym').focus();
	return false;
	}	
	//alert("synonym_answer" +synonym_answer +"antonym_answer" +antonym_answer);
	/*if(answer==''){
   	alert('Type Your Answer');
	//document.getElementById('txt_answer_'+id).focus();
	return false;
   }*/

	/*alert(answer);	return false;*/
	url=BASE_URL+"student/onlinepractice/checkanswer_syn_ant/synonym_answer/"+synonym_answer+"/antonym_answer/"+antonym_answer+"/id/"+id;
	
	//alert(url);return false;
    http.open("POST",url,true);
    http.onreadystatechange = function(){
       if(http.readyState == 4){
            if(http.status == 200){
                var result = http.responseText;
				/*alert(result);return false;*/
				if(result==0)
				{  
				    document.getElementById('span_res').innerHTML='Wrong Answer';
					//$("#span_res_"+id).html('Wrong Answer');
					
					
			   }
			   else if(result==1){ 
			   document.getElementById('span_res').innerHTML='Right Answer';
			   }
            }
        }
    }
    http.send(null);
}


